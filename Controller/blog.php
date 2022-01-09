<?php
require "../Model/entity/user.php";
require "../Model/entity/customer.php";
require "../Model/entity/adviser.php";
require "../Model/login.php";
session_start();
include "../template/header.php";
include "../template/nav.php";
require "../View/blogView.php";
include "../template/footer.php";
?>
<script src="../js/blog_page.js"></script>
