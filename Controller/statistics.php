<?php
require "../Model/entity/user.php";
require "../Model/entity/customer.php";
require "../Model/entity/adviser.php";
require "../Model/login.php";
session_start();
include "../template/header.php";
include "../template/nav.php";
require "../View/statisticsView.php";
include "../template/footer.php";
?>

<script src="../js/statistics_page.js"></script>