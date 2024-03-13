<?php
session_start();

include('../../includes/database.php');

$rowsPerPage = 10;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $rowsPerPage;

if (!isset($_SESSION['username']) || empty($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: ../../index.php");
    exit();
}

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: ../../index.php");
    exit();
}

$allowed_roles = ['Resident'];

if (!in_array($_SESSION['role'], $allowed_roles)) {
    header("Location: ../../index.php");
    exit();
}

$resident_id = $_SESSION['username'];

function logActivity($user, $action, $condominium_id)
{
    global $mysqli;

    $account_number = $_SESSION['account_number'];

    $insert_query = "INSERT INTO activity_logs (timestamp, user, action, condominium_id, account_number) VALUES (CURRENT_TIMESTAMP, ?, ?, 1,$account_number)";
    $stmt = $mysqli->prepare($insert_query);
    $stmt->bind_param("ssi", $user, $action, $condominium_id);
    $stmt->execute();
    $stmt->close();
}

// Process search form submission
if (isset($_POST['searchButton'])) {
    $searchInput = isset($_POST['searchInput']) ? trim($_POST['searchInput']) : '';

    if (!empty($searchInput) && $_SESSION['username']) {
        // Use prepared statement to prevent SQL injection
        $search_query = "SELECT * FROM units WHERE (unit_number LIKE ? AND resident_id = ?) OR (unit_status LIKE ? AND resident_id = ?) OR (resident_id LIKE ? AND resident_id = ?) OR (tenant_id LIKE ? AND resident_id = ?) AND is_deleted = 0 LIMIT ?, ?";
        $stmt_search = $mysqli->prepare($search_query);

        if (!$stmt_search) {
            die('Error in prepare statement: ' . $mysqli->error);
        }

        $searchInput = "%$searchInput";
        $username = $_SESSION['username'];

        // Adjusted bind_param to match the number of placeholders
        $stmt_search->bind_param("ssssssssii", $searchInput, $username, $searchInput, $username, $searchInput, $username, $searchInput, $username, $offset, $rowsPerPage);
        $stmt_search->execute();

        if ($stmt_search->error) {
            die('Error executing statement: ' . $stmt_search->error);
        }

        $search_result = $stmt_search->get_result();
        $stmt_search->close();
    }
}

