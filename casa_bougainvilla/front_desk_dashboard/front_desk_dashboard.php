<?php
session_start();

// Include the database connection file
include('../../includes/database.php');

if (!isset($_SESSION['username']) || empty($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: ../../index.php");
    exit();
}

// Check if the condominium is disabled (Suspended)
$query = "SELECT suspended FROM condominiums WHERE name='Casa Bougainvilla'";
$result = $mysqli->query($query);

if ($result && $result->num_rows == 1) {
    $condominium = $result->fetch_assoc();
    $condominium_disabled = $condominium['suspended'];

    if ($condominium_disabled == 1 && in_array($_SESSION['role'], ['Resident', 'Front Desk', 'Administrator'])) {
        // The condominium is disabled, and the user has a locked role
        header("Location: ../../index.php");
        exit();
    }
}

// Check user role and redirect if not authorized
$allowed_roles = ['Front Desk'];

if (!in_array($_SESSION['role'], $allowed_roles)) {
    // User is not authorized for this dashboard
    header("Location: ../../index.php");
    exit();
}

// Function to log activity
function logActivity($user, $action)
{
    global $mysqli;

    $account_number = $_SESSION['account_number'];

    $insert_query = "INSERT INTO activity_logs (timestamp, user, action, condominium_id, account_number) VALUES (CURRENT_TIMESTAMP, ?, ?, 1, $account_number)";
    $stmt = $mysqli->prepare($insert_query);
    $stmt->bind_param("ss", $user, $action);
    $stmt->execute();
    $stmt->close();
}

// Pagination variables
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 10; // Number of rows to display per page
$offset = ($page - 1) * $limit;

// Count total rows
$total_rows_query = "SELECT COUNT(*) as total FROM visitors WHERE is_deleted = 0 AND condominium_id = 1";
$total_rows_result = $mysqli->query($total_rows_query);
$total_rows = $total_rows_result->fetch_assoc()['total'];
$total_pages = ceil($total_rows / $limit);

// Modify the main SQL query
$sql = "SELECT * FROM visitors WHERE is_deleted = 0 AND condominium_id = 1 LIMIT $offset, $limit";
$query = $mysqli->query($sql);

// Process search form submission
if (isset($_POST['searchButton'])) {
    $searchInput = isset($_POST['searchInput']) ? trim($_POST['searchInput']) : '';

    if (!empty($searchInput)) {
        // Use prepared statement to prevent SQL injection
        $search_query = "SELECT * FROM visitors WHERE (name LIKE ? OR phone_number LIKE ? OR email LIKE ?) AND is_deleted = 0";
        $searchInput = "%$searchInput%"; // Add wildcards to search pattern
        $stmt_search = $mysqli->prepare($search_query);

        if (!$stmt_search) {
            die('Error in prepare statement: ' . $mysqli->error);
        }

        $stmt_search->bind_param("sss", $searchInput, $searchInput, $searchInput);
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

    // Get the visitor details before soft deleting
    $select_query = "SELECT name, condominium_id FROM visitors WHERE id = ? AND is_deleted = 0";
    $stmt_select = $mysqli->prepare($select_query);
    $stmt_select->bind_param("i", $delete_id);
    $stmt_select->execute();
    $stmt_select->bind_result($visitor_name, $condominium_id);
    $stmt_select->fetch();
    $stmt_select->close();

    // Soft Delete record in the visitors table
    $update_query = "UPDATE visitors SET is_deleted = 1 WHERE id = ? AND is_deleted = 0";
    $stmt = $mysqli->prepare($update_query);

    // Bind parameter
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();

    // Check for success
    if ($stmt->affected_rows > 0) {
        $_SESSION['success'] = 'Record deleted successfully.';
        // Log the activity
        logActivity($_SESSION['username'], "Deleted visitor: $visitor_name", $condominium_id);
    } else {
        $_SESSION['error'] = 'Error deleting record: ' . $stmt->error;
    }

    $stmt->close();

    // Redirect back to the dashboard
    header("Location: front_desk_dashboard.php");
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

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitors</title>

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
    <?php include "../../includes/sidebars/front_desk_sidebar.php" ?>

    <div class="container">
        <button class="btn btn-primary mx-5 my-5"><a href="add.php" class="text-light">Add Visitor</a></button>

        <!-- Print button with printer logo -->
        <button class="btn btn-success mx-5 my-3" onclick="downloadPDF()"><i class='bx bx-printer'></i> Print
            Table</button>

        <!-- Search Bar (updated) -->
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <form method="post" action="front_desk_dashboard.php">
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
                echo '<table id="TableSorter3" class="table">';
                echo '<thead>';
                echo '<tr>';
                echo '<th scope="col" style="white-space: nowrap; text-align: center;"><center>ID</center></th>
                        <th scope="col" style="white-space: nowrap; text-align: center;"><center>Visitor Name</center></th>
                        <th scope="col" style="white-space: nowrap; text-align: center;"><center>Phone Number</center></th>
                        <th scope="col" style="white-space: nowrap; text-align: center;"><center>Email</center></th>
                        <th scope="col" style="white-space: nowrap; text-align: center;"><center>Arrival Time</center></th>
                        <th scope="col" style="white-space: nowrap; text-align: center;"><center>Departure Time</center></th>
                        <th scope="col" style="white-space: nowrap; text-align: center;"><center>Purpose</center></th>
                        <th class="action-column" scope="col" style="white-space: nowrap; text-align: center;"><center>Action</center></th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                while ($row = $search_result->fetch_assoc()) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $phone_number = $row['phone_number'];
                    $email = $row['email'];
                    $arrival_time = $row['arrival_time'];
                    $departure_time = $row['departure_time'];
                    $purpose = $row['purpose'];

                    // Displaying the data in the table
                    echo '<tr>
                            <th scope="row"><center>' . $id . '</center></th>
                            <td style="white-space: nowrap; text-align: center;"><center>' . $name . '</center></td>
                            <td style="white-space: nowrap; text-align: center;"><center>' . $phone_number . '</center></td>
                            <td style="white-space: nowrap; text-align: center;"><center>' . $email . '</center></td>
                            <td style="white-space: nowrap; text-align: center;"><center>' . $arrival_time . '</center></td>
                            <td style="white-space: nowrap; text-align: center;"><center>' . $departure_time . '</center></td>
                            <td style="white-space: nowrap; text-align: center;"><center>' . $purpose . '</center></td>
                            <td class="action-column action-buttons" style="white-space: nowrap;">
                                <button class="btn btn-primary"><a href="update.php?updateid=' . $id . '" class="text-light">Update</a></button>
                            </td>
                        </tr>';
                }
                echo '</tbody>';
                echo '</table>';
                echo '</div>';
            }
            ?>

            <!-- visitors table -->
            <div class="front-desk-dashboard second-table">
                <h2 class="mt-4 mb-3" style="white-space: nowrap; text-align: center;">Visitors</h2>
                <table id="TableSorter2" class="table col-mx-5">
                    <thead>
                        <tr>
                            <th scope="col" style="white-space: nowrap; text-align: center;">
                                <center>ID</center>
                            </th>
                            <th scope="col" style="white-space: nowrap; text-align: center;">
                                <center>Visitor Name</center>
                            </th>
                            <th scope="col" style="white-space: nowrap; text-align: center;">
                                <center>Phone Number</center>
                            </th>
                            <th scope="col" style="white-space: nowrap; text-align: center;">
                                <center>Email</center>
                            </th>
                            <th scope="col" style="white-space: nowrap; text-align: center;">
                                <center>Arrival Time</center>
                            </th>
                            <th scope="col" style="white-space: nowrap; text-align: center;">
                                <center>Departure Time</center>
                            </th>
                            <th scope="col" style="white-space: nowrap; text-align: center;">
                                <center>Purpose</center>
                            </th>
                            <th class="action-column" scope="col" style="white-space: nowrap; text-align: center;">
                                <center>Action</center>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        // Retrieve data from users and join with condominiums table. Path: use condominium_id in the "users" table inable to go in "condominiums" table to get the "name" of the condominium. 
                        $sql = "SELECT * FROM visitors WHERE is_deleted = 0 AND condominium_id = 1 LIMIT $offset, $limit";
                        $query = $mysqli->query($sql);

                        while ($row = $query->fetch_assoc()) {
                            // Extracting data from the row
                            $id = $row['id'];
                            $name = $row['name'];
                            $phone_number = $row['phone_number'];
                            $email = $row['email'];
                            $arrival_time = $row['arrival_time'];
                            $departure_time = $row['departure_time'];
                            $purpose = $row['purpose'];

                            // Displaying the data in the table
                            echo '<tr>
                        <th scope="row"><center>' . $id . '</center></th>
                        <td style="white-space: nowrap; text-align: center;"><center>' . $name . '</center></td>
                        <td style="white-space: nowrap; text-align: center;"><center>' . $phone_number . '</center></td>
                        <td style="white-space: nowrap; text-align: center;"><center>' . $email . '</center></td>
                        <td style="white-space: nowrap; text-align: center;"><center>' . $arrival_time . '</center></td>
                        <td style="white-space: nowrap; text-align: center;"><center>' . $departure_time . '</center></td>
                        <td style="white-space: nowrap; text-align: center;"><center>' . $purpose . '</center></td>
                        <td class="action-column action-buttons" style="white-space: nowrap;">
                            <button class="btn btn-primary"><a href="update.php?updateid=' . $id . '" class="text-light">Update</a></button>
                        </td>
                        </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <ul class="pagination justify-content-center">
                <?php
                for ($i = 1; $i <= $total_pages; $i++) {
                    echo '<li class="page-item ' . ($page == $i ? 'active' : '') . '"><a class="page-link" href="front_desk_dashboard.php?page=' . $i . '">' . $i . '</a></li>';
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
                let text = "Are you sure you want to delete this record?";
                if (confirm(text)) {
                    window.location = "front_desk_dashboard.php?deleteid=" + id;
                }
            }

            $(document).ready(function() {
                // Apply TableSorter to sort tables
                $('#TableSorter,#TableSorter2,#TableSorter3').tablesorter({
                    theme: 'bootstrap'
                });
            });
        </script>
</body>

</html>