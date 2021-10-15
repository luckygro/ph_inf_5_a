<?php
function createMitbringselFields($eventId, $row)
{
    $isNew = $row != null;
    if (!$isNew) {
        $row = array(
            "wer" => "",
            "was" => "",
            "wieviel" => "",
            "option_geschmack" => 0,
            "option_veg" => 0,
        );
    };
?>
    <input type="hidden" name="eventid" value="<?php echo $eventId ?>" ?>
    <?php if ($isNew) { ?>
        <input type="hidden" name="rowid" value="<?php echo $row['id'] ?>" ?>
    <?php } ?>
    <div class="mb-3">
        <label for="Name" class="form-label">Name</label>
        <input type="text" required name="wer" class="form-control" id="Name" value="<?php echo $row['wer'] ?>">
    </div>
    <div class="mb-3">
        <label for="Was bringe ich mit" class="form-label">Was bringe ich mit</label>
        <input type="text" required name="was" class="form-control" id="Was bringe ich mit" value="<?php echo $row['was'] ?>">
    </div>
    <div class=" mb-3">
        <label for="Menge" class="form-label">Menge</label>
        <input type="text" name="wieviel" class="form-control" id="Menge" value="<?php echo $row['wieviel'] ?>">
    </div>
    <div>
        <?php createRadioOption("option_geschmack", "Süß", 1, $row['option_geschmack']) ?>
        <?php createRadioOption("option_geschmack", "Deftig", 2, $row['option_geschmack']) ?>
        <?php createRadioOption("option_geschmack", "Keine Angabe", 0, $row['option_geschmack']) ?>
    </div>
    <div class=" mt-3">
        <?php createRadioOption("option_veg", "Vegetarisch", 1, $row['option_veg']) ?>
        <?php createRadioOption("option_veg", "Vegan", 2, $row['option_veg']) ?>
        <?php createRadioOption("option_veg", "Keine Angabe", 0, $row['option_veg']) ?>
    </div>
<?php } ?>

<?php
function createRadioOption($name, $label, $value, $currentValue)
{
    $fieldId = "id" . $name . $value;
    $checked = "";
    if ($currentValue == $value) {
        $checked = 'checked="checked"';
    };
?>

    <div class="form-check form-check-inline">
        <input class="form-check-input" <?php echo $checked ?> type="radio" name="<?php echo $name ?>" id="<?php echo $fieldId ?>" value="<?php echo $value ?>">
        <label class="form-check-label" for="<?php echo $fieldId ?>"><?php echo $label ?></label>
    </div>
<?php } ?>