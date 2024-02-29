<?php
session_start();

// Include the database connection file
include('../includes/database.php');

if (!isset($_SESSION['username']) || empty($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: ../index.php");
    exit();
}

// Check user role and redirect if not authorized
$allowed_roles = ['Super Administrator'];

if (!in_array($_SESSION['role'], $allowed_roles)) {
    // User is not authorized for this dashboard
    header("Location: ../index.php");
    exit();
}

// Function to log activity
function logActivity($user, $action)
{
    global $mysqli;
    $insert_query = "INSERT INTO activity_logs (timestamp, user, action) VALUES (CURRENT_TIMESTAMP, ?, ?)";
    $stmt = $mysqli->prepare($insert_query);
    $stmt->bind_param("ss", $user, $action);
    $stmt->execute();
    $stmt->close();
}

// Pagination Configuration
$results_per_page = 10; // Adjust the number of results per page as needed
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$start_from = ($current_page - 1) * $results_per_page;

// Process search form submission
if (isset($_POST['searchButton'])) {
    $searchInput = isset($_POST['searchInput']) ? trim($_POST['searchInput']) : '';

    if (!empty($searchInput)) {
        // Add wildcards to search pattern
        $searchInput = "%$searchInput%";

        // Use prepared statement to prevent SQL injection
        $search_query = "SELECT u.*, c.name AS condominium_name 
            FROM users u
            LEFT JOIN condominiums c ON u.condominium_id = c.id
            WHERE (u.account_number LIKE ? OR u.username LIKE ? OR u.email LIKE ? OR c.name LIKE ?)
            AND u.role = 'Administrator'";

        // Use a try-catch block to handle potential exceptions
        try {
            $stmt_search = $mysqli->prepare($search_query);

            // Check for errors in prepare statement
            if (!$stmt_search) {
                throw new Exception("Error in prepare statement: " . $mysqli->error);
            }

            // Bind parameters with reference
            $stmt_search->bind_param("ssss", $searchInput, $searchInput, $searchInput, $searchInput);

            // Execute the statement
            $stmt_search->execute();

            // Get the result
            $search_result = $stmt_search->get_result();

            // Close the statement
            $stmt_search->close();
        } catch (Exception $e) {
            // Handle the exception (display error or log)
            die("Error: " . $e->getMessage());
        }
    }
}

// Reinstate functionality
if (isset($_GET['reinstate_id'])) {
    $reinstate_id = $_GET['reinstate_id'];
    $reinstatement_reason = isset($_GET['reinstatement_reason']) ? $_GET['reinstatement_reason'] : '';

    // Fetch details for the specific administrator
    $select_query = "SELECT username,email FROM users WHERE id = ?";//
    $stmt_select = $mysqli->prepare($select_query);
    $stmt_select->bind_param("i", $reinstate_id);
    $stmt_select->bind_result($name,$email);//
    $stmt_select->execute();
    $stmt_select->fetch();
    $stmt_select->close();

    // Reinstate record in the users table
    $update_query = "UPDATE users SET suspended = 0, reinstatement_reason = ? WHERE id = ?";
    $stmt = $mysqli->prepare($update_query);

    // Bind parameter
    $stmt->bind_param("si", $reinstatement_reason, $reinstate_id);
    $stmt->execute();

    // Check for success
    if ($stmt->affected_rows > 0) {
        $_SESSION['success'] = 'Administrator Reinstated successfully.';
        // Log the activity
        logActivity($_SESSION['username'], "Reinstated Administrator: $name. Reason: $reinstatement_reason");

        // Send reinstatement notice via email
		$emailSession = $_SESSION['email'];
        $to = $email;
        $subject = 'Account Reinstatement Notice';
        $message = "Dear Mr./Ms. $name,\n\nYour account has been reinstated due to $reinstatement_reason.\n\nIf you have any questions or concerns, please don't hesitate to reach us at:\n$emailSession\n\nRegards,\nMyHomeHub Team";
        $headers = 'From: adm1nplk2022@yahoo.com';

        mail($to, $subject, $message, $headers);
    } else {
        $_SESSION['error'] = 'Error Reinstated Administrator: ' . $stmt->error;
    }

    $stmt->close();

    // Redirect back to the dashboard
    header("Location: administrators.php");
    exit();
}
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrators</title>

    <style>
        .nav-links a span {
            font-weight: bold;
        }

        .pending {
            color: red;
        }

        .paid {
            color: green;
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

        #reportModal .modal-body {
            padding: 30px;
        }

        #reportModal .modal-body h4 {
            margin-top: 5px;
            margin-bottom: 5px;
        }

        #reportModal .modal-body table {
            margin-bottom: 20px;
            padding: 10px;
        }

        .modal-custom {
            max-width: 80%;
            /* Adjust the width as needed */
        }

        #reportModal .modal-dialog {
            max-width: 90%;
            /* Adjust the width as needed */
        }
    </style>
