<?php
require_once 'app/models/model.php';

 class AlbumModel extends Model {

    public function getAll() {
        $query = $this->db->prepare('SELECT * FROM album');
        $query->execute();
        $albumes = $query->fetchAll(PDO::FETCH_OBJ);
        
        return $albumes;
    }

    public function getAlbumById ($id) {
        $query = $this->db->prepare('SELECT * FROM album WHERE id = ?');
        $query->execute([$id]);
        $album = $query->fetch(PDO::FETCH_OBJ);
        
        return $album;
    }

    public function getAlbumByGenero($genero) {
        $query = $this->db->prepare('SELECT * FROM album WHERE genero = ?');
        $query->execute([$genero]);
        $albumes = $query->fetchAll(PDO::FETCH_OBJ);
        
        return $albumes;
    }

    public function insertAlbum($nombre, $cant_canciones, $duracion, $artista, $genero, $lanzamiento, $precio) {
        $query = $this->db->prepare('INSERT INTO album (nombre, canciones, duracion, artista, genero, lanzamiento, precio) VALUES (?,?,?,?,?,?,?)');
        $query->execute([$nombre, $cant_canciones, $duracion, $artista, $genero, $lanzamiento, $precio]);
        
        return $this->db->lastInsertId();
    }

    public function deleteAlbum($id) {
        $query = $this->db->prepare('DELETE FROM album WHERE id = ?');
        $query->execute([$id]);
    }

    public function updateAlbum($id, $nombre, $cant_canciones, $duracion, $artista, $genero, $lanzamiento, $precio) {
        $query = $this->db->prepare('UPDATE album SET nombre = ?, canciones = ?, duracion = ?, artista = ?, genero = ?, lanzamiento = ?, precio = ? WHERE id = ?');
        $query->execute([$nombre, $cant_canciones, $duracion, $artista, $genero, $lanzamiento, $precio, $id]);
    }
}

?>