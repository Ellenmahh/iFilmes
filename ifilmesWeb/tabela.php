<?php

require_once('connectionMysql.php');
require_once('models/categoria.php');
require_once('models/filme.php');


    $listFilmes = Filme::all();
    //sleep (2);
?>

<table class="table table-striped">
        <tr>
            <th>Nome</th>
            <th>Categoria</th>
            <th>
            </th>
        </tr>

        <?php foreach ($listFilmes as $item){ ?>

            <tr>
                <td><?php echo htmlspecialchars($item->nome, ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo $item->categoria->descricao; ?></td>
                <td>
                    <a href="#" onclick="deletar('<?php echo $item->id; ?>')">deletar</a>
                </td>
            </tr>

        <?php } ?>

    </table>
