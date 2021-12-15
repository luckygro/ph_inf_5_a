<?php
include("env.php");
include("inc/dbconnect.php");
include("tpl/new.php");

// string escape https://www.php.net/manual/de/pdo.quote.php
$eventId =  $_GET['id'];

$sqlEvent = "SELECT * FROM events WHERE ID = " . $conn->quote($eventId);
$event = $conn->query($sqlEvent)->fetch();
$eventTime = strtotime($event['zeit']);
$option_veg_checked = "";
if ($event['optionen_veg'] == 1) {
    $option_veg_checked = "checked";
}
$option_geschmack_checked = "";
if ($event['optionen_geschmack'] == 1) {
    $option_geschmack_checked = "checked";
}


$optionen_veg = array(
    0 => "",
    1 => "vegetarisch",
    2 => "vegan",
);

$optionen_geschmack = array(
    0 => "",
    1 => "süß",
    2 => "deftig",
);

$optionen_geschmack_colors = array(
    0 => "",
    1 => "bg-info text-dark",
    2 => "bg-warning text-dark",
);

$eventlink = $BASE_URL . "event.php?id=" . $eventId;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />

    <!-- custom css -->
    <style>
        .heading-with-square {
            display: flex;
            align-items: center;
        }

        .square {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            width: 1em;
            height: 1em;
            flex-shrink: 0;
        }

        .square>span {
            font-size: 0.8em;
        }
    </style>
    <title>Bringmit-App</title>
</head>

<body>
    <!-- As a heading -->
    <header class="navbar navbar-light bg-light px-3 py-4">
        <div class="container">
            <h3 class="navbar-brand mb-0"><?php echo $event['name'] ?></h3>
        </div>
        <div class="container text-secondary">
            <p>
                <?php echo $event['beschreibung'] ?>
                <a href="#" class="text-secondary">weiterlesen</a>
            </p>
        </div>
        <div class="container text-secondary">
            <span><i class="bi bi-geo-fill"></i> <?php echo date("D, d.m.Y", $eventTime) ?></span>
            <span><i class="bi bi-clock"></i> <?php echo date("H:i", $eventTime) ?> Uhr </span>
        </div>
    </header>

    <div class="py-5 container">
        <h3 class="d-block py-3">Cool, dass Du unsere App nutzt!</h3>
        <p>Diesen Link kannst Du an die Teilnehmer weitergeben: <a target="_blank" href="<?php echo $eventlink ?>"><?php echo $eventlink ?></a></p>
        <p>Hier kannst Du Dein Event ändern:</p>
        <ul class="list-group">
            <li class="list-group-item bg-light">
                <form action="updateEvent.php" method="POST">
                    <input type="hidden" name="eventid" value="<?php echo $eventId ?>" />
                    <div class="mb-3">
                        <label for="eventNaame" class="form-label">Eventname</label>
                        <input type="text" value="<?php echo $event['name'] ?>" name="eventname" class="form-control" id="eventName" />
                    </div>
                    <div class="mb-3">
                        <label for="eventDatum" class="form-label">Datum</label>
                        <input type="date" value="<?php echo date("Y-m-d", $eventTime) ?>" name="datum" class="form-control" id="eventDatum" />
                    </div>
                    <div class="mb-3">
                        <label for="eventZeit" class="form-label">Zeitpunkt</label>
                        <input type="time" value="<?php echo date("H:i", $eventTime) ?>" placeholder="hh:mm" name="uhrzeit" class="form-control" id="eventZeit" />
                    </div>
                    <div class="mb-3">
                        <label for="eventOrt" class="form-label">Ort</label>
                        <input type="text" value="<?php echo $event['ort'] ?>" name="ort" class="form-control" id="eventOrt" />
                    </div>
                    <div class="mb-3">
                        <label for="eventBeschreibung" class="form-label">Beschreibung</label>
                        <textarea name="beschreibung" value="" class="form-control" id="eventBeschreibung"><?php echo $event['beschreibung'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="eventIdeen" class="form-label">Ideen</label>
                        <input type="text" value="<?php echo $event['ideen'] ?>" name="ideen" class="form-control" id="eventIdeen" aria-describedby="ideenHelp" />
                        <div id="ideenHelp" class="form-text">
                            Helfe deinen Teilnehmern indem du hier Ideen, was mitgebracht werden
                            kann, durch Kommas getrenn einfügst.
                        </div>
                    </div>

                    <!-- optionen -->
                    <fieldset class="mb-3">
                        <span class="strong">Details abfragen</span>
                        <div class="my-2 form-check form-switch">
                            <input class="form-check-input" <?php echo $option_veg_checked ?> name="optionen_veg" type="checkbox" role="switch" id="vegtVegan" />
                            <label class="form-check-label" for="vegtVegan">vegetarisch / vegan</label>
                        </div>
                        <div class="mt-2 form-check form-switch">
                            <input class="form-check-input" <?php echo $option_geschmack_checked ?> name="optionen_geschmack" type="checkbox" role="switch" id="suessDeftig" />
                            <label class="form-check-label" for="suessDeftig">süß / deftig</label>
                        </div>
                    </fieldset>
                    <div class="mb-3">
                        <label for="emailAdresse" class="form-label">Emailadresse</label>
                        <input type="email" readonly value="<?php echo $event['email'] ?>" name="email" class="form-control" id="emailAdresse" aria-describedby="emailHelp" />
                        <div id="emailHelp" class="form-text">
                            Wir haben Dir einen Link zu dieser Seite per E-Mail gesendet.
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">speichern</button>
                </form>
            </li>
        </ul>
    </div>
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>