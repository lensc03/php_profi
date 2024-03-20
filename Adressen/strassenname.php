

<?php
if (isset($_POST['save'])){
    $strasse = $_POST['strasse'];
    try {
        $insertQuery = 'insert into strasse (str_name) values(?)';
        $arrayV = array($strasse);
        makeStatement($insertQuery, $arrayV);

        $strID = $con->lastInsertId();
        echo '<h3>Die neue Strasse '.$strasse.' wurde mit Id: '.$strID.' eingefügt.</h3>';


        $query  = 'select * from strasse order by str_name';
        makeTable($query);
    }catch (Exception $e){
        echo 'Error - Straße einfügen - '.$e->getCode().': '.$e->getMessage().'<br>';
    }
}else{
    echo '<h2>Neuen Straßennamen eingeben</h2>';
    ?>
    <form method="post">
        <label for="str">Straßenname</label>
        <input type="text" ID="str" name="strasse" required placeholder="z.B. Wiener Straße">
        <br>
        <input type="submit" name="save" value="speichern">
    </form>
<?php
}
