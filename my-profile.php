<?php include('server.php') ?>
<?php
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first!";
    header('location: login.php');
}
?>
<?php include('header.php'); ?>

<div id="addNewPhotoButton" class="btn btn-success">Add new photo</div>

<form hidden id="addNewPhotoForm" action="my-profile.php" method="post" enctype="multipart/form-data">
    <b>Select image to upload:</b>
    <input type="file" name="image" style="margin-top: 5px; width: 190px;"/>
    <br>
    <input class="btn btn-default center-block" type="submit" name="upload_photo" value="UPLOAD"/>
</form>

<h1 class='text-center' style='position: absolute; width: 400px; margin-top: 250px;'>Your most liked photos come first</h1>
<h2 class='text-center' style='position: absolute; width: 400px; margin-top: 800px;'>If they have the same number of likes, the most recent ones are shown</h2>
<br>
<br>
<p></p>
<?php

//select only current user's photos
$query = "select p.id, l.liker_username IS NOT NULL as liked, likes.likes  from photos p left join photos_likes l on p.id = l.photo_id and p.owner_username = l.liker_username inner join (select p.id, COALESCE(l.count, 0) as likes from photos p left join (SELECT count(*) as count, photo_id FROM photos_likes group by photo_id) l on l.photo_id = p.id) likes on likes.id = p.id where p.owner_username = '" . $_SESSION['username'] . "' order by likes.likes desc, p.datetime_added desc";
$result = mysqli_query($db, $query) or die("Couldn't retrieve photos ids! <br>" . mysqli_error($db));

//foreach photo, draw it on page
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    echo "<div class='postContainer'>";
    echo "<div class='imageContainer'>";
    echo "<img class='imageElement' src='photo.php?id=" . $row['id'] . "' alt='Looks like this image is missing or corrupted...'/>";
    echo "<img data-photo-id='" . $row['id'] . "' class='xmark' src='img/xmark.png'/>";
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
    echo "</div>";
    echo "</div>";
}

?>


<?php include('footer.php'); ?>

<script>
    $('#addNewPhotoButton').click(function (el) {
        var hidden = $('#addNewPhotoForm')[0].hidden;
        if (hidden) {
            $('#addNewPhotoForm')[0].hidden = false;
        } else {
            $('#addNewPhotoForm')[0].hidden = true;
        }
    });
</script>
<script src="js/photo-actions.js"></script>