<?php 
session_start();
include('../../includes/database.php');

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

// Fetch active request for the current user
$sql = "SELECT * FROM service_ticket WHERE condominium_id = ? AND username = ? AND status = 0 ORDER BY date_issued DESC";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ss", $_SESSION['condominium_id'], $_SESSION['username']); // Assuming condominium_id is stored in $_SESSION['condominium_id']
$stmt->execute();
$query_result = $stmt->get_result();

// Fetch history requests for the current user
$sql_history = "SELECT * FROM service_ticket WHERE condominium_id = ? AND username = ? AND (status = 1 OR status = 2) ORDER BY date_issued DESC";
$stmt_history = $mysqli->prepare($sql_history);
$stmt_history->bind_param("ss", $_SESSION['condominium_id'], $_SESSION['username']); // Corrected binding
$stmt_history->execute();
$query_result_history = $stmt_history->get_result();

// Function to get the status label
function getStatusLabel($status)
{
    switch ($status) {
        case 0:
            return "Pending";
        case 1:
            return "Resolved";
        case 2:
            return "Rejected";
        default:
            return "Unknown";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/css/theme.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/css/theme.default.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/js/jquery.tablesorter.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repair Request</title>

    <style>
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

        .nav-links a span {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <!-- Sidebar Import -->
    <?php include "../../includes/sidebars/tenant_sidebar.php" ?>

    <div class="container">

        <button class="btn btn-primary mx-5 my-5"><a href="add_repair_request.php" class="text-light">Add Request</a></button>

        <h2 style="font-weight: bold; text-align: center;">Repair Request</h2>
        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">Active Requests</h5>
                <ul class="list-group">
                    <?php while ($row = $query_result->fetch_assoc()) : ?>
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <div>Unit Number: <?php echo $row['target_unit']; ?></div>
                                    <div>Requested by: <?php echo $_SESSION['username']; ?></div>
                                    <div>Date Issued: <?php echo $row['date_issued']; ?></div>
                                    <div>Title: <?php echo $row['heading']; ?></div>
                                    <div>Description: <?php echo $row['description']; ?></div>
                                    <div>Status: <span style="font-weight: bold;"><?php echo getStatusLabel($row['status']); ?></span></div>
                                    <div>Date Finished: <span style="font-weight: bold;"><?php echo $row['date_finished'] === '0000-00-00' ? "Pending" : $row['date_finished']; ?></span></div>
                                    <?php if ($row['status'] == 2) : ?>
                                        <div>Rejection Reason: <?php echo $row['rejection_reason']; ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">History Requests</h5>
                <ul class="list-group">
                    <?php
                    // Check if there are any history requests
                    if ($query_result_history !== null) {
                        // Iterate through the query result for history requests
                        while ($row_history = $query_result_history->fetch_assoc()) {
                    ?>
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <!-- Use variables within the HTML -->
                                        <div>Unit Number: <?php echo $row_history['target_unit']; ?></div>
                                        <div>Requested by: <?php echo $row_history['username']; ?></div>
                                        <div>Date Issued: <?php echo $row_history['date_issued']; ?></div>
                                        <div>Title: <?php echo $row_history['heading']; ?></div>
                                        <div>Description: <?php echo $row_history['description']; ?></div>
                                        <div>Status:
                                            <?php
                                            $status = $row_history['status'];
                                            $statusColor = '';
                                            switch ($status) {
                                                case 0:
                                                    $statusColor = 'blue'; // Pending
                                                    break;
                                                case 1:
                                                    $statusColor = 'green'; // Resolved
                                                    break;
                                                case 2:
                                                    $statusColor = 'red'; // Rejected
                                                    break;
                                                default:
                                                    $statusColor = 'black'; // Unknown status
                                                    break;
                                            }
                                            ?>
                                            <span style="font-weight: bold; color: <?php echo $statusColor; ?>"><?php echo getStatusLabel($status); ?></span>
                                        </div>
                                        <div>Date Finished: <span style="font-weight: bold;"><?php echo $row_history['date_finished'] === '0000-00-00' ? "Pending" : $row_history['date_finished']; ?></span></div>
                                        <?php if ($row_history['status'] == 2) : ?>
                                            <div>Rejection Reason: <?php echo $row_history['rejection_reason']; ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </li>
                    <?php
                        }
                    } else {
                        // Display a message if there are no history requests
                        echo "<p>No history requests found.</p>";
                    }
                    ?>
                </ul>
            </div>
        </div>


        <script>
            function toggleDetails(ticketNumber) {
                var details = document.getElementById('details_' + ticketNumber);
                details.classList.toggle('active');
                if (details.style.display === "block") {
                    details.style.display = "none";
                } else {
                    details.style.display = "block";
                }
            }

            $(document).ready(function() {
                $('#TableSorter,#TableSorter2,#TableSorter3').tablesorter({
                    theme: 'bootstrap'
                });
            });
        </script>
</body>

</html>