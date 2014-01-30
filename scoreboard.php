<!DOCTYPE html>
<html>
<head>
<title>Scoreboard | Break In</title>
<link rel="stylesheet" href="styles/bootstrap.min.css">
<link rel="stylesheet" href="styles/bootstrap-responsive.min.css">
<?php include_once 'includer.php'; ?>
<style>
.container {
    background-color: rgba(0, 0, 0, 0.2);
    border-radius: 4px;
    padding: 1em;
}
</style>
</head>
<body>
<div class="content-wrapper">
<?php include_once 'home/masthead.php'; ?>
<?php include_once 'navbar.php'; ?>
<div class="content">
<div class="container">
<?php include_once 'rank.php'; ?>
</div>
</div>
</div>
<?php include_once 'footer.php'; ?>
</body>
