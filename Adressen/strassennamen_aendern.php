<?php
function DoesStrasseAlreadyExist($strID)
{
    include ("DBcon.php");
    $stmt = $con->prepare("select * from strasse where str_id = ?;");
    $stmt->execute([$strID]);

    if ($stmt->fetch())
    {
        return true;
    }
    else
    {
        echo '<h3>Die Strasse mit ID = '.$strID.' existiert nicht!</h3>';
        return false;
    }
}

if (isset($_POST['save'])){
    $strasse = $_POST['strasse'];
    $strID = $_POST['strid'];

    if (DoesStrasseAlreadyExist($strID))
    {
        try {
            $insertQuery = 'update strasse set str_name = ? where str_id = ?';
            $arrayV = array($strasse, $strID);
            makeStatement($insertQuery, $arrayV);
    
            echo '<h3>Die Strasse '.$strasse.' mit Id: '.$strID.' wurde angepasst.</h3>';
    
            $query  = 'select * from strasse order by str_name';
            makeTable($query);
        }catch (Exception $e){
            echo 'Error - Straße einfügen - '.$e->getCode().': '.$e->getMessage().'<br>';
        }
    }

}else{
    echo '<h2>Neuen Straßennamen eingeben</h2>';
    ?>
    <form method="post">
        <label for="strid">ID der zu ändernden Straße</label>
        <input type="number" ID="strid" name="strid" required placeholder="z.B. 1">
        <label for="str">neuer Name</label>
        <input type="text" ID="str" name="strasse" required placeholder="z.B. Wiener Straße">
        <br>
        <input type="submit" name="save" value="ändern">
    </form>
    <?php
}
