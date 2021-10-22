<?php
include("inc/dbconnect.php");

$insert = $conn->prepare(
    "INSERT into `events`
    SET
    `name` = :eventname,
    `email` = :email,
    `zeit`= :zeit,
    `ort`= :ort,
    `beschreibung`= :beschreibung,
    `ideen`= :ideen,
    `optionen_veg` = :optionen_veg,
    `optionen_geschmack` = :optionen_geschmack;
    SELECT LAST_INSERT_ID();
    "
);

$insert->bindValue(':eventname', $_POST['eventname']);
$insert->bindValue(':email', $_POST['email']);

// workaround um input datetime zu vermeiden (wg. safari)
$timeVal = strtotime($_POST['uhrzeit']);
$dateVal = strtotime($_POST['datum']);
$combinedTime = date("Y-m-d", $dateVal) . " " . date("H:i:s", $timeVal);

$insert->bindValue(':zeit', $combinedTime);
$insert->bindValue(':ort', $_POST['ort']);
$insert->bindValue(':beschreibung', $_POST['beschreibung']);
$insert->bindValue(':ideen', $_POST['ideen']);

$optionVeg = 0;
try {
    if (boolval($_POST['optionen_veg'])) {
        $optionVeg = 1;
    };
} catch (Exception $e) {
};
$insert->bindValue(':optionen_veg', $optionVeg);

$optionGeschmack = 0;
try {
    if (boolval($_POST['optionen_geschmack'])) {
        $optionGeschmack = 1;
    };
} catch (Exception $e) {
};
$insert->bindValue(':optionen_geschmack', $optionGeschmack);

$insert->execute();
$lastInsertId = $conn->lastInsertId();

// redirect to eventadmin
header("Location: ./event.php?id=" . $lastInsertId . "&admin=1234");
die();
