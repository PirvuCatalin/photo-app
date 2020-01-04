<?php include('server.php'); ?>
<?php include('header.php'); ?>

    <div class="container login-container">
        <h2>Login</h2>
        <form method="post" action="login.php">

            <?php include('errors.php'); ?>

            <?php if (isset($_SESSION['msg']) && count($errors) == 0) : ?>
                <div class="login-messages alert alert-warning">
                    <p><?php echo $_SESSION['msg'] ?></p>
                </div>
            <?php endif ?>

            <?php if (isset($_GET['logout'])) : ?>
                <div class="login-messages alert alert-success">
                    <p>You have successfully logged out!</p>
                </div>
            <?php endif ?>
            <br>
            <div class="center-block input-group text-input">
                <label>Username</label>
                <input class="form-control" type="text" name="username">
            </div>
            <div class="center-block input-group text-input">
                <label>Password</label>
                <input class="form-control" type="password" name="password">
            </div>
            <br>
            <br>
            <br>
            <div class="center-block input-group">
                <button type="submit" class="btn btn-success" name="login_user">Login</button>
            </div>
            <p>
                <b>New? <a href="register.php">Create an account.</a></b>
            </p>
        </form>

    </div>

<?php include('footer.php') ?>