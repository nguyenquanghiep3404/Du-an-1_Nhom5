<?php
  class loginModel{
    public $conn;
    public function __construct()
    {
        $this->conn =  connect_db();
    }
    public function check($name,$password)
    { 
        $sql = "SELECT * FROM `users` WHERE `name` = '$name' AND `password` = '$password'";
        return $this->conn->query($sql)->fetch();
    }
    public function Role($username)
    {
        $sql = "SELECT id_role FROM `users` WHERE name = '$username'";
        $stsm = $this->conn->query($sql);
        return $stsm->fetch();
    }
  }
?>