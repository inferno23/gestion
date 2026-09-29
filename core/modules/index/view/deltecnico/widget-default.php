<?php

$client = TecnicoData::getById($_GET["id"]);
$client->del();
Core::redir("./index.php?view=tecnicos");

?>