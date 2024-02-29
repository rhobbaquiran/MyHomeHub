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
</style>