<?php

function makeStatement($query, $arrayValues = null){
    global $con;
    $stmt = $con->prepare($query);
    $stmt->execute($arrayValues);
    return $stmt;
}

function makeTable($query){
    global $con;
    $stmt = $con->prepare($query);
    $stmt->execute();
    $meta = array();
    echo '<table class="table">
          <tr>';

    for ($i = 0; $i < $stmt->columnCount(); $i++){
        $meta[] =$stmt->getColumnMeta($i);
        echo '<td>'.$meta[$i]['name'].'</td>';
    }

    echo '</tr>';
    while($row = $stmt->fetch(PDO::FETCH_NUM)){
        echo'<tr>';
        foreach ($row as $r){
            echo '<td>'.$r.'</td>';
        }
        echo '</tr>';
    }

    echo '</table>';
}