<?php
/**
 * Created by PhpStorm.
 * User: kassiano
 * Date: 26/06/2016
 * Time: 15:58
 */

    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");

    require_once('connectionMysql.php');
    require_once('models/categoria.php');
    require_once('models/filme.php');

    $LstCategorias = Categoria::all();

?>

<DOCTYPE html>

<html>
<head>
  <meta charset="UTF-8">
  <title>iFilmes</title>
  <link rel="stylesheet" type="text/css" href="content/lib/bootstrap/bootstrap-3.3.6-dist/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="content/css/site.css">

  <!-- Website Font style -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

  <!-- Google Fonts -->
  <link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

  <script src="content/lib/Jquery/jquery.min.js"></script>
  <script src="content/lib/jquery-ui-1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" type="text/css" href="content/lib/jquery-ui-1.11.4/jquery-ui.css">
</head>
<body>

<script type="text/javascript">


  function deletar(_id){
    $.post('deletar.php', {  id : _id  }, function(resultado){

          $("#div_filmes").html(resultado);

    });

  }

  $(document).ready(function(){


      $.get('tabela.php', function(resultado){

            $("#div_filmes").html(resultado);
      });


      $("#btn_inserir").click(function(event){
          event.preventDefault();


            if($("#nome").val().length > 500 ){

                alert('inválido');

            }else{

              $("#div_carregando").show();
              $.post('inserir.php', $('#frmFilme').serialize() , function(resultado){

                    $("#div_carregando").hide();
                    $("#div_filmes").html(resultado);

              });
            }


      });


  });

</script>


<div class="container">
    <div class="row main">
        <div class="panel-heading">
            <div class="panel-title text-center">
                <h1 class="title">iFilmes App </h1>
                <hr />
            </div>
        </div>


        <form method="post" action="" id="frmFilme">

            <div class="form-group">
                <label for="nome" class="cols-sm-2 control-label">Nome</label>
                <div class="cols-sm-10">
                    <div class="input-group">
                        <input type="text" class="form-control" name="nome" id="nome"  placeholder="Nome"
                        maxlength="500" />
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label for="idCategoria" class="cols-sm-2 control-label">Categoria</label>
                <div class="cols-sm-10">
                    <div class="input-group">

                        <select class="form-control" id="idCategoria" name="idCategoria">
                            <?php foreach ($LstCategorias as $item){ ?>

                                <option value="<?php echo $item->id ?>"><?php echo $item->descricao ?></option>

                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
			
			<div class="form-group">
                <label for="imagem" class="cols-sm-2 control-label">Imagem</label>
                <div class="cols-sm-10">
                    <div class="input-group">
                        <input type="text" name="imagem"/>
                    </div>
                </div>
            </div>
			
			<div class="form-group">
                <label for="descricao" class="cols-sm-2 control-label">Descrição</label>
                <div class="cols-sm-10">
                    <div class="input-group">
                       <textarea name="descricao" rows="5" cols="30"></textarea>
                    </div>
                </div>
            </div>
			
            <input type="submit" class="btn btn-primary" value="Inserir" id="btn_inserir" />
        </form>

        <div id="div_carregando" style="display:none;">
            Carregando ....
        </div>

      <div id="div_filmes">

        Carregando ....
      <div>

    </div>
</div>

</body>
</html>