if (isset($_GET['deleteid'])) {
    $delete_id = $_GET['deleteid'];

    $condominium_id = $_SESSION['condominium_id'];

    $select_query = "SELECT unit_number, resident_id FROM units WHERE id = ? AND is_deleted = 0";
    $stmt_select = $mysqli->prepare($select_query);
    $stmt_select->bind_param("i", $delete_id);
    $stmt_select->execute();
    $stmt_select->bind_result($unit_number, $resident_id);
    $stmt_select->fetch();
    $stmt_select->close();

    $update_query = "UPDATE units SET is_deleted = 1 WHERE id = ? AND is_deleted = 0 AND resident_id = ?";
    $stmt = $mysqli->prepare($update_query);

    $stmt->bind_param("ii", $delete_id, $resident_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $_SESSION['success'] = 'Unit deleted successfully.';
        logActivity($_SESSION['username'], "Deleted Unit $unit_number", $resident_id);
    } else {
        $_SESSION['error'] = 'Error deleting record: ' . $stmt->error;
    }

    $stmt->close();

    header("Location: units.php?page=$page");
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

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/css/theme.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/css/theme.default.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/js/jquery.tablesorter.min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Units</title>

    <style>
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
            background-color: #f2f2f2; /* Light gray background for even rows */
        }

        tbody tr:nth-child(odd) {
            background-color: #ffffff; /* White background for odd rows */
        }

        /* Additional style for action buttons */
        .action-buttons {
            text-align: center; /* Center the buttons within the padded area */
            display: flex;
            justify-content: space-between; /* Add space between buttons */
        }

        .action-buttons button {
            margin-right: 5px;
        }

        th.action-column,
        td.action-column {
            width: 210px; /* Adjust the width as needed */
        }

        .nav-links a span {
        font-weight: bold;
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
    <!-- Sidebar Import -->
    <?php include "../../includes/sidebars/resident_sidebar.php" ?>

    <div class="container">
        <!-- Print button with printer logo -->
        <button class="btn btn-success mx-5 my-5" onclick="downloadPDF()"><i class='bx bx-printer'></i> Print Table</button>

        <!-- Search Bar (updated) -->
        <div class="container mt-3">
        <div class="row">
                <div class="col-md-6 offset-md-3">
                    <form method="post" action="units.php">
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
    echo '<th scope="col" style="white-space: nowrap; text-align: center;"><center>Unit Number</center></th>';
    echo '<th scope="col" style="white-space: nowrap; text-align: center;"><center>Status</center></th>';
    echo '<th scope="col" style="white-space: nowrap; text-align: center;"><center>Resident (Owner)</center></th>';
    echo '<th scope="col" style="white-space: nowrap; text-align: center;"><center>Tenant</center></th>';
    echo '<th class="action-column" scope="col" style="white-space: nowrap; text-align: center;"><center>Action</center></th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    while ($row = $search_result->fetch_assoc()) {
        $id = $row['id'];
        $unit_number = $row['unit_number'];
        $unit_status = $row['unit_status'];
        $resident = $row['resident_id'];
        $tenant = $row['tenant_id'];

        echo '<tr>
        <th scope="row" style="white-space: nowrap; text-align: center;"><center>' . $unit_number . '</center></th>
            <td style="white-space: nowrap; text-align: center;"><center>' . $unit_status . '</center></td>
            <td style="white-space: nowrap; text-align: center;"><center>' . ($resident ? $resident : '<i>Not Indicated</i>') . '</center></td>
            <td style="white-space: nowrap; text-align: center;"><center>' . ($tenant ? $tenant : '<i>Not Indicated</i>') . '</center></td>
            <td class="action-column action-buttons" style="white-space: nowrap;">
            <center><button class="btn btn-primary  mx-5"><a href="update_unit.php?updateid=' . $id . '" class="text-light">Update</a></button></center>
            </td>
        </tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';
}
?>

                    <!-- Residents' Bills table -->
        <div class="list-of-sales second-table">
            <h2 class="mt-4 mb-3" style="white-space: nowrap; text-align: center;">Units List</h2>
            <table id="TableSorter2" class="table col-mx-5">
                <thead>
                    <tr>
                        <th scope="col" style="white-space: nowrap; text-align: center;"><center>Unit Number</center></th>
                        <th scope="col" style="white-space: nowrap; text-align: center;"><center>Status</center></th>
                        <th scope="col" style="white-space: nowrap; text-align: center;"><center>Resident (Owner)</center></th>
                        <th scope="col" style="white-space: nowrap; text-align: center;"><center>Tenant</center></th>
                        <th scope="col" style="white-space: nowrap; text-align: center;"><center>Active Status</center></th>
                        <th class="action-column" scope="col" style="white-space: nowrap; text-align: center;"><center>Action</center></th>
                    </tr>
                </thead>

            <tbody>        
                <?php
                // Retrieve data from users and join with condominiums table. Path: use condominium_id in the "users" table in order to go to the "condominiums" table to get the "name" of the condominium.
                $sql = "SELECT * FROM units WHERE is_deleted = 0 AND resident_id = ? LIMIT ?, ?";
                $stmt = $mysqli->prepare($sql);
                
                if (!$stmt) {
                    die('Error in prepare statement: ' . $mysqli->error);
                }
                
                $stmt->bind_param("sii", $_SESSION['username'], $offset, $rowsPerPage);
                $stmt->execute();
                
                $result = $stmt->get_result();
                
                while ($row = $result->fetch_assoc()) {
                    // Extracting data from the row
                    $id = $row['id'];
                    $unit_number = $row['unit_number'];
                    $unit_status = $row['unit_status'];
                    $resident = $row['resident_id'];
                    $tenant = $row['tenant_id'];
                    $inactive = $row['inactive'];

                    $status = ($inactive == 0) ? "Active" : "Inactive";
                
                    echo '<tr>
                            <th scope="row" style="white-space: nowrap; text-align: center;"><center>' . $unit_number . '</center></th>
                            <td style="white-space: nowrap; text-align: center;"><center>' . $unit_status . '</center></td>
                            <td style="white-space: nowrap; text-align: center;"><center>' . ($resident ? $resident : '<i>Not Indicated</i>') . '</center></td>
                            <td style="white-space: nowrap; text-align: center;"><center>' . ($tenant ? $tenant : '<i>Not Indicated</i>') . '</center></td>
                            <td style="white-space: nowrap; text-align: center;"><center>' . $status . '</center></td>
                            <td class="action-column action-buttons" style="white-space: nowrap;">
                            <center><button class="btn btn-primary  mx-5"><a href="update_unit.php?updateid=' . $id . '" class="text-light">Update</a></button></center>
                            </td>
                          </tr>';
                }
                
                $stmt->close();
                ?>
            </tbody>
            </table>
        </div>

<!-- Pagination Links -->
<ul class="pagination justify-content-center">
    <?php
    $totalRows = $search_result->num_rows ?? $mysqli->query("SELECT COUNT(*) as count FROM units WHERE is_deleted = 0 AND resident_id = '{$_SESSION['username']}'")->fetch_assoc()['count'];
    $totalPages = ceil($totalRows / $rowsPerPage);

    for ($i = 1; $i <= $totalPages; $i++) {
        $isActive = ($i == $page) ? 'active' : '';
        $pageLink = (isset($search_result)) ? "units.php?searchInput=$searchInput&page=$i" : "units.php?page=$i";
        echo '<li class="page-item ' . $isActive . '"><a class="page-link" href="' . $pageLink . '">' . $i . '</a></li>';
    }
    ?>
</ul>


    <script>
        function downloadPDF() {
            // Open the print dialog
            window.print();
        }

        document.querySelectorAll('.action-buttons .btn-danger').forEach(button => {
            button.addEventListener('click', function () 
            {
                const id = this.getAttribute('data-id');
                const text = "Are you sure you want to delete this transaction?";
        
                // Use the built-in confirm dialog
                if (window.confirm(text)) {
                    window.location = "units.php?deleteid=" + id;
                }
            });
        });

        function confirmDelete(id) {
            let text = "Are you sure you want to delete this transaction?";
            if (confirm(text)) {
                window.location = "units.php?deleteid=" + id;
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