<?php
session_start();

// Include the database connection file
include('../../includes/database.php');

if (!isset($_SESSION['username']) || empty($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: ../../index.php");
    exit();
}

// Check user role and redirect if not authorized
$allowed_roles = ['Front Desk'];

if (!in_array($_SESSION['role'], $allowed_roles)) {
    // User is not authorized for this page
    header("Location: ../../index.php");
    exit();
}

// Fetch activity logs from the database
$activity_logs_query = "SELECT * FROM activity_logs ORDER BY timestamp DESC";
$activity_logs_result = $mysqli->query($activity_logs_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Logs</title>

    <style>
        /* Googlefont Poppins CDN Link */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            position: fixed;
            height: 100%;
            width: 18%;
            background: #084cb4;
            padding-top: 20px;
            transition: width 0.4s;
        }

        .sidebar.active {
            width: 60px;
            overflow: hidden;
        }

        .sidebar .logo-details {
            height: 80px;
            display: flex;
            align-items: center;
            padding: 0 20px;
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
        }

        .sidebar .nav-links li a.active {
            background: #081D45;
            color: #fff;
        }

        .sidebar .nav-links li a:hover {
            background: #081D45;
            color: #fff;
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

        .container {
            margin-left: 18%; /* Adjust the margin based on sidebar width */
            padding: 20px;
        }

        .table {
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Additional style for print */
        @media print 
        {
            body * {
                visibility: hidden;
            }

            .print-section, .print-section * {
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
                margin: 1in 1.5in 1in 1in; /* Top, Right, Bottom, Left */
            }

            /* Explicitly set margins for all print regions */
            body {
                margin: 1in 1.5in 1in 1in; /* Top, Right, Bottom, Left */
            }

            .container {
                margin: 0;
            }
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="logo-details">
            <img src="../../includes/logo.png" width="100" height="90" id="logo">
            <span class="logo_name">Front Desk Monitoring</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="../front_desk_dashboard.php">
                    <i class='bx bx-grid-alt'></i>
                    <span class="link_name">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="activitylogs.php" class="active">
                    <i class='bx bx-list-ul'></i>
                    <span class="link_name">Activity Logs</span>
                </a>
            </li>
            <li>
                <a href="../../logout.php?logout=true">
                    <i class='bx bx-log-out'></i>
                    <span class="link_name">Log out</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="container">
    <button class="btn btn-success mx-5 my-5"" onclick="downloadPDF()"><i class='bx bx-printer'></i> Print Table</button>

    <div class="print-section">
        <table class="table mx-5">
            <thead>
                <tr>
                    <th scope="col"><center>Timestamp</center></th>
                    <th scope="col"><center>User</center></th>
                    <th scope="col"><center>Action</center></th>
                </tr>
            </thead>

            <tbody>
                <?php
                // Display activity logs
                while ($log = $activity_logs_result->fetch_assoc()) {
                    echo '<tr>
                            <td><center>' . $log['timestamp'] . '</center></td>
                            <td><center>' . $log['user'] . '</center></td>
                            <td><center>' . $log['action'] . '</center></td>
                        </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
    </div>

    <script>
        function downloadPDF() {
            // Open the print dialog
            window.print();
        }
    </script>
</body>
</html>