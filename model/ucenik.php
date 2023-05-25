<?php

class Ucenik{

    public $ime;
    public $email;
    public $username;
    public $password;

    public function __construct($ime, $email, $username, $password){
        $this->ime = $ime;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
    }

    public static function login($username, $password, mysqli $conn){
        $query = "select * from ucenik where username= '$username' and password = '$password' limit 1;";
        return $conn->query($query);
    }

    public static function add($ime, $email, $username, $password, mysqli $conn){
        $query = "insert into ucenik (ime, email, username, password) values ('$ime', '$email', '$username', '$password')";
        return $conn->query($query);
    }

    public static function check($username, mysqli $conn){
        $query = "select * from ucenik where username= '$username'";
        return $conn->query($query);
    }

    public static function vratiIme($username, mysqli $conn){
        $query = "select ime from ucenik where username = '$username';";
        return $conn->query($query);
    }


}


?>