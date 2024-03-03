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
</style>

<div class="sidebar">
    <div class="logo-details">
        <img src="../../includes/logo.png" width="100" height="90" id="logo">
        &nbsp;<span class="logo_name">
            <div class="username">
                <?php echo $_SESSION['username']; ?>
            </div>
        </span>
    </div>
    <ul class="nav-links">
        <li>
            <a href="units.php">
                <i class='bx bx-grid-alt' class="active"></i>
                <span class="link_name">Units</span>
            </a>
        </li>
        <li>
            <a href="resident_dashboard.php">
                <i class='bx bx-group' class="active"></i>
                <span class="link_name">Tenants List</span>
            </a>
        </li>
        <li>
            <a href="transactions.php">
                <i class='bx bx-dollar' class="active"></i>
                <span class="link_name">Tenants' Bills</span>
            </a>
        </li>
        <li>
            <a href="proof_of_payments.php">
                <i class='bx bx-camera' class="active"></i>
                <span class="link_name">Tenants' Payments</span>
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
                <i class='bx bx-dollar'></i>
                <span class="link_name">Budget of the Community</span>
            </a>
        </li>
        <li>
            <a href="community_inventory.php">
                <i class='bx bx-archive'></i>
                <span class="link_name">Inventory Available</span>
            </a>
        </li>
        <li>
            <a href="repair_request.php">
                <i class='bx bx-wrench'></i>
                <span class="link_name">Repair Request</span>
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