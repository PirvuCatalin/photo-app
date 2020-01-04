<?php
/**
 * This first checks if the user hasn't already liked that photo, to make it impossible to like multiple times.
 * The "liked" echo means that the like has been successfully registered and the frontend should treat it accordingly.
 */
    session_start();
    $db = mysqli_connect('localhost', 'root', '', 'photoapp');
    $username = $_SESSION['username'];
    $photoId = $_GET['photoId'];
    $query = "SELECT * FROM photos_likes WHERE liker_username='$username' AND photo_id = '$photoId'";
    $results = mysqli_query($db, $query);

    if (mysqli_num_rows($results) > 0) {
        echo "alreadyLiked";
    } else {
        $insert = $db->query("INSERT into photos_likes (liker_username, photo_id) VALUES ('$username', '$photoId')");
        if($insert){
            echo "liked";
        } else{
            echo "couldntLike";
        }
    }
?>