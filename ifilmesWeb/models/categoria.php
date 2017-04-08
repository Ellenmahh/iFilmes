<?php
/**
 * Created by PhpStorm.
 * User: kassiano
 * Date: 28/06/2016
 * Time: 09:07
 */

class Categoria{

    public $id;
    public $descricao ;

    public function __construct($id, $descricao)
    {
        $this->id = $id;
        $this->descricao = $descricao;
    }


    public static function all(){
        $list = [];
        $db = Db::getInstance();
        $req = $db->query('SELECT * FROM categoria');

        // we create a list of Post objects from the database results
        foreach($req->fetchAll() as $item) {
            $list[] = new Categoria($item['id'], $item['descricao']);
        }

        return $list;
    }

    public static function insert($categoria)
    {
        try {

            $db = Db::getInstance();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            $stmt = $db->prepare("INSERT INTO categoria (id, descricao) VALUES (:id ,:descricao)");
            $stmt->bindParam(':id', $categoria->id , PDO::PARAM_STR );
            $stmt->bindParam(':userName', $categoria->descricao , PDO::PARAM_STR);

            $stmt->execute();

        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }

    }

    public static function find($id) {
        $db = Db::getInstance();
        // we make sure $id is an integer
        $id = intval($id);
        $req = $db->prepare('SELECT * FROM categoria WHERE id = :id');
        // the query was prepared, now we replace :id with our actual $id value
        $req->execute(array('id' => $id));

        $item = $req->fetch();

        return new Categoria($item['id'], $item['descricao']);
    }

    public static function update($categoria)
    {

        try {
            $db = Db::getInstance();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $db->prepare("UPDATE categoria set descricao= :descricao where id = :id");
            $stmt->bindParam(':id', $categoria->id , PDO::PARAM_STR );
            $stmt->bindParam(':descricao', $   $categoria->descricao , PDO::PARAM_STR);


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

            $stmt = $db->prepare("DELETE FROM categoria WHERE id=:id");
            $stmt->bindParam(':id', $id , PDO::PARAM_STR );

            $stmt->execute();

        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }

    }

}
