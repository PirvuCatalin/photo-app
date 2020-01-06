<?php
/**
 * This first checks if the user is the owner of the comment.
 * Then it deletes the comment.
 */
session_start();
$db = mysqli_connect('localhost', 'root', '', 'photoapp');
$username = $_SESSION['username'];
$commentId = $_GET['commentId'];
$query = "SELECT * FROM photos_comments WHERE commenter_username='$username' AND id = '$commentId'";
$results = mysqli_query($db, $query);

if (mysqli_num_rows($results) > 0) {
    //delete comment
    $deleteComment = $db->query("DELETE FROM photos_comments WHERE id='$commentId'");
    if($deleteComment) {
        echo "deleted";
    } else{
        echo "couldntDeleteComment";
    }
} else {
    echo "notOwnerOfTheComment";
}
?>