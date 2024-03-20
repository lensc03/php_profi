<h2>Alle Adressen ausgeben</h2>

<?php

$query = 'select str_name as "Strasse",
plz_nr as "PLZ",
ort_name as "Ort"
from ort 
natural join ort_plz
natural join plz
natural join strasse_ort_plz
natural join strasse
order by PLZ, Strasse;';
makeTable($query);
