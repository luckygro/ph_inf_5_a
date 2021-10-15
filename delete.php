<?php
include("inc/dbconnect.php");

$id = intval($_POST["id"]);
$eventid = intval($_POST["eventid"]);
$delete = $conn->prepare(
    "DELETE from `mitbringsel` WHERE `id` = :id"
);

$delete->bindValue(':id', $id);
$delete->execute();

header("Location: ./event.php?id=" . $eventid);
die();
