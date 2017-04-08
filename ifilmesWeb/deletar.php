
<?php

require_once('connectionMysql.php');
require_once('models/categoria.php');
require_once('models/filme.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      Filme::delete($_POST['id']);
}

require_once('tabela.php');

?>
