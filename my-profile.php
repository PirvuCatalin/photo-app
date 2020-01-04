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

<br>
<br>
<p></p>
<?php
$query = "select p.id, l.liker_username IS NOT NULL as liked from photos p left join photos_likes l on p.id = l.photo_id and p.owner_username = l.liker_username where p.owner_username = '" . $_SESSION['username'] . "'";
$result = mysqli_query($db, $query) or die("Couldn't retrieve photos ids! <br>" . mysqli_error($db));

//foreach photo, draw it on page
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    echo "<div class='postContainer'>";
    echo "<div class='imageContainer'>";
    echo "<img class='imageElement' src='photo.php?id=" . $row['id'] . "' alt='Looks like this image is missing or corrupted...'/>";
    echo "</div>";
    echo "<div class='socialContainer'>";
    echo "<div style='margin-left: 5px;'>7</div>";
    if($row['liked'] == 1) {
        echo "<img class='image-hover-highlight cameraLike' data-photo-id='" . $row['id'] . "'  src='img/camera-like-fill.png'/>";
        echo "<img hidden class='image-hover-highlight cameraDislike' data-photo-id='" . $row['id'] . "'  src='img/camera-like.png'/>";
    } else {
        echo "<img hidden class='image-hover-highlight cameraLike' data-photo-id='" . $row['id'] . "'  src='img/camera-like-fill.png'/>";
        echo "<img class='image-hover-highlight cameraDislike' data-photo-id='" . $row['id'] . "'  src='img/camera-like.png'/>";
    }

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

    $('.cameraLike').click(function (el) {
        var that = $(this);
        var photoId = that.data("photo-id");
        $.ajax({
            url: "/photoapp/dislike.php?photoId=" + photoId,
            type: 'GET',
            success: function (response) {
                if(response === "disliked") {
                    that.hide();
                    that.parent().find('.cameraDislike').show();
                }
            }
        });
    });

    $('.cameraDislike').click(function (el) {
        var that = $(this);
        var photoId = that.data("photo-id");
        $.ajax({
            url: "/photoapp/like.php?photoId=" + photoId,
            type: 'GET',
            success: function (response) {
                if(response === "liked") {
                    that.hide();
                    that.parent().find('.cameraLike').show();
                }
            }
        });
    });

</script>