<?php
    // Starting a session to destroy it and send the user to login page
    session_start();

    session_unset();
    session_destroy();

    echo '<script>location.replace("../../view/loginScreen");</script>';
?>