<?php


class categoriasmodels{

    function __construct(){
        $this->db= $this->getconection();
    }

private function getconection(){
    return new PDO('mysql:host=localhost;'.'dbname=db_tienda_de_musica;charset=utf8', 'root', '');


}
    function obtener(){
        $query = $this->db->prepare('SELECT * FROM album INNER JOIN categorias ON categorias.id_categoria = album.id_categoria;');
       $query->execute();
       $categorias = $query->fetchAll(PDO::FETCH_OBJ);

    return $categorias;
    }
}