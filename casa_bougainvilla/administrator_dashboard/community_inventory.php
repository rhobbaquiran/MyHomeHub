<?php
session_start();

// Include the database connection file
include('../../includes/database.php');

if (!isset($_SESSION['username']) || empty($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: ../../index.php");
    exit();
}

// Check user role and redirect if not authorized
$allowed_roles = ['Administrator'];

if (!in_array($_SESSION['role'], $allowed_roles)) {
    // User is not authorized for this dashboard
    header("Location: ../../index.php");
    exit();
}

// Function to log activity
function logActivity($user, $action)
{

    global $mysqli;
    $insert_query = "INSERT INTO activity_logs (timestamp, user, action, condominium_id) VALUES (CURRENT_TIMESTAMP, ?, ?, 1)";
    $stmt = $mysqli->prepare($insert_query);
    $stmt->bind_param("ss", $user, $action);
    $stmt->execute();
    $stmt->close();
}

// Pagination parameters
$rowsPerPage = 10;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $rowsPerPage;

// Calculate the total number of pages
$totalRows = $mysqli->query("SELECT COUNT(*) as count FROM inventory WHERE condominium_id = 1")->fetch_assoc()['count'];
$totalPages = ceil($totalRows / $rowsPerPage);

// Process search form submission
if (isset($_POST['searchButton'])) {
    $searchInput = isset($_POST['searchInput']) ? trim($_POST['searchInput']) : '';

    if (!empty($searchInput)) {
        // Use prepared statement to prevent SQL injection
        $search_query = "SELECT * FROM inventory WHERE item_name LIKE ? AND condominium_id = ?";
        $searchInput = "%$searchInput%"; // Add wildcards to search pattern
        $stmt_search = $mysqli->prepare($search_query);

        if (!$stmt_search) {
            die('Error in prepare statement: ' . $mysqli->error);
        }

        // Bind parameters
        $stmt_search->bind_param("si", $searchInput, $_SESSION['condominium_id']);
        $stmt_search->execute();

        if ($stmt_search->error) {
            die('Error executing statement: ' . $stmt_search->error);
        }

        // Get search results
        $search_result = $stmt_search->get_result();
        $stmt_search->close();
    }
}

// Soft Delete functionality
if (isset($_GET['deleteid'])) {
    $delete_id = $_GET['deleteid'];

    // Soft Delete record in inventory table
    $update_query = "UPDATE inventory SET is_deleted = 1 WHERE id = ? AND is_deleted = 0";
    $stmt_update = $mysqli->prepare($update_query);
    // To bind param
    $stmt_update->bind_param("i", $delete_id);
    $stmt_update->execute();

    // Check for errors during execution
    if ($stmt_update->error) {
        die('Error executing update statement: ' . $stmt_update->error);
    }

    // Check for success
    if ($stmt_update->affected_rows > 0) {
        // Get the details before soft deleting
        $select_query = "SELECT item_name, quantity FROM inventory WHERE id = ? AND is_deleted = 1";
        $stmt_select = $mysqli->prepare($select_query);
        $stmt_select->bind_param("i", $delete_id);
        $stmt_select->execute();
        $stmt_select->bind_result($item_name, $quantity);
        $stmt_select->fetch();
        $stmt_select->close();

        $_SESSION['success'] = 'Item deleted successfully.';
        // Log the activity with the condominium_id
        //logActivity($_SESSION['username'], "Deleted Item $item_name,  Quantity: $quantity";
        logActivity($_SESSION['username'], "Deleted Item: $item_name, $quantity");
    } else {
        $_SESSION['error'] = 'Error deleting an item: ' . $stmt_update->error;
    }

    $stmt_update->close();

    // Redirect back to community_inventory.php after deletion
    header("Location: community_inventory.php");
    exit();
}

// Pagination parameters
$results_per_page = 10;  // Number of results per page
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;  // Get the current page number
$start_from = ($current_page - 1) * $results_per_page;

// Calculate the total number of pages
$totalRows = $mysqli->query("SELECT COUNT(*) as count FROM inventory WHERE condominium_id = {$_SESSION['condominium_id']} AND is_deleted = 0")->fetch_assoc()['count'];
$totalPages = ceil($totalRows / $results_per_page);

// Fetch inventory data from the database with pagination
$sql = "SELECT * FROM inventory WHERE is_deleted = 0 AND condominium_id = ? LIMIT ?, ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("iii", $_SESSION['condominium_id'], $start_from, $results_per_page);
$stmt->execute();
$query_result = $stmt->get_result();
$stmt->close();

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
    <title>Community Inventory</title>

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

        .action-buttons {
            text-align: center;
            display: flex;
            justify-content: space-between;
        }

        .action-buttons button {
            margin-right: 5px;
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

        .nav-links a span {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <!-- Sidebar Import -->
    <?php include "../../includes/sidebars/administrator_sidebar.php" ?>

    <div class="container">
        <button class="btn btn-primary mx-5 my-5"><a href="add_item_inventory.php" class="text-light">Add Item</a></button>

        <!-- Search Bar (updated) -->
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <form method="post" action="community_inventory.php">
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

        <div class="list-of-inventory second-table">

            <?php
            if (isset($search_result) && $search_result->num_rows > 0) {
                echo '<h2 class="mt-4 mb-3" style="white-space: nowrap; text-align: center;">Search Results</h2>';
                echo '<div class="row">';
                echo '<table id="TableSorter3" class="table mx-3">';
                echo '<thead>';
                echo '<tr>';
                echo '<th scope="col" style="white-space: nowrap; text-align: center;"><center>Quantity</center></th>';
                echo '<th scope="col" style="white-space: nowrap; text-align: center;"><center>Item</center></th>';
                echo '<th class="action-column" scope="col" style="white-space: nowrap; text-align: center;"><center>Action</center></th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                while ($row = $search_result->fetch_assoc()) {
                    $id = $row['id'];
                    $item_name = $row['item_name'];
                    $quantity = $row['quantity'];

                    echo '<tr>
                        <td scope="row" style="white-space: nowrap; text-align: center;"><center>' . $quantity . '</center></td>
                        <td style="white-space: nowrap; text-align: center;"><center>' . $item_name . '</center></td>
                        <td class="action-column action-buttons" style="white-space: nowrap; text-align: center;">';

                    // Update button
                    echo '<button class="btn btn-primary"><a href="update_item_inventory.php?updateid=' . $id . '" class="text-light">Update</a></button>';

                    // Delete button
                    echo '<button class="btn btn-danger delete-item" data-id="' . $id . '">Delete</button>';

                    echo '</td>
                        </tr>';
                }

                echo '</tbody>';
                echo '</table>';
                echo '</div>';
                echo '</div>';
            }
            ?>

            <h2 class="mt-4 mb-3" style="white-space: nowrap; text-align: center;">Inventory Available</h2>
            <table id="TableSorter2" class="table col-mx-5">
                <thead>
                    <tr>
                        <th scope="col" style="white-space: nowrap; text-align: center;">
                            <center>Quantity</center>
                        </th>
                        <th scope="col" style="white-space: nowrap; text-align: center;">
                            <center>Item</center>
                        </th>
                        <th scope="col" class="action-column" style="white-space: nowrap; text-align: center;">
                            <center>Action</center>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch inventory data from the database
                    $sql = "SELECT * FROM inventory WHERE is_deleted = 0 AND condominium_id = {$_SESSION['condominium_id']}";
                    $query = $mysqli->query($sql);

                    // Loop through the fetched results and display them in table rows
                    while ($row = $query->fetch_assoc()) {
                        $id = $row['id'];
                        $item_name = $row['item_name'];
                        $quantity = $row['quantity'];

                        echo '<tr>
                        <td scope="row" style="white-space: nowrap; text-align: center;"><center>' . $quantity . '</center></td>
                        <td style="white-space: nowrap; text-align: center;"><center>' . $item_name . '</center></td>
                        <td class="action-column action-buttons" style="white-space: nowrap; text-align: center;">';

                        // Update button
                        echo '<button class="btn btn-primary"><a href="update_item_inventory.php?updateid=' . $id . '" class="text-light">Update</a></button>';

                        // Delete button
                        echo '<button class="btn btn-danger delete-item" data-id="' . $id . '">Delete</button>';

                        echo '</td>
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
        $(document).ready(function() {
            // Function to handle delete button click event
            $('.delete-item').click(function() {
                var id = $(this).data('id');
                if (confirm("Are you sure you want to delete this item?")) {
                    // If user confirms, redirect to delete endpoint with item ID
                    window.location = "community_inventory.php?deleteid=" + id;
                }
            });

            // Initialize table sorting
            $('#TableSorter,#TableSorter2,#TableSorter3').tablesorter({
                theme: 'bootstrap'
            });
        });
    </script>
</body>

</html>