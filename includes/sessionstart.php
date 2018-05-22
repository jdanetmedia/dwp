<?php
session_start();
if (!isset($_SESSION['CREATED'])) {
    $_SESSION['CREATED'] = time();
} else if (time() - $_SESSION['CREATED'] < 604800) {
    // session started less than a week ago reset timer
    session_regenerate_id(true);    // change session ID for the current session and invalidate old session ID
    $_SESSION['CREATED'] = time();  // update creation time
} else if (time() - $_SESSION['CREATED'] > 604800) {
    // session started less than a week ago destroy session
    unset($_SESSION);
    session_destroy();
}
?>
