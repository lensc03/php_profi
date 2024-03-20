<?php
 
if (isset($_POST["button"]))
{
//Funktion einbinden
  require_once("DBfunction.php");

//Eingabedaten speichern
  $SVN=$_POST["1"];
  $GD=$_POST["2"];
  $ST=isset($_POST["3"]) ? $_POST["3"] : NULL;
  $EN=isset($_POST["4"]) ? $_POST["4"] : NULL;

  //Eingegebene Daten ausgeben.
  
  echo '<h2>Suchkriterien</h2>';
  echo '<p>SV-Nummer: '.$SVN.'/'.$GD.'</p>';

  if (!empty($ST))
  {
    echo '<p>Beginn-Zeitraum: '.$ST.'</p>';
  }

if (!empty($EN))
{
  echo '<p>Beginn-Zeitraum: '.$EN.'</p>';
}
echo $EN;
echo $SVN;
echo $ST;
echo $GD;
//Ergebnisse von Datenbank beabreiten
$dbresults=Databasefunction::GetDiagnoseData($SVN,$GD,$ST,$EN);
if ($dbresults){
//Tabelle erstellen zu anzeige von daten.
  ?>
  <table>
    <thead>
      <tr>
        <th>Zeitraum</th>
        <th>Patient</th>
        <th>SVNr</th>
        <th>Diagnose</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      foreach($dbresults as $data){
        echo '<tr>';
        echo '<td>'.$data['Zeitraum'].'</td>';
        echo '<td>'.$data['Patient'].'</td>';
        echo '<td>'.$data['SVNr'].'</td>';
        echo '<td>'.$data['Diagnose'].'</td>';
        echo '</tr>';
      }
      ?>
    </tbody>
  </table>
  <?php

}
else
{

  echo '<h1>  Keine Daten vorhanden </h1>';

}
}
else{ ?>
  <html lang="en">
<head>
  <title>Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <ul class="nav navbar-nav">
  <p class="navbar-text">SEARCH</p>
<a class="navbar-text" href="index.php">BACK</a>
  </ul>
</nav>

<form method="post">
<h1 style="text-align: center">Patienten-Diagnose</h1>
<p style="text-align: center">   Versicherungsnummer <input type="string" name="1" required> </p>
<p style="text-align: center">   Geburtsdatum  <input type="date" name="2" required> </p>


<h1 style="text-align: center">Behandlungszeitraum</h1>

    <p style="text-align: center">   Start:  <input type='date'name="3" > </p>
    <p style="text-align: center">   Ende:  <input type='date' name="4" > </p>

    <p style="text-align: center"><input type="submit" name='button'></p>
</form>
<?php
}
 ?>
