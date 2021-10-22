<?php
include("inc/dbconnect.php");

$insert = $conn->prepare(
    "UPDATE `events`
    SET
    `name` = :eventname,
    `email` = :email,
    `zeit`= :zeit,
    `ort`= :ort,
    `beschreibung`= :beschreibung,
    `ideen`= :ideen,
    `optionen_veg` = :optionen_veg,
    `optionen_geschmack` = :optionen_geschmack
    WHERE `ID` = :eventid
    "
);

$insert->bindValue(':eventid', $_POST['eventid']);
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
    echo $_POST['optionen_geschmack'];
    if ($_POST['optionen_veg'] == "on") {
        $optionVeg = 1;
    };
} catch (Exception $e) {
};
$insert->bindValue(':optionen_veg', $optionVeg);

$optionGeschmack = 0;
try {
    if ($_POST['optionen_geschmack'] == "on") {
        $optionGeschmack = 1;
    };
} catch (Exception $e) {
};
$insert->bindValue(':optionen_geschmack', $optionGeschmack);

$insert->execute();

// redirect to eventadmin
header("Location: ./eventadmin.php?id=" . $_POST['eventid'] . "&token=1234");
die();
