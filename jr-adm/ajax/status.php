<?php include('header.php'); ?>

<?php

extract($_GET);

$up = Geral::StatusTable($table,$campo,$item,$status);