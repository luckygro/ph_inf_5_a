<?php
include("inc/dbconnect.php");
include("tpl/new.php");

// string escape https://www.php.net/manual/de/pdo.quote.php
$eventId =  $_GET['id'];

$sqlEvent = "SELECT * FROM events WHERE ID = " . $conn->quote($eventId);
$event = $conn->query($sqlEvent)->fetch();

$sqlMitbringsel = "SELECT * FROM mitbringsel WHERE eventId = " . $eventId;
$mitbringsel = $conn->query($sqlMitbringsel)->fetchAll();

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
            <span><i class="bi bi-geo-fill"></i> <?php echo $event['ort'] ?></span>
            <span><i class="bi bi-clock"></i> <?php echo $event['datum'] ?> Uhr </span>
        </div>
    </header>
    <div class="container py-4">
        <h5 class="ms-3 my-3">Das ist am Start:</h5>
        <ul class="list-group">
            <?php foreach ($mitbringsel as $row) { ?>
                <?php
                /* LIST ITEM === */
                $rowId = $row['id'];
                $option_veg = $row['option_veg'];
                $option_geschmack = $row['option_geschmack'];
                $keine_angabe = ($option_veg + $option_geschmack) == 0 && $row['wieviel'] == "";
                ?>
                <li class="
            list-group-item
            d-flex justify-content-between align-items-start
          ">
                    <div>
                        <div class="me-auto">
                            <div class="text-secondary mb-1">
                                <i class="bi bi-person-fill mr-2"></i>
                                <span><?php echo $row['wer'] ?></span>
                            </div>
                            <h5 class="fw-bold">
                                <span><?php echo $row['was'] ?></span>
                            </h5>
                        </div>
                        <div>
                            <?php if ($row['wieviel'] != "") { ?>
                                <span class="badge rounded-pill bg-secondary"><?php echo $row['wieviel'] ?></span>
                            <?php } ?>
                            <?php if ($option_veg != 0) { ?>
                                <span class="badge rounded-pill bg-success ms-1"><?php echo $optionen_veg[$option_veg] ?></span>
                            <?php } ?>
                            <?php if ($option_geschmack != 0) { ?>
                                <span class="badge rounded-pill <?php echo $optionen_geschmack_colors[$option_geschmack] ?> ms-1"><?php echo $optionen_geschmack[$option_geschmack] ?></span>
                            <?php } ?>
                            <?php if ($keine_angabe) { ?>
                                <span class="badge rounded-pill bg-light text-dark ">keine Angaben</span>
                            <?php } ?>
                        </div>
                    </div>
                    <div>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#edit<?php echo $rowId ?>" class="btn btn-light">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#delete<?php echo $rowId ?>" class="btn btn-light">
                            <i class="bi bi-trash-fill text-danger"></i>
                        </button>
                    </div>
                    <div class="modal fade" id="delete<?php echo $rowId ?>" tabindex="-1" aria-labelledby="delete<?php echo $rowId ?>label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <form action="delete.php" method="POST" class="modal-content">
                                <input type="hidden" name="eventid" value="<?php echo $eventId ?>" />
                                <input type="hidden" name="id" value="<?php echo $rowId ?>" />
                                <div class="modal-body">
                                    Wollen Sie das Mitbringsel <b><?php echo $row['was'] ?></b> wirklich löschen?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
                                    <button type="submit" class="btn btn-danger">löschen</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal fade" id="edit<?php echo $rowId ?>" tabindex="-1" aria-labelledby="edit<?php echo $rowId ?>label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <form action="edit.php" method="POST" class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="edit<?php echo $rowId ?>label">Mitbringsel bearbeiten</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Abbrechen"></button>
                                </div>
                                <div class="modal-body">
                                    <?php createMitbringselFields($eventId, $row) ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
                                    <button type="submit" class="btn btn-primary">Speichern</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </li>
                <?php /* LIST ITEM === */ ?>
            <?php } ?>
            <li class="
            bg-light
            list-group-item
            d-flex justify-content-between align-items-start
          ">
                <form action="./add.php" method="POST" class="py-4">
                    <?php createMitbringselFields($eventId, null) ?>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Eintragen</button>
                    </div>
                </form>
            </li>
        </ul>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>