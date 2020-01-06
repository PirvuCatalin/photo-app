<?php

echo "<div class='commentsContainer'>";
echo "<div class='commentsTab'>";
echo "<h5 class='text-center'>Comments</h5>";

$username = $_SESSION['username'];

$photoId = $row['id']; // coming from the caller
$query = "SELECT id, commenter_username, datetime_added, comment FROM photos_comments WHERE photo_id = '$photoId' order by datetime_added asc";

$results = mysqli_query($db, $query);

if (mysqli_num_rows($results) > 0) {
    while ($line = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
        echo "<div class='photoComment js-addcomment'>";
        echo "<div class='photoCommentHeader'>";
        echo "<div class='commentOwner'>" . $line['commenter_username'] . "</div>";
        echo "<div class='commentDatetime'>" . $line['datetime_added'] . "</div>";
        echo "</div>";
        if($line['commenter_username'] == $username) {
            echo "<img data-comment-id='" . $line['id'] . "' class='xmark-comment' src='img/xmark.png'/>";
        }
        echo "<div class='commentText'>" . $line['comment'] . "</div>";
        echo "</div>";
    }
} else {
    echo "<div class='text-center js-addcomment js-dummy-comment' style='opacity: 0.5'>No comments available</div>";
}


echo "</div>";
echo "<div class='newComment'>";
echo "<input type='text' required class='newCommentText' name='comment' placeholder='Your comment here...'/>";
echo "<input disabled data-photo-id='" . $row['id'] . "' maxlength='255' onclick='addComment(this)' class='commentButton btn btn-success btn-xs' type=submit value='Comment'/>";
echo "</div>";
echo "</div>";

?>