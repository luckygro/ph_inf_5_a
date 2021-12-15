<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />

    <title>Bringmit-App</title>
</head>

<body>
    <!-- Header -->
    <nav class="navbar navbar-light bg-light">
        <div class="container">
            <h1 class="navbar-brand mb-0">Bringmit-App</h1>
        </div>
    </nav>

    <div class="container pt-5">
        <form action="addEvent.php" method="POST">
            <h3>Organisiere dein Event!</h3>
            <div class="mb-3">
                <label for="eventName" class="form-label">Eventname</label>
                <input type="text" name="eventname" class="form-control" id="eventName" />
            </div>
            <div class="mb-3">
                <label for="eventDatum" class="form-label">Datum</label>
                <input type="date" placeholder="yyyy-mm-dd" name="datum" class="form-control" id="eventDatum" />
            </div>
            <div class="mb-3">
                <label for="eventZeit" class="form-label">Zeitpunkt</label>
                <input type="time" placeholder="hh:mm" name="uhrzeit" class="form-control" id="eventZeit" />
            </div>
            <div class="mb-3">
                <label for="eventOrt" class="form-label">Ort</label>
                <input type="text" name="ort" class="form-control" id="eventOrt" />
            </div>
            <div class="mb-3">
                <label for="eventBeschreibung" class="form-label">Beschreibung</label>
                <textarea name="beschreibung" class="form-control" id="eventBeschreibung"></textarea>
            </div>
            <div class="mb-3">
                <label for="eventIdeen" class="form-label">Ideen</label>
                <input type="text" name="ideen" class="form-control" id="eventIdeen" aria-describedby="ideenHelp" />
                <div id="ideenHelp" class="form-text">
                    Helfe deinen Teilnehmern indem du hier Ideen, was mitgebracht werden
                    kann, durch Kommas getrenn einfügst.
                </div>
            </div>

            <!-- optionen -->
            <fieldset class="mb-3">
                <span class="strong">Details abfragen</span>
                <div class="my-2 form-check form-switch">
                    <input class="form-check-input" checked name="optionen_veg" type="checkbox" role="switch" id="vegtVegan" />
                    <label class="form-check-label" for="vegtVegan">vegetarisch / vegan</label>
                </div>
                <div class="mt-2 form-check form-switch">
                    <input class="form-check-input" checked name="optionen_geschmack" type="checkbox" role="switch" id="suessDeftig" />
                    <label class="form-check-label" for="suessDeftig">süß / deftig</label>
                </div>
            </fieldset>
            <div class="mb-3">
                <label for="emailAdresse" class="form-label">Emailadresse</label>
                <input type="email" name="email" class="form-control" id="emailAdresse" aria-describedby="emailHelp" />
                <div id="emailHelp" class="form-text">
                    Wir senden dir den Link zur Planungsseite per E-Mail.
                </div>
            </div>

            <button type="submit" class="btn btn-primary">erstellen</button>
        </form>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>