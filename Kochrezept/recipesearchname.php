<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update the selected street name if submitted
    if (isset($_POST['search'])) {
        $_SESSION["searchstring"] = $_POST['search'];
    }
}
?>
<h1>Nach Rezepten Suche</h1>

<?php 
if (isset($_POST["search"]) || isset($_POST["selectedrecipe"])) { ?>
    <h3>Gesucht wurde nach: <?php echo $_SESSION["searchstring"] ?></h3>

    <?php
        $res = Utils::getwortteil($_SESSION["searchstring"]);
        if ($res || isset($_POST["selectedrecipe"])) { ?>
            <form method="post" action="">
                <label for="recipes">Ergebnisliste der Suche:</label>

                <select name="selectedrecipe" id="recipes">
                    <?php
                    foreach ($res as $recipes) {
                        echo "<p>" . $_POST["selectedrecipe"] . $recipes["idarbeit"] . "</p>";
                        echo "<option value=". $recipes["idarbeit"] . " " . ($_POST["selectedrecipe"]==$recipes["idarbeit"] ? "selected" : "") . ">" . $recipes["beruf"] . "</option>";
                    } ?>
                </select><br>
                <input type="submit" value="anzeigen">
            </form>
            <?php if (isset($_POST["selectedrecipe"])) { ?>
                <div id="recipes">
                    <?php 
                    Utils::BuildResultTables($_POST["selectedrecipe"]);
                } ?>
                </div>
        <?php }
}
else { ?>
    <form action=""method="POST">
        <label for="search">Rezeptnamen suchen (auch Wortteil möglich): </label>
        <input type="text" id="search" name="search"><br>
        <input type="submit" value="Suche">
    </form>
<?php } ?>