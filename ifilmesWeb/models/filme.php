<?php
/**
 * Created by PhpStorm.
 * User: kassiano
 * Date: 26/06/2016
 * Time: 16:49
 */

class Filme{

    public $id;
    public $nome;
    public $idCategoria;
    public $categoria;

	public $imagem;
	public $descricao;
	
    public function __construct($id, $nome, $idCategoria,$categoria, $imagem, $descricao) {
        $this->id    = $id;
        $this->nome  = $nome;
        $this->idCategoria = $idCategoria;
        $this->categoria= $categoria;
		$this->imagem= $imagem;
		$this->descricao= $descricao;
    }


    public static function all() {

        try {

            $list = [];
            $db = Db::getInstance();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $req = $db->prepare('SELECT f.* , c.descricao as cDesc  FROM filme f inner join categoria c on f.idCategoria = c.id;');
            $req->execute();

            // we create a list of Post objects from the database results
            foreach($req->fetchAll() as $item) {
                $list[] = new Filme($item['id'], $item['nome'], $item['idCategoria'],
                    new Categoria($item['idCategoria'], $item['cDesc']), $item['imagem'],$item['descricao']);
            }

            return $list;
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    public static function insert($filme){

        try {


            $db = Db::getInstance();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            //$stmt = $db->prepare("INSERT INTO filme (id, nome, idCategoria) VALUES (".$filme->id." ,'".$filme->nome."', ".$filme->idCategoria.")");

            $stmt = $db->prepare("INSERT INTO filme (id, nome, idCategoria, imagem, descricao) VALUES (:id ,:nome, :idCategoria, :imagem, :descricao)");
            $stmt->bindParam(':id', $filme->id , PDO::PARAM_STR);
            $stmt->bindParam(':nome', $filme->nome , PDO::PARAM_STR);
            $stmt->bindParam(':idCategoria', $filme->idCategoria, PDO::PARAM_INT);
			$stmt->bindParam(':imagem', $filme->imagem, PDO::PARAM_INT);
			$stmt->bindParam(':descricao', $filme->descricao, PDO::PARAM_INT);
			
            $stmt->execute();

        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }


    public static function find($id) {

        try {
              $db = Db::getInstance();
              $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              // we make sure $id is an integer
              $id = intval($id);
              $req = $db->prepare('SELECT f.* , c.descricao  FROM filme f inner join categoria c on f.idCategoria = c.id WHERE f.id = :id');
              // the query was prepared, now we replace :id with our actual $id value
              $req->execute(array('id' => $id));
              $filme = $req->fetch();

              return new Filme($filme['id'], $filme['nome'], $filme['idCategoria'],
                  new Categoria($item['idCategoria'], $item['descricao']));

          } catch (PDOException $e) {
              echo 'Connection failed: ' . $e->getMessage();
          }
    }

    public static function update($filme)
    {

        try {
            $db = Db::getInstance();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $db->prepare("UPDATE filme set nome= :nome, idCategoria=:idCategoria where id = :id");
            $stmt->bindParam(':id', $filme->id , PDO::PARAM_STR );
            $stmt->bindParam(':nome', $filme->nome , PDO::PARAM_STR);
            $stmt->bindParam(':idCategoria', $filme->idCategoria, PDO::PARAM_STR);

            $stmt->execute();

        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    public static function delete($id)
    {
        try {
            $db = Db::getInstance();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $db->prepare("DELETE FROM filme WHERE id=:id");
            $stmt->bindParam(':id', $id , PDO::PARAM_STR );

            $stmt->execute();

        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }

    }

}
