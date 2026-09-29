<?php

$gasto = Gastosdata::getById($_GET["id"]);

$gasto->del();
Core::redir("./index.php?view=gastos");


?>