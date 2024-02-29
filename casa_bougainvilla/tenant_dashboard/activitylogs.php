<?php
session_start();

// Include the database connection file
include('../../includes/database.php');

if (!isset($_SESSION['username']) || empty($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: ../../index.php");
    exit();
}

// Check user role and redirect if not authorized
$allowed_roles = ['Tenant'];

if (!in_array($_SESSION['role'], $allowed_roles)) {
    // User is not authorized for this page
    header("Location: ../../index.php");
    exit();
}

$account_number = $_SESSION['account_number'];

// Define the number of rows per page
$rowsPerPage = 10;

// Get the current page number from the query string
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// Calculate the offset for the query
$offset = ($page - 1) * $rowsPerPage;

// Process search form submission
if (isset($_POST['searchButton'])) {
    $searchInput = isset($_POST['searchInput']) ? trim($_POST['searchInput']) : '';

    if (!empty($searchInput)) {
        // Use prepared statement to prevent SQL injection
        $search_query = "SELECT * FROM activity_logs WHERE (timestamp LIKE ? OR user LIKE ? OR action LIKE ?) AND condominium_id = 1 AND account_number = ? ORDER BY timestamp DESC LIMIT $offset, $rowsPerPage";
        $searchInput = "%$searchInput%"; // Add wildcards to search pattern
        $stmt_search = $mysqli->prepare($search_query);

        if (!$stmt_search) {
            die('Error in prepare statement: ' . $mysqli->error);
        }

        $stmt_search->bind_param("sssi", $searchInput, $searchInput, $searchInput, $account_number);
        $stmt_search->execute();

        if ($stmt_search->error) {
            die('Error executing statement: ' . $stmt_search->error);
        }

        $search_result = $stmt_search->get_result();
        $stmt_search->close();
    }
}

// Fetch activity logs with pagination from the database
$activity_logs_query = "SELECT * FROM activity_logs WHERE condominium_id = 1 AND account_number = ? ORDER BY timestamp DESC LIMIT $offset, $rowsPerPage";
$stmt_logs = $mysqli->prepare($activity_logs_query);
$stmt_logs->bind_param("i", $account_number);
$stmt_logs->execute();
$activity_logs_result = $stmt_logs->get_result();

// Calculate the total number of pages
$totalRows = $mysqli->query("SELECT COUNT(*) as count FROM activity_logs WHERE condominium_id = 1 AND account_number = $account_number")->fetch_assoc()['count'];
$totalPages = ceil($totalRows / $rowsPerPage);

// Retrieve timestamp filter from URL
$timestampFilter = isset($_GET['filter']) ? $_GET['filter'] : 'all';

// Modify the query based on the timestamp filter
if ($timestampFilter !== 'all') {
    $activity_logs_query = "SELECT * FROM activity_logs WHERE condominium_id = 1 AND account_number = ? AND timestamp >= NOW() - INTERVAL 1 $timestampFilter ORDER BY timestamp DESC LIMIT $offset, $rowsPerPage";
    $stmt_logs = $mysqli->prepare($activity_logs_query);
    $stmt_logs->bind_param("i", $account_number);
    $stmt_logs->execute();
    $activity_logs_result = $stmt_logs->get_result();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
    <title>Activity Logs</title>

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
        <button class="btn btn-success mx-5 my-5"" onclick=" downloadPDF()"><i class='bx bx-printer'></i> Print
            Table</button>

        <!-- Search Bar (updated) -->
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <form method="post" action="activitylogs.php">
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

        <div class="container mt-3">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <!-- Timestamp Filter Dropdown -->
                    <select id="timestampFilter" class="form-control">
                        <option value="all">All</option>
                        <option value="day">Day</option>
                        <option value="week">Week</option>
                        <option value="month">Month</option>
                        <option value="year">Year</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="print-section">

            <!-- Search Results table -->
            <?php
            if (isset($search_result) && $search_result->num_rows > 0) {
                echo '<div class="search-results">';
                echo '<h2 class="mt-4 mb-3" style="white-space: nowrap; text-align: center;">Search Results</h2>';
                echo '<table id="TableSorter2" class="table mx-5">';
                echo '<thead>';
                echo '<tr>';
                echo '<th scope="col" style="white-space: nowrap; text-align: center;"><center>Timestamp</center></th>';
                echo '<th scope="col" style="white-space: nowrap; text-align: center;"><center>User</center></th>';
                echo '<th scope="col" style="white-space: nowrap; text-align: center;"><center>Action</center></th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                while ($row = $search_result->fetch_assoc()) {
                    $id = $row['id'];
                    $timestamp = $row['timestamp'];
                    $user = $row['user'];
                    $action = $row['action'];

                    echo '<tr>
            <td style="white-space: nowrap; text-align: center;"><center>' . $timestamp . '</center></td>
            <td style="white-space: nowrap; text-align: center;"><center>' . $user . '</center></td>
            <td style="white-space: nowrap; text-align: center;"><center>' . $action . '</center></td>
        </tr>';
                }

                echo '</tbody>';
                echo '</table>';
                echo '</div>';
            }
            ?>

            <h2 class="mt-4 mb-3" style="white-space: nowrap; text-align: center;">Activity Logs</h2>
            <table id="TableSorter" class="table mx-5">
                <thead>
                    <tr>
                        <th scope="col" style="white-space: nowrap; text-align: center;">
                            <center>Timestamp</center>
                        </th>
                        <th scope="col" style="white-space: nowrap; text-align: center;">
                            <center>User</center>
                        </th>
                        <th scope="col" style="white-space: nowrap; text-align: center;">
                            <center>Action</center>
                        </th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    // Display activity logs
                    while ($log = $activity_logs_result->fetch_assoc()) {
                        echo '<tr>
                            <td style="white-space: nowrap; text-align: center;"><center>' . $log['timestamp'] . '</center></td>
                            <td style="white-space: nowrap; text-align: center;"><center>' . $log['user'] . '</center></td>
                            <td style="white-space: nowrap; text-align: center;"><center>' . $log['action'] . '</center></td>
                        </tr>';
                    }
                    ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <ul class="pagination justify-content-center">
                <?php
                // Calculate the range of pages to display
                $range = 5; // Number of buttons to display on either side of the current page
                $start = max(1, $page - $range);
                $end = min($totalPages, $page + $range);

                // Display previous page link
                if ($page > 1) {
                    echo '<li class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '">&laquo;</a></li>';
                }

                // Display numbered pagination links
                for ($i = $start; $i <= $end; $i++) {
                    echo '<li class="page-item ' . ($i == $page ? 'active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                }

                // Display next page link
                if ($page < $totalPages) {
                    echo '<li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '">&raquo;</a></li>';
                }
                ?>
            </ul>
        </div>
    </div>

    <script>
        function downloadPDF() {
            // Open the print dialog
            window.print();
        }

        $(document).ready(function () {
            // Apply TableSorter to sort tables
            $('#TableSorter, #TableSorter2').tablesorter({
                theme: 'bootstrap'
            });

            // Handle dropdown change event
            $('#timestampFilter').change(function () {
                filterTableByTimestamp($(this).val());
            });

            // Set the selected value of the timestamp filter dropdown
            var urlParams = new URLSearchParams(window.location.search);
            var filterFromUrl = urlParams.get('filter');
            $('#timestampFilter').val(filterFromUrl || 'all');

            // Function to filter the table based on timestamp
            function filterTableByTimestamp(filter) {
                // Get the current page number from the query string
                var page = <?php echo $page; ?>;

                // Prepare the URL with the filter and page parameters
                var url = 'activitylogs.php?page=' + page;
                if (filter !== 'all') {
                    url += '&filter=' + filter;
                }

                // Redirect to the new URL
                window.location.href = url;
            }
        });
    </script>
</body>

</html>