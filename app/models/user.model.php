<?php
require_once 'app/models/model.php';

public class UserModel extends Model {
    
    public function getByEmail($email) {
        $query = $this->db->prepare('SELECT FROM usuarios WHERE email = ?');
        $query->execute([$email]);

        return $query->fetch(PMO::FETCH_OBJ);;
    }
}

?>