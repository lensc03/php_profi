<?php
require_once("DBconf.php");

class Databasefunction{
    
    public static function GetDiagnoseData( $svnumber, $birthdate, $start, $end)
    {
        $db = new Database();

        $query = 
        "select concat_ws('', ter_beginn, ' - ',  coalesce(ter_ende)) as 'Zeitraum', 
            concat(per_vname, ' ', per_nname) as 'Patient', 
            concat(per_svnr, '/', per_geburt) as 'SVNr', 
            dia_name as 'Diagnose' 
        from behandlungszeitraum bz 
            join diagnose using(dia_id) 
            join person using(per_id) 
        where person.per_svnr = ? 
            and person.per_geburt = ? 
            and bz.ter_ende is not null";

        $params = [$svnumber, $birthdate];
    
        if (!empty($start))
        {
            $query = $query. " and DATE(bz.ter_beginn) >= ?";
            $params[] = $start; 
        }
    
        if (!empty($end))
        {
            $query .= " and DATE(bz.ter_ende) <= ?";
            $params[] = $end; 
        }

        $statement = $db->pdo->prepare($query);
        $statement->execute($params);
        return $statement->fetchAll();

    }


public static function Getalltables( $nname)
{

    $db = new Database();
    
    $query = 
    "select per_vname, per_svnr, per_geburt
    from person
    where per_id = ?";

    $params = [$nname];

    $statement = $db->pdo->prepare($query);
    $statement->execute($params);
    return $statement->fetchAll();

}
    
}
?>