<?php

if (isset($_POST['save']))
{
    $ort = $_POST['ort'];
    echo '<h3>Wollen Sie den Ort '.$ort.' wirklich speichern?</h3>';
    ?>
    <form method="post">
        <br>
        <input type="hidden" name="newort" value=<?php echo $_POST['ort'];; ?>>
        <input type="submit" name="ja" value="ja">
        <input type="submit" name="nein" value="nein">
    </form>
    <?php
}
if (isset($_POST['ja']))
{
    $newort = $_POST['newort'];

    if (Utils::Update($newort))
    {
        try {
            $insertQuery = 'insert into arbeit (beruf) values (?)';
            $arrayV = array($newort);
            Utils::makeStatement($insertQuery, $arrayV);
    
            echo '<h3>der Ort '.$newort.' wurde gespeichert.</h3>';
    
            $query  = 'select * from arbeit order by beruf';
            Utils::makeTable($query);
        }catch (Exception $e){
            echo 'Error - Ort einfügen - '.$e->getCode().': '.$e->getMessage().'<br>';
        }
    }
}
else{
    echo '<h2>Neuen Ortsnamen eingeben</h2>';
    ?>
    <form method="post">
        <label for="ortname">Neuen Ortsnamen eingeben:</label>
        <input type="text" id="ortname" name="ort" required placeholder="z.B. Linz">
        <br>
        <input type="submit" name="save" value="speichern">
    </form>

    <?php
    $query  = 'select * from arbeit order by beruf';
    Utils::makeTable($query);
}