<?php 
	session_start(); 

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first!";
		header('location: login.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php?logout=true");
	}

?>
<?php include('header.php') ?>

	<div style="padding: 15px;">

		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="alert alert-success" style="width: 175px;">
					<?php
						echo $_SESSION['success'];
						unset($_SESSION['success']);
					?>
			</div>
		<?php endif ?>

		<!-- logged in user information -->
		<?php  if (isset($_SESSION['username'])) : ?>
			<h2>Welcome to PhotoApp, <strong><?php echo $_SESSION['username']; ?></strong>!</h2>
        <h3>Why don't you check the latest updates on the <a href="wall.php">Wall</a>?</h3>
		<?php endif ?>
	</div>
		
<?php include('footer.php') ?>