<?php
session_name("admin_session");
session_start();

// Destroy admin session
if (isset($_SESSION['valid'])) {
    unset($_SESSION['valid']);
    session_destroy();
}

header("Location: admin-login.php");
exit();
