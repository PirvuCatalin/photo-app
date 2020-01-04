<?php
// include database connection
include "server.php";

// select the image
$query = "select image, imageType from photos WHERE id = " . $_GET['id'];

$result = mysqli_query($db, $query) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error($db));
$row = mysqli_fetch_array($result);
if ($row) {
    header("Content-type: " . $row["imageType"]);

    //display the image data
    print $row["image"];
    exit;
} else {
    //if no image found with the given id
}
?>