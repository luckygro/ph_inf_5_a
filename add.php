<?php
include("inc/dbconnect.php");

$eventidstring = $_POST["eventid"];
$eventid = intval($_POST["eventid"]);
$insert = $conn->prepare(
    "INSERT into `mitbringsel`
    SET
    `eventid` = :eventid,
    `wer` = :wer,
    `was`= :was,
    `wieviel`= :wieviel,
    `option_veg` = :option_veg,
    `option_geschmack` = :option_geschmack"
);

$insert->bindValue(':eventid', $eventid);
$insert->bindValue(':wer', $_POST['wer']);
$insert->bindValue(':was', $_POST['was']);
$insert->bindValue(':wieviel', $_POST['wieviel']);
$insert->bindValue(':option_veg', (int)$_POST['option_veg']);
$insert->bindValue(':option_geschmack', (int)$_POST['option_geschmack']);

$insert->execute();

header("Location: ./event.php?id=" . $eventid);
die();
