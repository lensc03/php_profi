<?php
include 'DBcon.php';
global $con;

if(isset($_POST['save'])){
    echo'<h1>Ihre Daten wurden gespeichert</h1>';
}else {
    echo '<h1>Registrieren</h1>
<form method="post">
  <div class="mb-3">
    <label for="floatingInput" class="form-label">Vorname</label>
    <input type="text" class="form-control">
    <label for="floatingInput" class="form-label">Nachname</label>
    <input type="text" class="form-control">
  </div>
  <div class="mb-3">
    <label for="floatingInput" class="form-label">Land</label>
    <select class="form-select" aria-label="Default select example">
        <option selected>land auswählen</option>
        <option value="1">Österreich</option>
        <option value="2">Deutschland</option>
        <option value="3">Schweiz</option>
    </select>
  </div>
  <label for="floatingInput" class="form-label">Höchste Ausbildung</label>
  <div id="ausbildung" class="mb-3">
  <div class="form-check">
  <input class="form-check-input" type="radio" name="ausbildung" id="ausbildung_ahs">
  <label class="form-check-label" for="flexRadioDefault1">
    Ahs
  </label>
    </div>
    
    <div class="form-check">
  <input class="form-check-input" type="radio" name="ausbildung" id="ausbildung_htl">
  <label class="form-check-label" for="flexRadioDefault2">
    HTL
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="ausbildung" id="ausbildung_uni">
  <label class="form-check-label" for="flexRadioDefault2">
    Uni
  </label>
</div>
</div>
    <div class="mb-3">
    <label for="floatingInput" class="form-label">Welche der folgenden Bücher hast Du schon gelesen:</label>
   <div class="form-check">
    <input class="form-check-input" type="checkbox" value="Ringe" id="BuchRinge" name="BuchRinge">
    <label class="form-check-label" for="flexCheckDefault">
        Herr der Ringe
    </label>
    </div>
    <div class="form-check">
    <input class="form-check-input" type="checkbox" value="Harry" id="BuchHarry" name="BuchHarry">
    <label class="form-check-label" for="flexCheckDefault">
        Harry Potter
    </label>
  </div>
</div>
<div class="mb-3">
    <label for="Hobbys" class="form-label">Hobbys</label>
    <input id="Hobbys" type="text" class="form-control">
    <label for="Haustiere" class="form-label">Haustiere</label>
    <input id="Haustiere" type="text" class="form-control">
  </div>
  <div class="mb-3">
  <div class="form-check">
    <input class="form-check-input" type="checkbox" value="accepted" id="getsEmail" name="getsEmail" onchange="document.getElementById(\'Emailtest\').disabled = !this.checked;">
    <label class="form-check-label" for="getsEmail">
        Willst Du einen Newsletter beziehen
    </label>
  </div>
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="Emailtest" aria-describedby="emailHelp" name="Emailtest">
    <div id="emailHelp" class="form-text">We\'ll never share your email with anyone else.</div>
  </div>
  <button type="submit" class="btn btn-primary" name="save" value="speichern">Submit</button>
</form>';
}
?>

