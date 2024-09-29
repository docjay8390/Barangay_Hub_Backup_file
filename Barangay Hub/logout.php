<?php
session_name("user_session");
session_start();

// Destroy user session
if (isset($_SESSION['valid'])) {
    unset($_SESSION['valid']);
    session_destroy();
}

header("Location: index.php");
exit();