</head>

<body>
    <!-- Sidebar Import -->
    <?php include "../includes/sidebars/superadmin_sidebar.php" ?>

    <!-- Modal -->
    <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reportModalLabel">Administators Suspended Report</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Make the table responsive -->
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="white-space: nowrap; text-align: center;">Account Number</th>
                                    <th style="white-space: nowrap; text-align: center;">Name</th>
                                    <th style="white-space: nowrap; text-align: center;">Email</th>
                                    <th style="white-space: nowrap; text-align: center;">Role</th>
                                    <th style="white-space: nowrap; text-align: center;">Suspended</th>
                                    <th style='white-space: nowrap; text-align: center;'>Suspend Timestamp</th>
                                </tr>
                            </thead>
                            <tbody id="suspendedAccountsTableBody">
                                <?php
                                // Set the timezone to Philippines
                                date_default_timezone_set('Asia/Manila');

                                // Fetch data from the users table
                                $queryUsers = "SELECT account_number, username AS name, email, role, suspended, suspend_timestamp FROM users WHERE role = 'Administrator'";
                                $resultUsers = $mysqli->query($queryUsers);

                                if ($resultUsers && $resultUsers->num_rows > 0) {
                                    $totalUsers = $resultUsers->num_rows;
                                    $suspendedCount = 0;
                                    $nonSuspendedCount = 0;

                                    echo "<tbody id='suspendedAccountsTableBody'>";
                                    while ($rowUser = $resultUsers->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td style='white-space: nowrap; text-align: center;'>{$rowUser['account_number']}</td>";
                                        echo "<td style='white-space: nowrap; text-align: center;'>{$rowUser['name']}</td>";
                                        echo "<td style='white-space: nowrap; text-align: center;'>{$rowUser['email']}</td>";
                                        echo "<td style='white-space: nowrap; text-align: center;'>{$rowUser['role']}</td>";
                                        echo "<td style='white-space: nowrap; text-align: center;'>" . ($rowUser['suspended'] == 1 ? "Yes" : "No") . "</td>";
                                        echo "<td style='white-space: nowrap; text-align: center;'>" . date('Y-m-d h:i:s a', strtotime($rowUser['suspend_timestamp'])) . "</td>";
                                        echo "</tr>";

                                        // Count suspended and non-suspended users
                                        if ($rowUser['suspended'] == 1) {
                                            $suspendedCount++;
                                        } else {
                                            $nonSuspendedCount++;
                                        }
                                    }
                                    echo "</tbody>";

                                    // Calculate and display the percentage
                                    $percentageSuspended = ($suspendedCount / $totalUsers) * 100;
                                    $percentageNonSuspended = ($nonSuspendedCount / $totalUsers) * 100;

                                    echo "<div class='modal-footer'>";
                                    echo "<div style='text-align: left; color: red;'><strong>Percentage of Suspended Administators: " . number_format($percentageSuspended, 2) . "%</strong></div>";
                                    echo "&nbsp;<div style='text-align: left; color: green;'><strong>Percentage of Non-Suspended Administators: " . number_format($percentageNonSuspended, 2) . "%</strong></div>";
                                    echo "</div>";
                                } else {
                                    echo "<tr><td colspan='6'>No accounts found.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <?php echo '<br><br><h3>Generated by <b>' . $_SESSION['username'] . '</b> at <b>' . date('Y-m-d, h:i:s a') . '</b></h3><br><br>'; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <button class="btn btn-primary mx-5 my-5"><a href="superadmin_dashboard/../add_administrator.php"
                class="text-light">Add Administrator</a></button>

        <!-- Print button with printer logo -->
        <button class="btn btn-success mx-5 my-3" onclick="downloadPDF()"><i class='bx bx-printer'></i> Print
            Table</button>

        <!-- Generate Report button with file logo -->

        <!-- Search Bar (updated) -->
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <form method="post" action="administrators.php">
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
            <!-- Content to be printed -->
            <?php
            if (isset($search_result) && $search_result->num_rows > 0) {
                echo '<h2 class="mt-4 mb-3" style="white-space: nowrap; text-align: center;">Search Results</h2>';
                echo '<div class="row">';
                echo '<div class="col-md-6">';
                echo '<table id="TableSorter" class="table col-mx-5">';
                echo '<thead>';
                echo '<tr>';
                echo '<th scope="col" style="white-space: nowrap; text-align: center;"><center>Account Number</center></th>';
                echo '<th scope="col" style="white-space: nowrap; text-align: center;"><center>Name</center></th>';
                echo '<th scope="col" style="white-space: nowrap; text-align: center;"><center>Email</center></th>';
                echo '<th scope="col" style="white-space: nowrap; text-align: center;"><center>Condominium</center></th>';
                echo '<th scope="col" style="white-space: nowrap; text-align: center;"><center>Suspended</center></th>';
                echo '<th class="action-column" scope="col" style="white-space: nowrap; text-align: center;"><center>Action</center></th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                while ($row = $search_result->fetch_assoc()) {
                    $id = $row['id'];
                    $account_number = $row['account_number'];
                    $name = $row['username']; // Fix: use 'user_name' instead of 'username'
                    $email = $row['email'];
                    $condominium = $row['condominium_name'];
                    $suspended = $row['suspended'];

                    echo '<tr>
                        <th scope="row" style="white-space: nowrap; text-align: center;"><center>' . $account_number . '</center></th>
                        <td style="white-space: nowrap; text-align: center;"><center>' . $name . '</center></td>
                        <td style="white-space: nowrap; text-align: center;"><center>' . $email . '</center></td>
                        <td style="white-space: nowrap; text-align: center;"><center>' . $condominium . '</center></td>
                        <td style="white-space: nowrap; text-align: center;"><center>' . ($suspended == 1 ? 'Yes' : 'No') . '</center></td>
                        <td class="action-column action-buttons" style="white-space: nowrap; text-align: center;">';

                    // Update button
                    echo '<button class="btn btn-primary"><a href="../superadmin_dashboard/update_administrator.php?updateid=' . $id . '" class="text-light">Update</a></button>';

                    // Check if the administrator is suspended
                    if ($suspended == 1) {
                        // If suspended, show Reinstate button
                        echo '<button class="btn btn-success" data-id="' . $id . '">Reinstate</button>';
                    } else {
                        // If not suspended, show Suspend button
                        echo '<button class="btn btn-danger"><a href="../superadmin_dashboard/suspend_administrator.php?suspendid=' . $id . '" class="text-light">Suspend</button></td></tr>';
                    }

                    echo '</td>
                        </tr>';
                }

                echo '</tbody>';
                echo '</table>';
                echo '</div>';
                echo '</div>';
            }
            ?>

            <h2 class="mt-4 mb-3" style="white-space: nowrap; text-align: center;">Administrators</h2>

            <table id="TableSorter2" class="table col-mx-5">
                <thead>
                    <tr>
                        <th scope="col" style="white-space: nowrap; text-align: center;">
                            <center>Account Number</center>
                        </th>
                        <th scope="col" style="white-space: nowrap; text-align: center;">
                            <center>Name</center>
                        </th>
                        <th scope="col" style="white-space: nowrap; text-align: center;">
                            <center>Email</center>
                        </th>
                        <th scope="col" style="white-space: nowrap; text-align: center;">
                            <center>Condominium</center>
                        </th>
                        <th scope="col" style="white-space: nowrap; text-align: center;">
                            <center>Suspended</center>
                        </th>
                        <th class="action-column" scope="col" style="white-space: nowrap; text-align: center;">
                            <center>Action</center>
                        </th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    // Retrieve data from users and join with condominiums table.
                    $sql = "SELECT u.*, c.name AS condominium_name 
                            FROM users u
                            LEFT JOIN condominiums c ON u.condominium_id = c.id
                            WHERE u.role = 'Administrator'
                            LIMIT $start_from, $results_per_page";
                    $query = $mysqli->query($sql);

                    while ($row = $query->fetch_assoc()) {
                        $id = $row['id'];
                        $account_number = $row['account_number'];
                        $name = $row['username'];
                        $email = $row['email'];
                        $condominium = $row['condominium_name'];
                        $suspended = $row['suspended'];

                        echo '<tr>
                            <th scope="row" style="white-space: nowrap; text-align: center;"><center>' . $account_number . '</center></th>
                            <td style="white-space: nowrap; text-align: center;"><center>' . $name . '</center></td>
                            <td style="white-space: nowrap; text-align: center;"><center>' . $email . '</center></td>
                            <td style="white-space: nowrap; text-align: center;"><center>' . $condominium . '</center></td>
                            <td style="white-space: nowrap; text-align: center;"><center>' . ($suspended == 1 ? 'Yes' : 'No') . '</center></td>
                            <td class="action-column action-buttons" style="white-space: nowrap; text-align: center;">';

                        // Update button
                        echo '<button class="btn btn-primary"><a href="../superadmin_dashboard/update_administrator.php?updateid=' . $id . '" class="text-light">Update</a></button>';

                        // Check if the administrator is suspended
                        if ($suspended == 1) {
                            // If suspended, show Reinstate button
                            echo '<button class="btn btn-success" data-id="' . $id . '">Reinstate</button>';
                        } else {
                            // If not suspended, show Suspend button
                            echo '<button class="btn btn-danger"><a href="../superadmin_dashboard/suspend_administrator.php?suspendid=' . $id . '" class="text-light">Suspend</button></td></tr>';
                        }

                        echo '</td>
                        </tr>';
                    }
                    ?>
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div class="pagination mt-3 d-flex justify-content-center">
                <ul class="pagination">
                    <?php
                    // Count total number of administrators
                    $count_query = "SELECT COUNT(*) AS total FROM users WHERE role = 'Administrator'";
                    $count_result = $mysqli->query($count_query);
                    $count_row = $count_result->fetch_assoc();
                    $total_pages = ceil($count_row["total"] / $results_per_page);

                    // Display pagination links
                    for ($i = 1; $i <= $total_pages; $i++) {
                        echo "<li class='page-item";
                        if ($i == $current_page) {
                            echo " active";
                        }
                        echo "'><a class='page-link' href='administrators.php?page=" . $i . "'>" . $i . "</a></li>";
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
                // Redirect to suspend_administrator.php with the condominium ID
                window.location = "../superadmin_dashboard/suspend_administrator.php?suspendid=" + id;
            });
        });

        document.querySelectorAll('.action-buttons .btn-success').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                confirmReinstatement(id);
            });
        });

        function confirmReinstatement(id) {
            let reinstateReason = prompt("Reason for Reinstatement:", "");

            if (reinstateReason.trim() === "") {
                alert("Please provide a reason for reinstatement.");
            } else {
                let confirmMessage = "Are you sure you want to Reinstate this Administrator?\n\nReinstatement Reason: " + reinstateReason;
                if (confirm(confirmMessage)) {
                    window.location = "administrators.php?reinstate_id=" + id + "&reinstatement_reason=" + encodeURIComponent(reinstateReason);
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