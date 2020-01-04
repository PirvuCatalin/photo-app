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
    $delete = $db->query("DELETE FROM photos_likes WHERE liker_username='$username' AND photo_id = '$photoId'");
    if($delete) {
        echo "disliked";
    } else{
        echo "couldntDislike";
    }
} else {
    echo "alreadyDisliked";
}
?>