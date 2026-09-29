<?php

$obra = OsocialData::getById($_GET["id"]);

$obra->del();
Core::redir("./index.php?view=osocials");


?>