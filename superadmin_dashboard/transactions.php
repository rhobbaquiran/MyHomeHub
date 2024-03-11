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

// Process search form submission
if (isset($_POST['searchButton'])) {
    $searchInput = isset($_POST['searchInput']) ? trim($_POST['searchInput']) : '';

    if (!empty($searchInput)) {
        // Use prepared statement to prevent SQL injection
        $search_query = "SELECT * FROM admin_transactions WHERE (account_number LIKE ? OR condominium LIKE ? OR bill_number LIKE ? OR status LIKE ?  OR billing_period_start LIKE ? OR billing_period_end LIKE ? OR due_date LIKE ?) AND is_deleted = 0";
        $searchInput = "%$searchInput%"; // Add wildcards to search pattern
        $stmt_search = $mysqli->prepare($search_query);

        if (!$stmt_search) {
            die('Error in prepare statement: ' . $mysqli->error);
        }

        $stmt_search->bind_param("sssssss", $searchInput, $searchInput, $searchInput, $searchInput, $searchInput, $searchInput, $searchInput);
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
    $select_query = "SELECT bill_number, condominium FROM admin_transactions WHERE id = ? AND is_deleted = 0";
    $stmt_select = $mysqli->prepare($select_query);
    $stmt_select->bind_param("i", $delete_id);
    $stmt_select->execute();
    $stmt_select->bind_result($bill_number, $condominium_id);
    $stmt_select->fetch();
    $stmt_select->close();

    // Soft Delete record in the admin_transactions table
    $update_query = "UPDATE admin_transactions SET is_deleted = 1 WHERE id = ? AND is_deleted = 0";
    $stmt = $mysqli->prepare($update_query);

    // Bind parameter
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();

    // Check for success
    if ($stmt->affected_rows > 0) {
        $_SESSION['success'] = 'Transaction deleted successfully.';
        // Log the activity
        logActivity($_SESSION['username'], "Deleted transaction of $condominium_id with Bill Number: $bill_number", $condominium_id);
    } else {
        $_SESSION['error'] = 'Error deleting record: ' . $stmt->error;
    }

    $stmt->close();

    // Redirect back to the dashboard
    header("Location: transactions.php");
    exit();
}

// Pagination variables
$results_per_page = 10;  // Number of results per page
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;  // Get the current page number

// Calculate the starting point for the results on the current page
$start_from = ($current_page - 1) * $results_per_page;

// Retrieve data from the database with pagination
$sql = "SELECT id, account_number, condominium, bill_number, billing_period_start, billing_period_end, due_date, total_amount_due, status 
        FROM admin_transactions 
        WHERE is_deleted = 0
        ORDER BY FIELD(status, 'Pending') DESC, id DESC
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

    <!-- TableSorter CSS -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/css/theme.bootstrap.min.css">

    <!-- jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- TableSorter JavaScript -->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/js/jquery.tablesorter.min.js"></script>

    <!-- Bootstrap JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Sales</title>

    <style>
        .nav-links a span {
            font-weight: bold;
        }

        .pending {
            color: orange;
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
            max-width: 50%;
            /* Adjust the width as needed */
        }
    </style>
</head>

<body>
    <!-- Sidebar Import -->
    <?php include "../includes/sidebars/superadmin_sidebar.php" ?>

    <!-- Add modal structure -->
    <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-custom" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <div>
                        <h5 class="modal-title" id="reportModalLabel">Monthly Sales Report</h5>
                    </div>
                    <div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">

                    <?php
                    // Disable warnings for division by zero
                    error_reporting(E_ERROR | E_PARSE);

                    // Set the timezone to the Philippines
                    date_default_timezone_set('Asia/Manila');

                    // SQL query to retrieve data for all months and order by month
                    $monthly_sql = "SELECT MONTH(due_date) as month, bill_number, condominium, account_number, total_amount_due 
                FROM admin_transactions 
                WHERE is_deleted = 0 AND status = 'Paid'
                ORDER BY MONTH(due_date)";
                    $stmt_monthly = $mysqli->prepare($monthly_sql);
                    $stmt_monthly->execute();
                    $result_monthly = $stmt_monthly->get_result();
                    $stmt_monthly->close();

                    // To organize data by month
                    $monthlyData = [];
                    $overallTotalSales = 0;

                    while ($row_monthly = $result_monthly->fetch_assoc()) {
                        $month = $row_monthly['month'];
                        unset($row_monthly['month']); // To remove the month from the row
                        $monthlyData[$month][] = $row_monthly;
                        $overallTotalSales += $row_monthly['total_amount_due'];
                    }

                    // Sort the data by month
                    ksort($monthlyData);

                    // Display tables for each month
                    foreach ($monthlyData as $month => $data) {
                        // To extract the year from due_date
                        $year = isset($data[0]['due_date']) ? date("Y", strtotime($data[0]['due_date'])) : date("Y");

                        echo '<br>';
                        echo '<h4>' . date("F Y", mktime(0, 0, 0, $month, 1, $year)) . '</h4>';
                        echo '<br>';
                        echo '<table class="table">';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th scope="col" style="white-space: nowrap; text-align: center;">Bill Number</th>';
                        echo '<th scope="col" style="white-space: nowrap; text-align: center;">Condominium</th>';
                        echo '<th scope="col" style="white-space: nowrap; text-align: center;">Account Number</th>';
                        echo '<th scope="col" style="white-space: nowrap; text-align: center;">Total Amount Due (Php)</th>';
                        echo '<th scope="col" style="white-space: nowrap; text-align: center;">Percentage of Earnings (%)</th>'; // Added column for percentage
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';

                        $totalAmountDueMonth = 0;

                        foreach ($data as $row) {
                            echo '<tr>';
                            echo '<td style="white-space: nowrap; text-align: center;">' . $row['bill_number'] . '</td>';
                            echo '<td style="white-space: nowrap; text-align: center;">' . $row['condominium'] . '</td>';
                            echo '<td style="white-space: nowrap; text-align: center;">' . $row['account_number'] . '</td>';
                            echo '<td style="white-space: nowrap; text-align: center;">' . $row['total_amount_due'] . '</td>';

                            // Calculate the percentage of earnings for the month
                            $percentageEarnings = ($row['total_amount_due'] / $overallTotalSales) * 100;

                            echo '<td style="white-space: nowrap; text-align: center;">' . number_format($percentageEarnings, 2) . '</td>';

                            echo '</tr>';

                            // To calculate total amount due for the month
                            $totalAmountDueMonth += $row['total_amount_due'];
                        }

                        echo '</tbody>';
                        echo '</table>';

                        // To display total amount due for the month
                        echo '<p>Total Amount Due for <b>' . date("F", mktime(0, 0, 0, $month, 1)) . '</b>: <b>Php ' . number_format($totalAmountDueMonth, 2) . '</b></p>';

                        // To calculate the percentage of earnings for the month
                        $percentageEarnings = 0;

                        if ($overallTotalSales != 0) {
                            $percentageEarnings = ($totalAmountDueMonth / $overallTotalSales) * 100;
                        }

                        // To display percentage of earnings for the month
                        echo '<p>Percentage of Earnings for <b>' . date("F", mktime(0, 0, 0, $month, 1)) . '</b>: <b>' . number_format($percentageEarnings, 2) . '%</b></p>';
                    }

                    // To display overall total sales
                    echo '<h4>Overall Total Sales: <b><span style="color: green;">Php ' . number_format($overallTotalSales, 2) . '</span></b></h4>';

                    echo '<br><br><h3>Generated by <b>' . $_SESSION['username'] . '</b> at <b>' . date('Y-m-d, h:i:s a') . '</b></h3>';

                    // Enable warnings again
                    error_reporting(E_ALL);
                    ?>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <button class="btn btn-primary mx-5 my-5"><a href="superadmin_dashboard/../add_transaction.php"
                class="text-light">Add Bill</a></button>

        <!-- Print button with printer logo -->
        <button class="btn btn-success mx-5 my-3" onclick="downloadPDF()"><i class='bx bx-printer'></i> Print
            Table</button>

        <!-- Generate Report button with file logo -->
        <button class="btn btn-info mx-5 my-3" data-toggle="modal" data-target="#reportModal"><i class='bx bx-file'></i>
            Generate Report</button>

        <!-- Search Bar (updated) -->
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <form method="post" action="transactions.php">
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
                echo '<th scope="col" style="white-space: nowrap; text-align: center;"><center>Account Number</center></th>';
                echo '<th scope="col" style="white-space: nowrap; text-align: center;"><center>Billing Period Start</center></th>';
                echo '<th scope="col" style="white-space: nowrap; text-align: center;"><center>Billing Period End</center></th>';
                echo '<th scope="col" style="white-space: nowrap; text-align: center;"><center>Due Date</center></th>';
                echo '<th scope="col" style="white-space: nowrap; text-align: center;"><center>Total Amount Due (Php)</center></th>';
                echo '<th scope="col" style="white-space: nowrap; text-align: center;"><center>Status</center></th>';
                echo '<th class="action-column" scope="col"><center>Action</center></th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                while ($row = $search_result->fetch_assoc()) {
                    $id = $row['id'];
                    $account_number = $row['account_number'];
                    $condominium = $row['condominium'];
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
            <td style="white-space: nowrap; text-align: center;"><center>' . $account_number . '</center></td>
            <td style="white-space: nowrap; text-align: center;"><center>' . $billing_period_start . '</center></td>
            <td style="white-space: nowrap; text-align: center;"><center>' . $billing_period_end . '</center></td>
            <td style="white-space: nowrap; text-align: center;"><center>' . $due_date . '</center></td>
            <td style="white-space: nowrap; text-align: center;"><center>' . $total_amount_due . '</center></td>
            <td style="white-space: nowrap; text-align: center;"><center>' . $status . '</center></td>
            <td class="action-column action-buttons" style="white-space: nowrap; text-align: center;">
                <button class="btn btn-primary"><a href="update_transaction.php?updateid=' . $id . '" class="text-light">Update</a></button>
                <button class="btn btn-danger" data-id="' . $id . '">Delete</button>
            </td>
        </tr>';
                }

                echo '</tbody>';
                echo '</table>';
                echo '</div>';
            }
            ?>
            <!-- List of Sales table -->
            <div class="list-of-sales second-table">
                <h2 class="mt-4 mb-3" style="white-space: nowrap; text-align: center;">List of Sales</h2>
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
                                <center>Account Number</center>
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
                            <th class="action-column" scope="col" style="white-space: nowrap; text-align: center;">
                                <center>Action</center>
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        // Retrieve data from users and join with condominiums table. Path: use condominium_id in the "users" table inable to go in "condominiums" table to get the "name" of the condominium. 
                        $sql = "SELECT id, account_number, condominium, bill_number, billing_period_start, billing_period_end, due_date, total_amount_due, status FROM admin_transactions WHERE is_deleted = 0 ORDER BY FIELD(status, 'Pending') DESC, id DESC LIMIT $offset, $rowsPerPage";
                        $query = $mysqli->query($sql);

                        while ($row = $query->fetch_assoc()) {
                            // Extracting data from the row
                            $id = $row['id'];
                            $account_number = $row['account_number'];
                            $condominium = $row['condominium'];
                            $bill_number = $row['bill_number'];
                            $billing_period_start = $row['billing_period_start'];
                            $billing_period_end = $row['billing_period_end'];
                            $due_date = $row['due_date'];
                            $total_amount_due = $row['total_amount_due'];
                            $status = $row['status'];

                            // Displaying the data in the table
                            // Set the class based on the status for conditional styling
                            $statusClass = ($status == 'Pending') ? 'pending' : 'paid';

                            echo '<tr class="' . $statusClass . '">
                        <th scope="row" style="white-space: nowrap; text-align: center;"><center>' . $bill_number . '</center></th>
                        <td style="white-space: nowrap; text-align: center;"><center>' . $condominium . '</center></td>
                        <td style="white-space: nowrap; text-align: center;"><center>' . $account_number . '</center></td>
                        <td style="white-space: nowrap; text-align: center;"><center>' . $billing_period_start . '</center></td>
                        <td style="white-space: nowrap; text-align: center;"><center>' . $billing_period_end . '</center></td>
                        <td style="white-space: nowrap; text-align: center;"><center>' . $due_date . '</center></td>
                        <td style="white-space: nowrap; text-align: center;"><center>' . $total_amount_due . '</center></td>
                        <td style="white-space: nowrap; text-align: center;"><center>' . $status . '</center></td>
                        <td class="action-column action-buttons" style="white-space: nowrap;">
                            <button class="btn btn-primary"><a href="update_transaction.php?updateid=' . $id . '" class="text-light">Update</a></button>
                            <button class="btn btn-danger" data-id="' . $id . '">Delete</button>
                        </td>
                        </tr>';
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
                $total_pages_query = "SELECT COUNT(*) as total FROM admin_transactions WHERE is_deleted = 0";
                $result = $mysqli->query($total_pages_query);
                $row = $result->fetch_assoc();
                $total_records = $row["total"];
                $total_pages = ceil($total_records / $results_per_page);

                // Display pagination links
                for ($i = 1; $i <= $total_pages; $i++) {
                    echo '<li class="page-item ' . ($i == $current_page ? 'active' : '') . '"><a class="page-link" href="transactions.php?page=' . $i . '">' . $i . '</a></li>';
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
                let text = "Are you sure you want to delete this transaction?";
                if (confirm(text)) {
                    window.location = "transactions.php?deleteid=" + id;
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