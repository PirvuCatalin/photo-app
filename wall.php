<?php include('server.php') ?>
<?php
    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first!";
        header('location: login.php');
    }
?>

<?php include('header.php'); ?>
<h1 class='text-center' style='margin-bottom: 50px; margin-top: 50px;'>The wall</h1>
<h2 class='text-center' style='position: absolute; width: 400px; margin-top: 130px;'>The most recent photos are shown first</h2>
<h2 class='text-center' style='position: absolute; width: 400px; margin-top: 330px;'>Your photos are highlighted with a red border</h2>
<?php

//select all photos
$username = $_SESSION['username'];
$query = "select p.id, p.datetime_added, l.liker_username IS NOT NULL as liked, p.owner_username, likes.likes  from photos p left join photos_likes l on p.id = l.photo_id and l.liker_username = '" . $username . "' inner join (select p.id, COALESCE(l.count, 0) as likes from photos p left join (SELECT count(*) as count, photo_id FROM photos_likes group by photo_id) l on l.photo_id = p.id) likes on likes.id = p.id order by p.datetime_added desc";
$result = mysqli_query($db, $query) or die("Couldn't retrieve photos ids! <br>" . mysqli_error($db));

//foreach photo, draw it on page
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    echo "<div class='postContainer'>";
    echo "<div style='display: flex;'>";
    if($username == $row['owner_username']) {
        echo "<div class='imageContainer imageContainerMine'>";
    } else {
        echo "<div class='imageContainer'>";
    }

    echo "<img class='imageElement' src='photo.php?id=" . $row['id'] . "' alt='Looks like this image is missing or corrupted...'/>";
    if($username == $row['owner_username']) {
        echo "<img data-photo-id='" . $row['id'] . "' class='xmark' src='img/xmark.png'/>";
    }
    echo "</div>";

    include('comments.php');
    echo "</div>";

    echo "<div class='socialContainer'>";
    if($row['liked'] == 1) {
        echo "<img class='image-hover-highlight cameraLike' data-photo-id='" . $row['id'] . "'  src='img/camera-like-fill.png'/>";
        echo "<img hidden class='image-hover-highlight cameraDislike' data-photo-id='" . $row['id'] . "'  src='img/camera-like.png'/>";
    } else {
        echo "<img hidden class='image-hover-highlight cameraLike' data-photo-id='" . $row['id'] . "'  src='img/camera-like-fill.png'/>";
        echo "<img class='image-hover-highlight cameraDislike' data-photo-id='" . $row['id'] . "'  src='img/camera-like.png'/>";
    }
    echo "<div class='numberOfLikes'>" . $row['likes'] . ($row['likes'] == 1 ? " like" : " likes") . "</div>";
    echo "<div class='ownerAndDatetime'>";
    if($username != $row['owner_username']) {
        echo "<div class='photoOwner'>" . $row['owner_username'] . "</div>";
    }
    echo "<div class='photoDatetime'>" . $row['datetime_added'] . "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
}

?>


<?php include('footer.php'); ?>
<script src="js/photo-actions.js"></script>