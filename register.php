<?php include('server.php') ?>
<?php include('header.php') ?>

    <div class="container login-container">
		<h2>Register</h2>
        <br>

	<form method="post" action="register.php">

		<?php include('errors.php'); ?>

		<div class="center-block input-group text-input">
			<label>Username</label>
			<input class="form-control" type="text" name="username" value="<?php echo $username; ?>">
		</div>
		<div class="center-block input-group text-input">
			<label>Email</label>
			<input class="form-control" type="email" name="email" value="<?php echo $email; ?>">
		</div>
		<div class="center-block input-group text-input">
			<label>Password</label>
			<input class="form-control" type="password" name="password_1">
		</div>
		<div class="center-block input-group text-input">
			<label>Confirm password</label>
			<input class="form-control" type="password" name="password_2">
		</div>
        <br>
        <br>
        <br>
		<div class="center-block input-group">
			<button type="submit" class="btn btn-success" name="reg_user">Register</button>
		</div>
		<p>
			<b>Already have an account? <a href="login.php">Sign in.</a></b>
		</p>
	</form>

    </div>
<?php include('footer.php') ?>