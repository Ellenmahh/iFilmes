
<?php

require_once('connectionMysql.php');
require_once('models/categoria.php');
require_once('models/filme.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		

        $nome = $_POST['nome'];
		$imagem = $_POST['imagem'];
		$descricao = $_POST['descricao'];
		

        if(strlen($nome) > 500){

          echo "invalido";

        }else{
          $filme = new Filme(0,$nome, $_POST['idCategoria'],null, $imagem, $descricao );

          Filme::insert($filme);
        }


}

require_once('tabela.php');

  ?>
