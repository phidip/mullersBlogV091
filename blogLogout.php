<?php
    session_start();
            // get session cookie handle
    unset($_SESSION['blogUser']);
            // unset session login var
    if (isset($_COOKIE[session_name()])) {
      setcookie(session_name(), '', time()-86400, '/');
            // get name dynamically
            // cookie text blanked
            // expired 24 hours ago
            // for the whole domain
    }
    session_destroy();
            // destroy session
    header("Location: ./blogIndex.php");
?> 
