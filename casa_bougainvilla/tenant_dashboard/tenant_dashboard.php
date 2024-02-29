<?php
session_start();

// Include the database connection file
include('../../includes/database.php');

// Pagination parameters
$rowsPerPage = 10;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $rowsPerPage;

if (!isset($_SESSION['username']) || empty($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: ../../index.php");
    exit();
}

// Check user role and redirect if not authorized
$allowed_roles = ['Tenant'];

if (!in_array($_SESSION['role'], $allowed_roles)) {
    // User is not authorized for this dashboard
    header("Location: ../../index.php");
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

    if (!empty($searchInput) && !empty($_SESSION['account_number'])) {
        // Use prepared statement to prevent SQL injection
        $search_query = "SELECT * FROM tenant_transactions WHERE (account_number LIKE ? OR username LIKE ? OR bill_number LIKE ? OR status LIKE ?  OR billing_period_start LIKE ? OR billing_period_end LIKE ? OR due_date LIKE ?) AND is_deleted = 0 AND account_number = ?";

        $searchInput = "%$searchInput%"; // Add wildcards to search pattern
        $stmt_search = $mysqli->prepare($search_query);

        if (!$stmt_search) {
            die('Error in prepare statement: ' . $mysqli->error);
        }

        $stmt_search->bind_param("sssssssi", $searchInput, $searchInput, $searchInput, $searchInput, $searchInput, $searchInput, $searchInput, $_SESSION['account_number']);
        $stmt_search->execute();

        if ($stmt_search->error) {
            die('Error executing statement: ' . $stmt_search->error);
        }

        $search_result = $stmt_search->get_result();
        $stmt_search->close();
    }
}

$results_per_page = 10;  // Number of results per page
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;  // Get the current page number
$start_from = ($current_page - 1) * $results_per_page;

// Retrieve data from the database with pagination
$sql = "SELECT id, account_number, username, bill_number, billing_period_start, billing_period_end, due_date, total_amount_due, status 
        FROM tenant_transactions 
        WHERE is_deleted = 0 AND account_number = ? 
        LIMIT ?, ?";
$stmt = $mysqli->prepare($sql);

if (!$stmt) {
    die('Error in prepare statement: ' . $mysqli->error);
}

$stmt->bind_param("iii", $_SESSION['account_number'], $start_from, $results_per_page);
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
    <title>Statement of Account</title>

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
    <?php include "../../includes/sidebars/tenant_sidebar.php" ?>

    <div class="container">
        <button class="btn btn-primary mx-5 my-5"><a href="bill_payment.php" class="text-light">Pay
                Bill</a></button>

        <!-- Print button with printer logo -->
        <button class="btn btn-success mx-5 my-3" onclick="downloadPDF()"><i class='bx bx-printer'></i> Print
            Table</button>

        <!-- Search Bar (updated) -->
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <form method="post" action="tenant_dashboard.php">
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
                echo '<th scope="col" style="white-space: nowrap; text-align: center;"><center>Bill Number</center></th>';
                echo '<th scope="col" style="white-space: nowrap; text-align: center;"><center>Condominium</center></th>';
                echo '<th scope="col" style="white-space: nowrap; text-align: center;"><center>Billing Period Start</center></th>';
                echo '<th scope="col" style="white-space: nowrap; text-align: center;"><center>Billing Period End</center></th>';
                echo '<th scope="col" style="white-space: nowrap; text-align: center;"><center>Due Date</center></th>';
                echo '<th scope="col" style="white-space: nowrap; text-align: center;"><center>Total Amount Due (Php)</center></th>';
                echo '<th scope="col" style="white-space: nowrap; text-align: center;"><center>Status</center></th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                while ($row = $search_result->fetch_assoc()) {
                    $id = $row['id'];
                    $account_number = $row['account_number'];
                    $condominium = $row['username'];
                    $bill_number = $row['bill_number'];
                    $billing_period_start = $row['billing_period_start'];
                    $billing_period_end = $row['billing_period_end'];
                    $due_date = $row['due_date'];
                    $total_amount_due = $row['total_amount_due'];
                    $status = $row['status'];

                    // Set the class based on the status for conditional styling
                    $statusClass = ($status == 'Pending') ? 'pending' : 'paid';

                    echo '<tr class="' . $statusClass . '">
            <th scope="row"><center>' . $bill_number . '</center></th>
            <td style="white-space: nowrap; text-align: center;"><center>' . $condominium . '</center></td>
            <td style="white-space: nowrap; text-align: center;"><center>' . $billing_period_start . '</center></td>
            <td style="white-space: nowrap; text-align: center;"><center>' . $billing_period_end . '</center></td>
            <td style="white-space: nowrap; text-align: center;"><center>' . $due_date . '</center></td>
            <td style="white-space: nowrap; text-align: center;"><center>' . $total_amount_due . '</center></td>
            <td style="white-space: nowrap; text-align: center;"><center>' . $status . '</center></td>
        </tr>';
                }

                echo '</tbody>';
                echo '</table>';
                echo '</div>';
            }
            ?>
            <!-- Statement of Account table -->
            <div class="list-of-sales second-table">
                <h2 class="mt-4 mb-3" style="white-space: nowrap; text-align: center;">Statement of Account</h2>
                <table id="TableSorter3" class="table col-mx-5">
                    <thead>
                        <tr>
                            <th scope="col" style="white-space: nowrap; text-align: center;">
                                <center>Bill Number</center>
                            </th>
                            <th scope="col" style="white-space: nowrap; text-align: center;">
                                <center>Condominium</center>
                            </th>
                            <th scope="col" style="white-space: nowrap; text-align: center;">
                                <center>Billing Period Start</center>
                            </th>
                            <th scope="col" style="white-space: nowrap; text-align: center;">
                                <center>Billing Period End</center>
                            </th>
                            <th scope="col" style="white-space: nowrap; text-align: center;">
                                <center>Due Date</center>
                            </th>
                            <th scope="col" style="white-space: nowrap; text-align: center;">
                                <center>Total Amount Due (Php)</center>
                            </th>
                            <th scope="col" style="white-space: nowrap; text-align: center;">
                                <center>Status</center>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        // Assuming $mysqli is your database connection
                        
                        $sql = "SELECT id, account_number, username, bill_number, billing_period_start, billing_period_end, due_date, total_amount_due, status 
            FROM tenant_transactions 
            WHERE is_deleted = 0 AND account_number = ? 
            ORDER BY FIELD(status, 'Pending') DESC
            LIMIT ?, ?";

                        // Use prepared statement
                        $stmt = $mysqli->prepare($sql);

                        // Check if the prepared statement is successful
                        if ($stmt) {
                            // Bind parameters
                            $stmt->bind_param("iii", $account_number, $offset, $rowsPerPage);

                            // Set the values of the parameters
                            $account_number = $_SESSION['account_number'];

                            // Execute the query
                            $stmt->execute();

                            // Bind result variables
                            $stmt->bind_result($id, $account_number, $condominium, $bill_number, $billing_period_start, $billing_period_end, $due_date, $total_amount_due, $status);

                            // Fetch and display results
                            while ($stmt->fetch()) {
                                // Set the class based on the status for conditional styling
                                $statusClass = ($status == 'Pending') ? 'pending' : 'paid';

                                echo '<tr class="' . $statusClass . '">
            <th scope="row" style="white-space: nowrap; text-align: center;"><center>' . $bill_number . '</center></th>
            <td style="white-space: nowrap; text-align: center;"><center>' . $condominium . '</center></td>
            <td style="white-space: nowrap; text-align: center;"><center>' . $billing_period_start . '</center></td>
            <td style="white-space: nowrap; text-align: center;"><center>' . $billing_period_end . '</center></td>
            <td style="white-space: nowrap; text-align: center;"><center>' . $due_date . '</center></td>
            <td style="white-space: nowrap; text-align: center;"><center>' . $total_amount_due . '</center></td>
            <td style="white-space: nowrap; text-align: center;"><center>' . $status . '</center></td>
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
                $total_pages_query = "SELECT COUNT(*) as total FROM tenant_transactions WHERE is_deleted = 0";
                $result = $mysqli->query($total_pages_query);
                $row = $result->fetch_assoc();
                $total_records = $row["total"];
                $total_pages = ceil($total_records / $results_per_page);

                // Display pagination links
                for ($i = 1; $i <= $total_pages; $i++) {
                    echo '<li class="page-item ' . ($i == $current_page ? 'active' : '') . '"><a class="page-link" href="tenant_dashboard.php?page=' . $i . '">' . $i . '</a></li>';
                }
                ?>
            </ul>
        </div>

        <script>
            function downloadPDF() {
                // Open the print dialog
                window.print();
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