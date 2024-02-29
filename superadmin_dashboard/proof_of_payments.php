<?php
session_start();

// Include the database connection file
include('../includes/database.php');

// Pagination parameters
$rowsPerPage = 10;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $rowsPerPage;

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

if (isset($_POST['searchButton'])) {
    $searchInput = isset($_POST['searchInput']) ? trim($_POST['searchInput']) : '';

    if (!empty($searchInput) && !empty($_SESSION['username'])) {
        // Use prepared statement to prevent SQL injection
        $search_query = "SELECT p.id, p.timestamp, p.username, p.bill_number, p.screenshot, p.status, p.rejection_reason
                 FROM payments p
                 INNER JOIN users u ON p.username = u.username
                 WHERE (p.timestamp LIKE ? OR p.username LIKE ? OR p.bill_number LIKE ? OR p.screenshot LIKE ? OR p.status LIKE ?) 
                 AND p.is_deleted = 0 AND u.role = 'Administrator'";

        $searchInput = "%$searchInput%"; // Add wildcards to search pattern
        $stmt_search = $mysqli->prepare($search_query);

        if (!$stmt_search) {
            die('Error in prepare statement: ' . $mysqli->error);
        }

        $stmt_search->bind_param("sssss", $searchInput, $searchInput, $searchInput, $searchInput, $searchInput);
        $stmt_search->execute();

        if ($stmt_search->error) {
            die('Error executing statement: ' . $stmt_search->error);
        }

        $search_result = $stmt_search->get_result();
        $stmt_search->close();
    }
}

// Soft Delete functionality
if (isset($_GET['deleteid'])) {
    $delete_id = $_GET['deleteid'];

    // Get the bill details before soft deleting
    $select_query = "SELECT bill_number, username FROM payments WHERE id = ? AND is_deleted = 0";
    $stmt_select = $mysqli->prepare($select_query);
    $stmt_select->bind_param("i", $delete_id);
    $stmt_select->execute();
    $stmt_select->bind_result($bill_number, $username);
    $stmt_select->fetch();
    $stmt_select->close();

    // Soft Delete record in the payments table
    $update_query = "UPDATE payments SET is_deleted = 1 WHERE id = ? AND is_deleted = 0";
    $stmt = $mysqli->prepare($update_query);

    // Bind parameter
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();

    // Check for success
    if ($stmt->affected_rows > 0) {
        $_SESSION['success'] = 'Payment deleted successfully.';
        // Log the activity
        logActivity($_SESSION['username'], "Deleted Payment of $username with Bill Number: $bill_number", $username);
    } else {
        $_SESSION['error'] = 'Error deleting record: ' . $stmt->error;
    }

    $stmt->close();

    // Redirect back to the dashboard
    header("Location: proof_of_payments.php");
    exit();
}

$results_per_page = 10;  // Number of results per page
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;  // Get the current page number
$start_from = ($current_page - 1) * $results_per_page;

// Retrieve data from the database with pagination
$sql = "SELECT p.id, p.timestamp, p.username, p.bill_number, p.screenshot, p.status, p.rejection_reason
        FROM payments p
        INNER JOIN users u ON p.username = u.username
        WHERE p.is_deleted = 0 AND u.role = 'Administrator'
        ORDER BY FIELD(p.status, 'Unverified') DESC, p.timestamp DESC 
        LIMIT ?, ?";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ii", $start_from, $results_per_page);
