<?php
include("inc/dbconnect.php");
$eventId =  $_GET['id']
?>

<!doctype>
<html>

<head>
</head>

<body>
    <h1>DB-Projekt</h1>
    <span>Parameter</span><span>

        <?php
        echo $eventId;
        ?>

    </span>
</body>

</html>