<?php
include 'db.php';

class User extends DB{
    private $nombre;
    private $username;


    public function userExists($user, $pass){
        $md5pass = md5($pass);
        $query = $this->connect()->prepare('SELECT * FROM usuario WHERE Nombre_Usuario = :user AND Contraseña = :pass');
        $query->execute(['user' => $user, 'pass' => $md5pass]);

        if($query->rowCount()){
            return true;
        }else{
            return false;
        }
    }

    public function setUser($user){
        $query = $this->connect()->prepare('SELECT * FROM usuario WHERE Nombre_Usuario = :user');
        $query->execute(['user' => $user]);
        
        foreach ($query as $currentUser) {
            $this->nombre = $currentUser['Telefono'];
            $this->username = $currentUser['Nombre_Usuario'];
        }
    }

    public function getNombre(){
        return $this->nombre;
    }
}

?>