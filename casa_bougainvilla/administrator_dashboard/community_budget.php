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

// Logout functionality
if (isset($_POST['logout'])) {
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session
    header("Location: ../../index.php"); // Redirect to the login page after logout
    exit();
}

// Check user role and redirect if not authorized
$allowed_roles = ['Administrator'];

if (!in_array($_SESSION['role'], $allowed_roles)) {
    // User is not authorized for this dashboard
    header("Location: ../../index.php");
    exit();
}

// Hardcoded community budget data
$communityBudgetData = array(
    array('category' => 'Maintenance', 'budget_amount' => 5000),
    array('category' => 'Utilities', 'budget_amount' => 3000),
    array('category' => 'Security', 'budget_amount' => 2000)
);

// Calculate total budget amount
$totalBudgetAmount = 0;
foreach ($communityBudgetData as $data) {
    $totalBudgetAmount += $data['budget_amount'];
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

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Current Budget of the Community</title>

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
            background-color: #f2f2f2; /* Light gray background for even rows */
        }

        tbody tr:nth-child(odd) {
            background-color: #ffffff; /* White background for odd rows */
        }

        .nav-links a span {
            font-weight: bold;
        }

    </style>
</head>
<body>
<div class="sidebar">
        <div class="logo-details">
            <img src="../../includes/logo.png" width="100" height="90" id="logo">
            &nbsp;<span class="logo_name"><div class="username"><?php echo $_SESSION['username']; ?></div></span>
        </div>
        <ul class="nav-links">
            <!--<li>
                <a href="profile.php">
                <i class='bx bx-user' class="active"></i>
                <span class="link_name">Profile</span>
                </a>
            </li>-->
            <li>
                <a href="units.php">
                <i class='bx bx-grid-alt' class="active"></i>
                <span class="link_name">Units</span>
                </a>
            </li>
            <li>
                <a href="../administrator_dashboard.php">
                    <i class='bx bx-group' class="active"></i>
                    <span class="link_name">Residents List</span>
                </a>
            </li>
            <li>
                <a href="transactions.php">
                <i class='bx bx-dollar' class="active"></i>
                <span class="link_name">Residents' Bills</span>
                </a>
            </li>
            <li>
                <a href="proof_of_payments.php">
                <i class='bx bx-camera' class="active"></i>
                <span class="link_name">Residents' Payments</span>
                </a>
            </li>
            <li>
                <a href="statement_of_account.php">
                <i class='bx bx-id-card' class="active"></i>
                <span class="link_name">Statement of Account</span>
                </a>
            </li>
            <li>
                <a href="account_payment_history.php">
                <i class='bx bx-history'></i>
                <span class="link_name">Account Payment History</span>
                </a>
            </li>
            <li>
                <a href="community_budget.php">
                <i class='bx bx-dollar' class="active"></i>
                <span class="link_name">Budget of the Community</span>
                </a>
            </li>
            <li>
                <a href="community_inventory.php">
                <i class='bx bx-archive' class="active"></i>
                <span class="link_name">Inventory Available</span>
                </a>
            </li>
            <li>
                <a href="employees.php">
                <i class='bx bx-file' class="active"></i>
                <span class="link_name">Front Desks List</span>
                </a>
            </li>
            <li>
                <a href="activitylogs.php">
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
        <button class="btn btn-primary mx-5 my-5"><a href="#" class="text-light">Add Budget</a></button>

            <!-- Community Budget table -->
        <div class="list-of-budget second-table">
            <h2 class="mt-4 mb-3" style="white-space: nowrap; text-align: center;">Budget of the Community</h2>
            <table id="TableSorter2" class="table col-mx-5">
                <thead>
                    <tr>
                        <th scope="col" style="white-space: nowrap; text-align: center;"><center>Category</center></th>
                        <th scope="col" style="white-space: nowrap; text-align: center;"><center>Budget Amount</center></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($communityBudgetData as $data) {
                        // Extract data from the row
                        $category = $data['category'];
                        $budget_amount = $data['budget_amount'];
                    ?>
                    <tr>
                        <td style="white-space: nowrap; text-align: center;"><center><?php echo $category; ?></center></td>
                        <td style="white-space: nowrap; text-align: center;"><center><?php echo $budget_amount; ?></center></td>
                    </tr>
                        <?php } ?>
                </tbody>
                <!-- Total budget amount row -->
                <tfoot>
                    <tr>
                        <td><strong><center>Total Budget Amount:</center></strong></td>
                        <td><strong><center><?php echo $totalBudgetAmount; ?></center></strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    
<script>
    $(document).ready(function () {
        $('#TableSorter,#TableSorter2,#TableSorter3').tablesorter({
            theme: 'bootstrap'
        });
    });
</script>
</body>
</html>