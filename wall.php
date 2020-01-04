<?php
    session_start();

    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first!";
        header('location: login.php');
    }
?>

<?php include('header.php'); ?>


<?php include('footer.php'); ?>
