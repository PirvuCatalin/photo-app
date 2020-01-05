<?php
    session_start();
    $db = mysqli_connect('localhost', 'root', '', 'photoapp');
    $username = $_SESSION['username'];
    $photoId = $_GET['photoId'];
    $comment = $_GET['comment'];
    $commentTrimmed = trim($comment);

    $dataTime = date("Y-m-d H:i:s");

    if(strlen($commentTrimmed) > 0 && strlen($commentTrimmed) < 256 ) {
        $insert = $db->query("INSERT into photos_comments (photo_id, commenter_username, datetime_added, comment) VALUES ('$photoId', '$username', '$dataTime', '$commentTrimmed')");
        if($insert){
            $response = '{"comment":"' . $commentTrimmed . '","dataTime":"' . $dataTime . '","username":"' . $username . '"}';
            echo $response;
        } else{
            $response = '{"bad":"couldntComment"}';
            echo $response;
        }
    } else {
        $response = '{"bad":"wrongComment"}';
        echo $response;
    }
?>