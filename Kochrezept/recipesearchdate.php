<form method="post" id="recipeSearchForm">
  <div class="form-group">
    <label for="dateFrom">Von:</label>
    <input type="date" class="form-control" id="dateFrom" name="dateFrom">
  </div>
  <div class="form-group">
    <label for="dateTo">Bis:</label>
    <input type="date" class="form-control" id="dateTo" name="dateTo">
  </div>

  <button type="submit" class="btn btn-primary">Suchen</button>
  <div class="form-group">
    <div class="form-check">
      <input type="radio" class="form-check-input" id="specificMonth" name="monthSelection" value="specificMonth">
      <label class="form-check-label" for="specificMonth">Bestimmter Monat</label>
      <input type="number" class="form-control" id="specificMonthInput" name="specificMonth" min="1" max="12" disabled>
    </div>
  </div>

  <div class="form-group">
    <div class="form-check">
      <input type="radio" class="form-check-input" id="lastMonth" name="monthSelection" value="lastMonth">
      <label class="form-check-label" for="lastMonth">Letzter Monat</label>
    </div>
    <div class="form-check">
      <input type="radio" class="form-check-input" id="currentMonth" name="monthSelection" value="currentMonth">
      <label class="form-check-label" for="currentMonth">Laufender Monat</label>
    </div>
    <div class="form-check">
      <input type="radio" class="form-check-input" id="noMonth" name="monthSelection" value="noMonth">
      <label class="form-check-label" for="noMonth">Keine Suche nach Monat</label>
    </div>
  </div>

  <button type="submit" class="btn btn-primary">Suchen</button>
</form>

<script>
  const specificMonthInput = document.getElementById("specificMonthInput");
  const monthSelectionRadios = document.getElementsByName("monthSelection");

  for (let i = 0; i < monthSelectionRadios.length; i++) {
    monthSelectionRadios[i].addEventListener("change", function() {
      specificMonthInput.disabled = true;
      specificMonthInput.value = "";

      if (this.id === "specificMonth") {
        specificMonthInput.disabled = false;
      }
    });
  }
</script>
<script src="scripts.js"></script>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Update the selected street name if submitted
  $res = Utils::GetRecipeNames($_POST["dateFrom"], $_POST["dateTo"], (isset($_POST["monthSelection"]) ? $_POST["monthSelection"] : false), (isset($_POST["specificMonth"]) ? $_POST["specificMonth"] : false));
      if ($res) { ?>
          <form method="post" action="">
              <label for="recipes">Ergebnisliste der Suche:</label>

              <select name="selectedrecipe" id="recipes">
                  <?php
                  foreach ($res as $recipes) {
                      echo "<option value=" . $recipes["rez_name"] . ">" . $recipes["rez_name"] . "</option>";
                  } ?>
              </select><br>
          </form>
<?php } 
      else { ?>
        <p>Keine Ergebnisse für diese Suche!</p>
<?php }
}?>