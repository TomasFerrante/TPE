<?php
class tiendademusica{

    
    function __construct(){
        $this->db= $this->getconection();
    }

private function getconection(){
    return new PDO('mysql:host=localhost;'.'dbname=db_tienda_de_musica;charset=utf8', 'root', '');


}

function obtener(){

    $query = $this->db->prepare('SELECT * FROM album');
$query->execute();
//cargas es un arreglo de cargas
$albumes = $query->fetchall(PDO::FETCH_OBJ);

return $albumes;

}




function insertaralbum($nombre,$canciones,$duracion,$artista,$genero,$lanzamiento){
     
     
     $query=$this->db->prepare('INSERT INTO  album(nombre, canciones, duracion, artista,genero,lanzamiento ) VALUES (?,?,?,?,?,?) ');
     $query->execute([$nombre,$canciones,$duracion,$artista,$genero,$lanzamiento]);
     
 
 

}
function borrardatos($id){
    
    $query=$this->db->prepare('DELETE FROM album WHERE  id_album=?');
    $query->execute([$id]);

}
function editardatos($id){

    $query=$this->db->prepare('UPDATE album SET cancion = "" WHERE id_album =?');
    $query->execute([$id]);
}

}