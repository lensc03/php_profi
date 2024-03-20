<?php
include("./config/db.php");
class Utils
{

    public static function DoRecipesExistForSearch($searchword)
    {
        $db = new Database();
        $stmt = $db->pdo->prepare("SELECT rez_id, rez_name from rezeptname where rez_name like ?");
        $stmt->execute(["%" . $searchword . "%"]);
        $res = $stmt->fetchAll();

        if (!$res) {
            return false;
        }
        return $res;
    }

    public static function GetRecipeNames($dateFrom, $dateTo, $monthSelection, $specificMonth)
    {
        // Construct the SQL query
        $query = "SELECT distinct(rez_name) FROM rezeptname JOIN zubereitung using(rez_id) WHERE 1=1";
        $params = array();

        // Add conditions based on the form inputs
        if (!empty($dateFrom)) {
            $query .= " AND zub_bereitgestellt_am >= ?";
            $params[] = $dateFrom;
        }
        if (!empty($dateTo)) {
            $query .= " AND zub_bereitgestellt_am <= ?";
            $params[] = $dateTo;
        }
        if (!empty($specificMonth)) {
            $query .= " AND MONTH(zub_bereitgestellt_am) = ?";
            $params[] = $specificMonth;
        }
        switch ($monthSelection) {
            case 'lastMonth':
                $query .= " AND MONTH(zub_bereitgestellt_am) = MONTH(CURRENT_DATE) - 1";
                break;
            case 'currentMonth':
                $query .= " AND MONTH(zub_bereitgestellt_am) = MONTH(CURRENT_DATE)";
                break;
            default:
                break;
        }
        $db = new Database();
        $stmt = $db->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public static function GetRecipes($rez_id)
    {
        $db = new Database();
        $stmt = $db->pdo->prepare("SELECT zub_id, 
               zub_beschreibung, 
               zubein_menge, 
               ein_name, 
               zut_name 
        from rezeptname 
            join zubereitung using (rez_id)
            join zubereitung_einheit using (zub_id)
            join zutat_einheit using (zuei_id)
            join zutat using (zut_id)
            join einheit using (ein_id)
        where rez_id = ?");
        $stmt->execute([$rez_id]);
        $res = $stmt->fetchAll();

        if (!$res) {
            return false;
        }
        return $res;
    }

    public static function BuildResultTables($selectedrecipe) 
    {
        $res = Utils::GetRecipes($selectedrecipe);
        $zub_id = 0;
        foreach ($res as $recipedata) { 
            if ($zub_id <> $recipedata["zub_id"] && $zub_id <> 0) {
                echo "</table>"; 
            }
            if ($zub_id <> $recipedata["zub_id"]) {
                $zub_id = $recipedata["zub_id"]; 
                ?>
                <p>Rezeptnummer <?php echo $recipedata["zub_id"] . ": " . $recipedata["zub_beschreibung"] ?></p>
                <table class="table">
                    <tr>
                        <th scope="col">Menge</th>
                        <th scope="col">Einheit</th>
                        <th scope="col">Zutat</th>
                    </tr>
            <?php
            }
            echo "<tr>";
            echo "<td>" . $recipedata["zubein_menge"]. "</td>";
            echo "<td>" . $recipedata["ein_name"]. "</td>";
            echo "<td>" . $recipedata["zut_name"]. "</td>";
            echo "</tr>";

            }
    }
}
