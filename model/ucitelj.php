<?php

class Ucitelj{

    public $ime;
    public $iskustvo;
    public $username;
    public $password;

    public function __construct($ime, $iskustvo, $username, $password){
        $this->ime = $ime;
        $this->iskustvo = $iskustvo;
        $this->username = $username;
        $this->password = $password;
    }

    public static function login($username, $password, mysqli $conn){
        $query = "select * from ucitelj where username= '$username' and password = '$password' limit 1;";
        return $conn->query($query);
    }

    public static function add($ime, $iskustvo, $username, $password, mysqli $conn){
        $query = "insert into ucitelj (ime, iskustvo, username, password) values ('$ime', $iskustvo, '$username', '$password')";
        return $conn->query($query);
    }

    public static function check($username, mysqli $conn){
        $query = "select * from ucitelj where username= '$username'";
        return $conn->query($query);

    }

    public static function getAll(mysqli $conn){
        return $conn->query("SELECT ime, iskustvo, username FROM ucitelj");
    }



}


?>