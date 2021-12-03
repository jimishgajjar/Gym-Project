<?php
session_start();
date_default_timezone_set("Asia/Kolkata");
if (empty($_SESSION["adminId"]) && empty($_SESSION["adminEmail"])) {
    echo "<script>window.location.replace('index.php');</script>";
} else {
    return true;
}
