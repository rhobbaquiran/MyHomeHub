<?php
session_start();

// Include the database connection file
include('../includes/database.php');

if (!isset($_SESSION['username']) || empty($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: ../index.php");
    exit();
}

// Check if the condominium is disabled
$query = "SELECT disabled FROM condominiums WHERE name='Casa Bougainvilla'";
$result = $mysqli->query($query);

if ($result && $result->num_rows == 1) {
    $condominium = $result->fetch_assoc();
    $condominium_disabled = $condominium['disabled'];

    if ($condominium_disabled == 1 && in_array($_SESSION['role'], ['Resident', 'Front Desk', 'Administrator'])) {
        // The condominium is disabled, and the user has a locked role
        header("Location: ../index.php");
        exit();
    }
}

// Logout functionality
if (isset($_POST['logout'])) {
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session
    header("Location: ../index.php"); // Redirect to the login page after logout
    exit();
}

// Check user role and redirect if not authorized
$allowed_roles = ['Front Desk', 'Administrator'];

if (!in_array($_SESSION['role'], $allowed_roles)) {
    // User is not authorized for this dashboard
    header("Location: ../index.php");
    exit();
}

// Function to log activity
function logActivity($user, $action, $condominium_id)
{
    global $mysqli;
    $insert_query = "INSERT INTO activity_logs (timestamp, user, action, condominium_id) VALUES (CURRENT_TIMESTAMP, ?, ?, ?)";
    $stmt = $mysqli->prepare($insert_query);
    $stmt->bind_param("ssi", $user, $action, $condominium_id);
    $stmt->execute();
    $stmt->close();
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Front Desk Dashboard</title>

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

        /* Additional style for action buttons */
        .action-buttons {
            text-align: center; /* Center the buttons within the padded area */
        }

        .action-buttons button {
            margin-right: 5px;
        }

        th.action-column,
        td.action-column {
            width: 250px; /* Adjust the width as needed */
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
    <div class="sidebar">
        <div class="logo-details">
            <img src="../includes/logo.png" width="100" height="90" id="logo">
            <span class="logo_name">Front Desk Monitoring</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="front_desk_dashboard.php">
                    <i class='bx bx-grid-alt' class="active"></i>
                    <span class="link_name">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="front_desk_dashboard/activitylogs.php">
                    <i class='bx bx-list-ul'></i>
                    <span class="link_name">Activity Logs</span>
                </a>
            </li>
            <li>
                <a href="../logout.php?logout=true">
                    <i class='bx bx-log-out'></i>
                    <span class="link_name">Log out</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="container">
        <button class="btn btn-primary mx-5 my-5"><a href="front_desk_dashboard/add.php" class="text-light">Add Visitor</a></button>

        <!-- Print button with printer logo -->
        <button class="btn btn-success mx-5 my-3" onclick="downloadPDF()"><i class='bx bx-printer'></i> Print Table</button>

        <div class="print-section">
            <!-- Content to be printed -->
            <table class="table mx-5">
                <thead>
                    <tr>
                        <th scope="col"><center>ID</center></th>
                        <th scope="col"><center>Visitor Name</center></th>
                        <th scope="col"><center>Phone Number</center></th>
                        <th scope="col"><center>Email</center></th>
                        <th scope="col"><center>Arrival Time</center></th>
                        <th scope="col"><center>Departure Time</center></th>
                        <th scope="col"><center>Purpose</center></th>
                        <th class="action-column" scope="col"><center>Action</center></th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    // Retrieve data from the visitors table excluding soft-deleted records and filter by condominium_id
                    $sql = "SELECT * FROM visitors WHERE is_deleted = 0 AND condominium_id = 1";
                    $query = $mysqli->query($sql);
                    while ($row = $query->fetch_assoc()) {
                        $id = $row['id'];
                        $name = $row['name'];
                        $phone_number = $row['phone_number'];
                        $email = $row['email'];
                        $arrival_time = $row['arrival_time'];
                        $departure_time = $row['departure_time'];
                        $purpose = $row['purpose'];

                        echo '<tr>
                            <th scope="row"><center>' . $id . '</center></th>
                            <td><center>' . $name . '</center></td>
                            <td><center>' . $phone_number . '</center></td>
                            <td><center>' . $email . '</center></td>
                            <td><center>' . $arrival_time . '</center></td>
                            <td><center>' . $departure_time . '</center></td>
                            <td><center>' . $purpose . '</center></td>
                            <td class="action-column action-buttons">
                                <button class="btn btn-primary"><a href="front_desk_dashboard/update.php?updateid=' . $id . '" class="text-light">Update</a></button>
                                <button class="btn btn-danger" data-id="' . $id . '">Delete</button>
                            </td>
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
    </script>
</body>

</html>