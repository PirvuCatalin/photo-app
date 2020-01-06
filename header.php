
<html>
<head>
    <title>PhotoApp</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <base href="/photoapp/">
</head>
<body>

<nav role="navigation" class="navbar navbar-default">

    <div class="">
        <a href="http://www.github.com/PirvuCatalin" class="navbar-brand">PhotoApp</a>
    </div>

    <div class="navbar-collapse" style="background-color: mediumseagreen">
        <ul class="nav navbar-nav">
            <li <?php if (parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) == "/photoapp/index.php") echo "class='active'" ?>><a href="index.php">Home</a></li>
            <li <?php if (parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) == "/photoapp/wall.php") echo "class='active'" ?>><a href="wall.php">Wall</a></li>
            <li <?php if (parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) == "/photoapp/my-profile.php") echo "class='active'" ?>><a href="my-profile.php">My Profile</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li <?php if (parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) == "/photoapp/login.php" || parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) == "/photoapp/register.php") echo "class='active'" ?>><a href="index.php?logout='1'">Logout</a></li>
        </ul>
    </div>
</nav>