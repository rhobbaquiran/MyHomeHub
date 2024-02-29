<?php
session_start();

// Include the database connection file
include('../includes/database.php');

// Redirect if the user is not logged in
if (!isset($_SESSION['username']) || empty($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: index.php");
    exit();
}

// Check user role and redirect if not authorized
$allowed_roles = ['Super Administrator'];
if (!in_array($_SESSION['role'], $allowed_roles)) {
    header("Location: index.php");
    exit();
}

// Function to log activity
function logActivity($user, $action, $condominium_id)
{
    global $mysqli;
    $insert_query = "INSERT INTO activity_logs (timestamp, user, action, condominium_id) VALUES (CURRENT_TIMESTAMP, ?, ?, ?)";
    $stmt = $mysqli->prepare($insert_query);
    $stmt->bind_param("ssi", $user, $action, $condominium_id);
    $stmt->execute();
    $stmt->close();
}

// Set the number of results to display per page
$results_per_page = 10;
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($current_page - 1) * $results_per_page;

// Process search form submission
if (isset($_POST['searchButton'])) {
    $searchInput = isset($_POST['searchInput']) ? trim($_POST['searchInput']) : '';

    if (!empty($searchInput)) {
        // Use prepared statement to prevent SQL injection
        $search_query = "SELECT * FROM condominiums WHERE name LIKE ? OR person_of_contact LIKE ? OR address LIKE ?";
        $searchInput = "%$searchInput%"; // Add wildcards to search pattern
        $stmt_search = $mysqli->prepare($search_query);
        $stmt_search->bind_param("sss", $searchInput, $searchInput, $searchInput);
        $stmt_search->execute();
        $search_result = $stmt_search->get_result();
        $stmt_search->close();
    }
}

// Process search form submission
if (isset($_POST['searchButton'])) {
    $searchInput = isset($_POST['searchInput']) ? trim($_POST['searchInput']) : '';

    if (!empty($searchInput)) {
        // Use prepared statement to prevent SQL injection
        $search_query = "SELECT * FROM condominiums WHERE name LIKE ? OR person_of_contact LIKE ? OR address LIKE ?";
        $searchInput = "%$searchInput%"; // Add wildcards to search pattern
        $stmt_search = $mysqli->prepare($search_query);
        $stmt_search->bind_param("sss", $searchInput, $searchInput, $searchInput);
        $stmt_search->execute();
        $search_result = $stmt_search->get_result();
        $stmt_search->close();
    }
}

// Reinstate functionality
if (isset($_GET['reinstate_id'])) {
    $reinstate_id = $_GET['reinstate_id'];
    $reinstatement_reason = isset($_GET['reinstatement_reason']) ? $_GET['reinstatement_reason'] : '';

    // Fetch details for the specific condominium
    $select_query = "SELECT name, person_of_contact FROM condominiums WHERE id = ?";
    $stmt_select = $mysqli->prepare($select_query);
    $stmt_select->bind_param("i", $reinstate_id);
    $stmt_select->bind_result($name, $person_of_contact);
    $stmt_select->execute();
    $stmt_select->fetch();
    $stmt_select->close();

    // Reinstate record in the condominiums table
    $update_query = "UPDATE condominiums SET suspended = 0, reinstatement_reason = ?, payment_status = 'PAID' WHERE id = ?";
    $stmt = $mysqli->prepare($update_query);
    $stmt->bind_param("si", $reinstatement_reason, $reinstate_id);
    $stmt->execute();

    // Check for success
    if ($stmt->affected_rows > 0) {
        $_SESSION['success'] = 'Condominium Reinstated successfully.';
        // Log the activity
        logActivity($_SESSION['username'], "Reinstated Condominium: $name. Reason: $reinstatement_reason", $reinstate_id);

        // Send reinstatement notice via email
        $user_email_query = "SELECT email FROM users WHERE username = ?";
        $stmt_user_email = $mysqli->prepare($user_email_query);
        $stmt_user_email->bind_param("s", $person_of_contact);
        $stmt_user_email->bind_result($user_email);
        $stmt_user_email->execute();
        $stmt_user_email->fetch();
        $stmt_user_email->close();

        // Compose and send email
        $emailSession = $_SESSION['email'];
        $to = $user_email;
        $subject = "Condominium Reinstatement Notice";
        $message = "Dear Mr./Ms. $person_of_contact,\n\nThis is to inform you that the $name condominium has been reinstated.\nReason: $reinstatement_reason.\n\nIf you have any questions or concerns, please don't hesitate to reach us at:\n$emailSession\n\nRegards,\nMyHomeHub Team";
        $headers = "From: adm1nplk2022@yahoo.com"; // Replace with your email address

        // Use mail() function to send email
        mail($to, $subject, $message, $headers);
    } else {
        $_SESSION['error'] = 'Error Reinstating Condominium: ' . $stmt->error;
    }

    $stmt->close();

    // Redirect back to the dashboard
    header("Location: superadmin_dashboard.php");
    exit();
}

// Retrieve data from the condominiums for Approved status
$sql_approved = "SELECT * FROM condominiums WHERE condominium_status = 'Approved' LIMIT ?, ?";
$query_approved = $mysqli->prepare($sql_approved);
$query_approved->bind_param("ii", $offset, $results_per_page);
$query_approved->execute();
$result_approved = $query_approved->get_result();

// Retrieve data from the condominiums for Pending status
$sql_pending = "SELECT * FROM condominiums WHERE condominium_status = 'Pending' LIMIT ?, ?";
$query_pending = $mysqli->prepare($sql_pending);
$query_pending->bind_param("ii", $offset, $results_per_page);
$query_pending->execute();
$result_pending = $query_pending->get_result();
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/css/theme.bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/css/theme.default.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/js/jquery.tablesorter.min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Condominiums</title>

    <style>
        .nav-links a span {
            font-weight: bold;
        }

        /* Googlefont Poppins CDN Link */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        .sidebar {
            position: fixed;
            height: 100%;
            width: 18%;
            /* Increase the width as needed */
            background: #084cb4;
            padding-top: 20px;
            /* Add a gap at the top of the logo */
            transition: width 0.4s;
        }

        .sidebar.active {
            width: 60px;
            overflow: hidden;
            /* Hide text when collapsed */
        }

        .sidebar .logo-details {
            height: 80px;
            display: flex;
            align-items: center;
            padding: 0 20px;
            /* Adjust padding as needed */
        }

        .sidebar .logo-details i {
            font-size: 28px;
            font-weight: 500;
            color: #fff;
            min-width: 60px;
            text-align: center;
        }

        .sidebar .logo-details .logo_name {
            color: #fff;
            font-size: 18px;
            font-weight: 500;
        }

        .sidebar .nav-links {
            margin-top: 10px;
        }

        .sidebar .nav-links li {
            position: relative;
            list-style: none;
            height: 50px;
        }

        .sidebar .nav-links li a {
            height: 100%;
            width: 100%;
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: all 0.4s ease;
            color: #fff;
            /* Set the active text color to white */
        }

        .sidebar .nav-links li a.active {
            background: #081D45;
            color: #fff;
            /* Set the active text color to white */
        }

        .sidebar .nav-links li a:hover {
            background: #081D45;
            color: #fff;
            /* Set the hover text color to white */
        }

        .sidebar .nav-links li i {
            min-width: 60px;
            text-align: center;
            font-size: 18px;
            color: #fff;
        }

        .sidebar .nav-links li a .links_name {
            color: #fff;
            font-size: 15px;
            font-weight: 400;
            white-space: nowrap;
        }

        .sidebar .nav-links .log_out {
            position: absolute;
            bottom: 0;
            width: 100%;
        }

        nav .sidebar-button i {
            font-size: 35px;
            margin-right: 10px;
        }

        @media (max-width: 00px) {
            .sidebar {
                width: 0;
            }

            .sidebar.active {
                width: 60px;
            }
        }

        /* Add alternating background colors to table rows */
        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
            /* Light gray background for even rows */
        }

        tbody tr:nth-child(odd) {
            background-color: #ffffff;
            /* White background for odd rows */
        }

        /* Additional style for action buttons */
        .action-buttons {
            text-align: center;
            /* Center the buttons within the padded area */
            display: flex;
            justify-content: space-between;
            /* Add space between buttons */
        }

        .action-buttons button {
            margin-right: 5px;
        }

        th.action-column,
        td.action-column {
            width: 250px;
            /* Adjust the width as needed */
        }

        /* Additional style for print */
        @media print {
            body * {
                visibility: hidden;
            }

            .print-section,
            .print-section * {
                visibility: visible;
            }

            .print-section {
                position: absolute;
                left: 0;
                top: 0;
            }

            /* Add overflow-wrap for all columns */
            td {
                overflow-wrap: break-word;
            }

            /* Adjust margins for print */
            @page {
                margin: 1in 1.5in 1in 1in;
                /* Top, Right, Bottom, Left */
            }

            /* Explicitly set margins for all print regions */
            body {
                margin: 1in 1.5in 1in 1in;
                /* Top, Right, Bottom, Left */
            }

            .container {
                margin: 0;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar Import -->
    <?php include "../includes/sidebars/superadmin_sidebar.php" ?>

    <div class="container">
        <button class="btn btn-primary mx-5 my-5">
            <a href="add.php" class="text-light">Add Condominium</a>
        </button>

        <!-- Print button with printer logo -->
        <button class="btn btn-success mx-5 my-3" onclick="downloadPDF()">
            <i class='bx bx-printer'></i> Print Table
        </button>

        <!-- Search Bar (updated) -->
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <form method="post" action="superadmin_dashboard.php">
                        <div class="input-group">
                            <input type="text" name="searchInput" class="form-control" placeholder="Search...">
                            <div class="input-group-append">
                                <button class="btn btn-success" type="submit" name="searchButton">
                                    <i class="bi bi-search"></i> Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="print-section">
            <?php
            if (isset($search_result) && $search_result->num_rows > 0) {
                echo '<div class="print-section">';
                echo '<h2 class="mt-4 mb-3" style="white-space: nowrap; text-align: center;">Search Results</h2>';
                echo '<div class="row">';
                echo '<div class="col-md-6">';
                echo '<table id="TableSorter3" class="table col-mx-5">';
                echo '<thead>';
                echo '<tr>';
                echo '<th scope="col" style="white-space: nowrap; text-align: center;"><center>ID</center></th>';
                echo '<th scope="col" style="white-space: nowrap; text-align: center;"><center>Name</center></th>';
                echo '<th scope="col" style="white-space: nowrap; text-align: center;"><center>Person Of Contact</center></th>';
                echo '<th scope="col" style="white-space: nowrap; text-align: center;"><center>Address</center></th>';
                echo '<th scope="col" style="white-space: nowrap; text-align: center;"><center>Approval Status</center></th>';
                echo '<th scope="col" style="white-space: nowrap; text-align: center;"><center>Payment Status</center></th>';
                echo '<th scope="col" style="white-space: nowrap; text-align: center;"><center>Suspended</center></th>';
                echo '<th scope="col" style="white-space: nowrap; text-align: center;"><center>Legal Documents</center></th>';
                echo '<th class="action-column" scope="col" style="white-space: nowrap; text-align: center;"><center>Action</center></th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                while ($row = $search_result->fetch_assoc()) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $person_contact = $row['person_of_contact'];
                    $condo_address = $row['address'];
                    $condominium_status = $row['condominium_status'];
                    $suspended = $row['suspended'];
                    $payment_status = $row['payment_status'];
                    $file_documents = $row['legal_documents'];

                    echo '<tr>
                        <th scope="row" style="white-space: nowrap; text-align: center;"><center>' . $id . '</center></th>
                        <td><center>' . $name . '</center></td>';

                    if (empty($person_contact)) {
                        echo '<td><center><i>NOT INDICATED</i></center></td>';
                    } else {
                        echo '<td><center>' . $person_contact . '</center></td>';
                    }

                    if (empty($condo_address)) {
                        echo '<td style="white-space: nowrap; text-align: center;"><center><i>NOT INDICATED</i></center></td>';
                    } else {
                        echo '<td><center>' . $condo_address . '</center></td>';
                    }

                    echo '
                        <td style="white-space: nowrap; text-align: center;"><center>' . $condominium_status . '</center></td>
                        <td style="white-space: nowrap; text-align: center;"><center>' . $payment_status . '</center></td>
                        <td style="white-space: nowrap; text-align: center;"><center>' . ($suspended == 1 ? 'Yes' : 'No') . '</center></td>
                        <td><center><a href="uploads/' . $file_documents . '" target="_blank">' . $file_documents . '</a></center></td>
                        <td class="action-column action-buttons" style="white-space: nowrap; text-align: center;">
                        <button class="btn btn-primary"><a href="update.php?updateid=' . $id . '" class="text-light">Update</a></button>';

                    if ($suspended == 0) {
                        echo '<button class="btn btn-danger"><a href="suspend_condominium.php?suspendid=' . $id . '" class="text-light">Suspend</button></td></tr>';
                    } else {
                        echo '<button class="btn btn-success" data-id="' . $id . '">Reinstate</button></td></tr>';
                    }
                }

                echo '</tbody>';
                echo '</table>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>

            <br><br>
            <h2 class="mt-4 mb-3" style="white-space: nowrap; text-align: center;">Approved Condominiums</h2>
            <div class="row">
                <div class="col-md-6">
                    <table id="TableSorter" class="table col-mx-5">
                        <thead>
                            <tr>
                                <th scope="col" style="white-space: nowrap; text-align: center;">
                                    <center>ID</center>
                                </th>
                                <th scope="col">
                                    <center>Name</center>
                                </th>
                                <th scope="col" style="white-space: nowrap; text-align: center;">
                                    <center>Person Of Contact</center>
                                </th>
                                <th scope="col" style="white-space: nowrap; text-align: center;">
                                    <center>Address</center>
                                </th>
                                <th scope="col" style="white-space: nowrap; text-align: center;">
                                    <center>Approval Status</center>
                                </th>
                                <th scope="col" style="white-space: nowrap; text-align: center;">
                                    <center>Payment Status</center>
                                </th>
                                <th scope="col" style="white-space: nowrap; text-align: center;">
                                    <center>Suspended</center>
                                </th>
                                <th scope="col">
                                    <center>Legal Documents</center>
                                </th>
                                <th class="action-column" scope="col" style="white-space: nowrap; text-align: center;">
                                    <center>Action</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Retrieve data from the condominiums
                            $sql = "SELECT * FROM condominiums WHERE condominium_status = 'Approved' LIMIT $offset, $results_per_page";
                            $query_approved = $mysqli->query($sql);

                            while ($row = $query_approved->fetch_assoc()) {
                                $id = $row['id'];
                                $name = $row['name'];
                                $person_contact = $row['person_of_contact'];
                                $condo_address = $row['address'];
                                $condominium_status = $row['condominium_status'];
                                $suspended = $row['suspended'];
                                $payment_status = $row['payment_status'];
                                $file_documents = $row['legal_documents'];

                                echo '<tr>
                                <th scope="row"><center>' . $id . '</center></th>
                                <td><center>' . $name . '</center></td>';

                                if (empty($person_contact)) {
                                    echo '<td style="white-space: nowrap; text-align: center;"><center><i>NOT INDICATED</i></center></td>';
                                } else {
                                    echo '<td style="white-space: nowrap; text-align: center;"><center>' . $person_contact . '</center></td>';
                                }

                                if (empty($condo_address)) {
                                    echo '<td style="white-space: nowrap; text-align: center;"><center><i>NOT INDICATED</i></center></td>';
                                } else {
                                    echo '<td><center>' . $condo_address . '</center></td>';
                                }

                                echo '
                                <td style="white-space: nowrap; text-align: center;"><center>' . $condominium_status . '</center></td>
                                <td style="white-space: nowrap; text-align: center;"><center>' . $payment_status . '</center></td>
                                <td style="white-space: nowrap; text-align: center;"><center>' . ($suspended == 1 ? 'Yes' : 'No') . '</center></td>
                                <td><center><a href="uploads/' . $file_documents . '" target="_blank">' . $file_documents . '</a></center></td>
                                <td class="action-column action-buttons">
                                <button class="btn btn-primary"><a href="update.php?updateid=' . $id . '" class="text-light">Update</a></button>';

                                if ($suspended == 0) {
                                    echo '<button class="btn btn-danger"><a href="suspend_condominium.php?suspendid=' . $id . '" class="text-light">Suspend</button></td></tr>';
                                } else {
                                    echo '<button class="btn btn-success" data-id="' . $id . '">Reinstate</button></td></tr>';
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination Links for Approved status -->
            <div class="pagination mt-3 d-flex justify-content-center">
                <ul class="pagination">
                    <?php
                    // Count total number of condominiums for Approved status
                    $count_query_approved = "SELECT COUNT(*) AS total FROM condominiums WHERE condominium_status = 'Approved'";
                    $count_result_approved = $mysqli->query($count_query_approved);
                    $count_row_approved = $count_result_approved->fetch_assoc();
                    $total_pages_approved = ceil($count_row_approved["total"] / $results_per_page);

                    // Display pagination links for Approved status
                    for ($i = 1; $i <= $total_pages_approved; $i++) {
                        echo "<li class='page-item";
                        if ($i == $current_page) {
                            echo " active";
                        }
                        echo "'><a class='page-link' href='superadmin_dashboard.php?page=" . $i . "'>" . $i . "</a></li>";
                    }
                    ?>
                </ul>
            </div>

            <br>
            <h2 class="mt-4 mb-3" style="white-space: nowrap; text-align: center;">Pending Condominiums</h2>
            <div class="row">
                <div class="col-md-6">
                    <table id="TableSorter2" class="table col-mx-5">
                        <thead>
                            <tr>
                                <th scope="col" style="white-space: nowrap; text-align: center;">
                                    <center>ID</center>
                                </th>
                                <th scope="col" style="white-space: nowrap; text-align: center;">
                                    <center>Name</center>
                                </th>
                                <th scope="col" style="white-space: nowrap; text-align: center;">
                                    <center>Person Of Contact</center>
                                </th>
                                <th scope="col" style="white-space: nowrap; text-align: center;">
                                    <center>Address</center>
                                </th>
                                <th scope="col" style="white-space: nowrap; text-align: center;">
                                    <center>Approval Status</center>
                                </th>
                                <!--<th scope="col"><center>Suspension Reason</center></th>-->
                                <th scope="col" style="white-space: nowrap; text-align: center;">
                                    <center>Payment Status</center>
                                </th>
                                <th scope="col" style="white-space: nowrap; text-align: center;">
                                    <center>Suspended</center>
                                </th>
                                <th scope="col" style="white-space: nowrap; text-align: center;">
                                    <center>Legal Documents</center>
                                </th>
                                <th class="action-column" scope="col" style="white-space: nowrap; text-align: center;">
                                    <center>Action</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Retrieve data from the condominiums
                            $sql = "SELECT * FROM condominiums WHERE condominium_status = 'Pending' LIMIT $offset, $results_per_page";
                            $query_pending = $mysqli->query($sql);

                            while ($row = $query_pending->fetch_assoc()) {
                                $id = $row['id'];
                                $name = $row['name'];
                                $person_contact = $row['person_of_contact'];
                                $condo_address = $row['address'];
                                $condominium_status = $row['condominium_status'];
                                $suspended = $row['suspended'];
                                $payment_status = $row['payment_status'];
                                $file_documents = $row['legal_documents'];

                                echo '<tr>
                                <th scope="row" style="white-space: nowrap; text-align: center;"><center>' . $id . '</center></th>
                                <td><center>' . $name . '</center></td>';

                                if (empty($person_contact)) {
                                    echo '<td style="white-space: nowrap; text-align: center;"><center><i>NOT INDICATED</i></center></td>';
                                } else {
                                    echo '<td style="white-space: nowrap; text-align: center;"><center>' . $person_contact . '</center></td>';
                                }

                                if (empty($condo_address)) {
                                    echo '<td style="white-space: nowrap; text-align: center;"><center><i>NOT INDICATED</i></center></td>';
                                } else {
                                    echo '<td><center>' . $condo_address . '</center></td>';
                                }

                                echo '
                                <td style="white-space: nowrap; text-align: center;"><center>' . $condominium_status . '</center></td>
                                <td style="white-space: nowrap; text-align: center;"><center>' . $payment_status . '</center></td>
                                <td style="white-space: nowrap; text-align: center;"><center>' . ($suspended == 1 ? 'Yes' : 'No') . '</center></td>
                                <td><center><a href="uploads/' . $file_documents . '" target="_blank">' . $file_documents . '</a></center></td>
                                <td class="action-column action-buttons" style="white-space: nowrap; text-align: center;">';

                                echo '<button class="btn btn-primary"><a href="update.php?updateid=' . $id . '" class="text-light">Update</a></button>';

                                if ($suspended == 0) {
                                    echo '<button class="btn btn-danger"><a href="suspend_condominium.php?suspendid=' . $id . '" class="text-light">Suspend</button></td></tr>';
                                } else {
                                    echo '<button class="btn btn-success" data-id="' . $id . '">Reinstate</button>';
                                }

                                echo '</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination Links for Pending status -->
            <div class="pagination mt-3 d-flex justify-content-center">
                <ul class="pagination">
                    <?php
                    // Count total number of condominiums for Pending status
                    $count_query_pending = "SELECT COUNT(*) AS total FROM condominiums WHERE condominium_status = 'Pending'";
                    $count_result_pending = $mysqli->query($count_query_pending);
                    $count_row_pending = $count_result_pending->fetch_assoc();
                    $total_pages_pending = ceil($count_row_pending["total"] / $results_per_page);

                    // Display pagination links for Pending status
                    for ($i = 1; $i <= $total_pages_pending; $i++) {
                        echo "<li class='page-item";
                        if ($i == $current_page) {
                            echo " active";
                        }
                        echo "'><a class='page-link' href='superadmin_dashboard.php?page=" . $i . "'>" . $i . "</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>

    <script>
        function downloadPDF() {
            // Open the print dialog
            window.print();
        }

        document.querySelectorAll('.action-buttons .btn-danger').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                // Redirect to suspend_condominium.php with the condominium ID
                window.location = "suspend_condominium.php?suspendid=" + id;
            });
        });

        document.querySelectorAll('.action-buttons .btn-success').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                confirmReinstate(id);
            });
        });

        function confirmReinstate(id) {
            let reinstateReason = prompt("Reason for Reinstatement:", "");

            if (reinstateReason.trim() === "") {
                alert("Please provide a reason for reinstatement.");
            } else {
                let confirmMessage = "Are you sure you want to Reinstate this Condominium?\n\nReinstatement Reason: " + reinstateReason;
                if (confirm(confirmMessage)) {
                    window.location = "superadmin_dashboard.php?reinstate_id=" + id + "&reinstatement_reason=" + encodeURIComponent(reinstateReason);
                }
            }
        }

        $(document).ready(function () {
            // Apply TableSorter to sort tables
            $('#TableSorter,#TableSorter2,#TableSorter3').tablesorter({
                theme: 'bootstrap'
            });
        });
    </script>
</body>

</html>