$stmt->execute();
$query_result = $stmt->get_result();
$stmt->close();

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
    <title>Proof of Payments</title>

    <style>
        .nav-links a span {
            font-weight: bold;
        }

        .unverified {
            color: red;
        }

        .verified {
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

        .rejected {
            background-color: red;
            /* Set the background color to red for "Rejected" status */
            color: white;
            /* Set the text color to white for better visibility */
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
        <!-- Print button with printer logo -->
        <button class="btn btn-success mx-5 my-5" onclick="downloadPDF()"><i class='bx bx-printer'></i> Print
            Table</button>

        <!-- Search Bar (updated) -->
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <form method="post" action="proof_of_payments.php">
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
            <!-- Search Results table -->
            <?php
            if (isset($search_result) && $search_result->num_rows > 0) {
                echo '<div class="search-results">';
                echo '<h2 class="mt-4 mb-3" style="white-space: nowrap; text-align: center;">Search Results</h2>';
                echo '<table id="TableSorter2" class="table">';
                echo '<thead>';
                echo '<tr>';
                echo '<th scope="col" style="white-space: nowrap; text-align: center;"><center>Timestamp</center></th>';
                echo '<th scope="col" style="white-space: nowrap; text-align: center;"><center>User</center></th>';
                echo '<th scope="col" style="white-space: nowrap; text-align: center;"><center>Bill Number</center></th>';
                echo '<th scope="col" style="white-space: nowrap; text-align: center;"><center>Screenshot</center></th>';
                echo '<th scope="col" style="white-space: nowrap; text-align: center;"><center>Status</center></th>';
                echo '<th scope="col" style="white-space: nowrap; text-align: center;"><center>Rejection Reason</center></th>';
                echo '<th class="action-column" scope="col"><center>Action</center></th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                while ($row = $search_result->fetch_assoc()) {
                    $id = $row['id'];
                    $timestamp = $row['timestamp'];
                    $username = $row['username'];
                    $bill_number = $row['bill_number'];
                    $screenshot = $row['screenshot'];
                    $status = $row['status'];
                    $rejection_reason = $row['rejection_reason'];

                    // Set the class based on the status for conditional styling
                    $statusClass = ($status == 'Unverified' || $status != 'Verified') ? 'unverified' : ($status == 'Rejected' ? 'rejected' : 'verified');

                    echo '<tr class="' . $statusClass . '">
            <th scope="row" style="white-space: nowrap; text-align: center;"><center>' . $timestamp . '</center></th>
            <td style="white-space: nowrap; text-align: center;"><center>' . $username . '</center></td>
            <td style="white-space: nowrap; text-align: center;"><center>' . $bill_number . '</center></td>
            <td style="white-space: nowrap; text-align: center;">
            <center><a href="../uploads/payment_proof' . $screenshot . '" download="' . basename($screenshot) . '">' . basename($screenshot) . '</a></center>
            </td>
            <td style="white-space: nowrap; text-align: center;"><center><strong>' . ($status === '' ? 'Rejected' : $status) . '</strong></center></td>
            <td style="white-space: nowrap; text-align: center;"><center><strong>' . ($rejection_reason === NULL ? '<em>Not Indicated</em>' : $rejection_reason) . '</strong></center></td>
            <td class="action-column action-buttons" style="white-space: nowrap; text-align: center;">
                <button class="btn btn-primary"><a href="update_proof_of_payments.php?updateid=' . $id . '" class="text-light">Update</a></button>
                <button class="btn btn-danger" data-id="' . $id . '">Delete</button>
            </td>
        </tr>';
                }

                echo '</tbody>';
                echo '</table>';
                echo '</div>';
            }
            ?>
            <!-- Statement of Account table -->
            <div class="list-of-sales second-table">
                <h2 class="mt-4 mb-3" style="white-space: nowrap; text-align: center;">Proof of Payments</h2>
                <table id="TableSorter3" class="table col-mx-5">
                    <thead>
                        <tr>
                            <th scope="col" style="white-space: nowrap; text-align: center;">
                                <center>Timestamp</center>
                            </th>
                            <th scope="col" style="white-space: nowrap; text-align: center;">
                                <center>User</center>
                            </th>
                            <th scope="col" style="white-space: nowrap; text-align: center;">
                                <center>Bill Number</center>
                            </th>
                            <th scope="col" style="white-space: nowrap; text-align: center;">
                                <center>Screenshot</center>
                            </th>
                            <th scope="col" style="white-space: nowrap; text-align: center;">
                                <center>Status</center>
                            </th>
                            <th scope="col" style="white-space: nowrap; text-align: center;">
                                <center>Rejection Reason</center>
                            </th>
                            <th class="action-column" scope="col" style="white-space: nowrap; text-align: center;">
                                <center>Action</center>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        // Assuming $mysqli is your database connection
                        
                        $sql = "SELECT p.id, p.timestamp, p.username, p.bill_number, p.screenshot, p.status, p.rejection_reason
                        FROM payments p
                        INNER JOIN users u ON p.username = u.username
                        WHERE p.is_deleted = 0 AND u.role = 'Administrator'
                        ORDER BY FIELD(p.status, 'Unverified') DESC, p.timestamp DESC 
                        LIMIT ?, ?";

                        // Use prepared statement
                        $stmt = $mysqli->prepare($sql);

                        // Check if the prepared statement is successful
                        if ($stmt) {
                            // Bind parameters
                            $stmt->bind_param("ii", $offset, $rowsPerPage);

                            // Execute the query
                            $stmt->execute();

                            // Bind result variables
                            $stmt->bind_result($id, $timestamp, $username, $bill_number, $screenshot, $status, $rejection_reason);

                            // Fetch and display results
                            while ($stmt->fetch()) {
                                // Set the class based on the status for conditional styling
                                $statusClass = ($status == 'Unverified' || $status != 'Verified') ? 'unverified' : ($status == 'Rejected' ? 'rejected' : 'verified');

                                echo '<tr class="' . $statusClass . '">
            <th scope="row" style="white-space: nowrap; text-align: center;"><center>' . $timestamp . '</center></th>
            <td style="white-space: nowrap; text-align: center;"><center>' . $username . '</center></td>
            <td style="white-space: nowrap; text-align: center;"><center>' . $bill_number . '</center></td>
            <td style="white-space: nowrap; text-align: center;">
            <center><a href="../payment_proof' . $screenshot . '" download="' . basename($screenshot) . '">' . basename($screenshot) . '</a></center>
            </td>
            <td style="white-space: nowrap; text-align: center;"><center><strong>' . ($status === '' ? 'Rejected' : $status) . '</strong></center></td>
            <td style="white-space: nowrap; text-align: center;"><center><strong>' . ($rejection_reason === NULL ? '<em>Not Indicated</em>' : $rejection_reason) . '</strong></center></td>
            <td class="action-column action-buttons" style="white-space: nowrap; text-align: center;">
                <button class="btn btn-primary"><a href="update_proof_of_payments.php?updateid=' . $id . '" class="text-light">Update</a></button>
                <button class="btn btn-danger" data-id="' . $id . '">Delete</button>
            </td>
        </tr>';
                            }

                            // Close the statement
                            $stmt->close();
                        } else {
                            // Handle the case where the prepared statement fails
                            echo "Error in prepared statement";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Display pagination links -->
        <div class="pagination justify-content-center mt-3">
            <ul class="pagination">
                <?php
                $total_pages_query = "SELECT COUNT(*) as total FROM payments WHERE is_deleted = 0";
                $result = $mysqli->query($total_pages_query);
                $row = $result->fetch_assoc();
                $total_records = $row["total"];
                $total_pages = ceil($total_records / $results_per_page);

                // Display pagination links
                for ($i = 1; $i <= $total_pages; $i++) {
                    echo '<li class="page-item ' . ($i == $current_page ? 'active' : '') . '"><a class="page-link" href="proof_of_payments.php?page=' . $i . '">' . $i . '</a></li>';
                }
                ?>
            </ul>
        </div>

        <script>
            function downloadPDF() {
                // Open the print dialog
                window.print();
            }

            document.querySelectorAll('.action-buttons .btn-danger').forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    confirmDelete(id);
                });
            });

            function confirmDelete(id) {
                let text = "Are you sure you want to delete this payment?";
                if (confirm(text)) {
                    window.location = "proof_of_payments.php?deleteid=" + id;
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