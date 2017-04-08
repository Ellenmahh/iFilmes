

<?php 

require_once('connectionMysql.php');
require_once('models/categoria.php');
require_once('models/filme.php');


	sleep(3);

	$listaFilmes = Filme:: all();
	
	echo json_encode($listaFilmes);

?>