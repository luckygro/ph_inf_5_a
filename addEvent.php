<?php
include("inc/dbconnect.php");
include("env.php");

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

// send mail with links
$BASE_URL = getenv("BASE_URL");
$eventlink = $BASE_URL . "event.php?id=" . $lastInsertId;
$eventadminlink = $BASE_URL . "eventadmin.php?id=" . $lastInsertId;

// Mailserver muss aufgesetzt sein (z.B. sendmail)
$empfaenger = $_POST['email'];
$betreff = "Bringmit-App: Links";
$from = "From: Bringmit-App <no-reply@bringmitapp.de>";
$text = "Danke, dass du die Bringmit-App nutzt!
Link zum Weitergeben: " . $eventlink . "
Link zur Admin-Oberfläche: " . $eventadminlink;
mail($empfaenger, $betreff, $text, $from);

// redirect to eventadmin
header("Location: ./eventadmin.php?id=" . $lastInsertId . "&token=1234");
die();
