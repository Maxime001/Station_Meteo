<?php
    // Page appelée lors du logout
    session_start();
    session_destroy();
    header('Location: index.php');