<?php
include("inc/dbconnect.php");

$eventid = intval($_POST["eventid"]);

$update = $conn->prepare(
    "UPDATE `mitbringsel`
    SET
    `wer` = :wer,
    `was`= :was,
    `wieviel`= :wieviel,
    `option_veg` = :option_veg,
    `option_geschmack` = :option_geschmack
    WHERE `id` = :id"
);

$update->bindValue(':id', (int)$_POST['rowid']);
$update->bindValue(':wer', $_POST['wer']);
$update->bindValue(':was', $_POST['was']);
$update->bindValue(':wieviel', $_POST['wieviel']);
$update->bindValue(':option_veg', (int)$_POST['option_veg']);
$update->bindValue(':option_geschmack', (int)$_POST['option_geschmack']);

$update->execute();

header("Location: ./event.php?id=" . $eventid);
die();
