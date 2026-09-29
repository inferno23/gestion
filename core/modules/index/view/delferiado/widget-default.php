<?php

$feriado = Feriadosdata::getById($_GET["id"]);

$feriado->del();
Core::redir("./index.php?view=feriados");


?>