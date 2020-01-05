<?php
    /**
     * This first checks if the user is the owner of the photo.
     * Then it deletes all info regarding that photo.
     */
    session_start();
    $db = mysqli_connect('localhost', 'root', '', 'photoapp');
    $username = $_SESSION['username'];
    $photoId = $_GET['photoId'];
    $query = "SELECT * FROM photos WHERE owner_username='$username' AND id = '$photoId'";
    $results = mysqli_query($db, $query);

    if (mysqli_num_rows($results) > 0) {
        //delete likes
        $deleteLikes = $db->query("DELETE FROM photos_likes WHERE photo_id='$photoId'");
        if($deleteLikes) {
            //delete comments
            $deleteComments = $db->query("DELETE FROM photos_comments WHERE photo_id='$photoId'");
            if($deleteComments) {
                //delete photo
                $deletePhoto = $db->query("DELETE FROM photos WHERE id='$photoId'");
                if($deletePhoto) {
                    echo "deleted";
                } else {
                    echo "couldntDeletePhoto";
                }
            }
        } else{
            echo "couldntDeleteLikes";
        }
    } else {
        echo "notOwnerOfThePhoto";
    }
?>