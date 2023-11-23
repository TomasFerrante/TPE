<?php
include_once './app/models/model.php';

class VentasModel extends Model {

    public function getAll() {
        $query = $this->db->prepare('SELECT * FROM ventas');
        $query->execute();
        $ventas = $query->fetchAll(PDO::FETCH_OBJ);

        return $ventas;
    }

    public function getById($id) {
        $query = $this->db->prepare('SELECT * FROM ventas WHERE id = ?');
        $query->execute([$id]);
        $venta = $query->fetch(PDO::FETCH_OBJ);

        return $venta;
    }

    public function insertVenta($id_album, $via, $tipo, $precio, $producto) {
        $query = $this->db->prepare('INSERT INTO ventas (id_album, via, tipo, precio, producto) VALUES (?,?,?,?,?)');
        $query->execute([$id_album, $via, $tipo, $precio, $producto]);

        return $this->db->lastInsertId();
    }

    public function deleteVenta($id) {
        $query = $this->db->prepare('DELETE FROM ventas WHERE id = ?');
        $query->execute([$id]);
    }

    public function updateVenta($id, $id_album, $via, $tipo, $precio, $producto) {
        $query = $this->db->prepare('UPDATE ventas SET id_album = ?, via = ?, tipo = ?, precio = ?, producto = ? WHERE id = ?');
        $query->execute([$id_album, $via, $tipo, $precio, $producto,$id]);
    }
}

?>