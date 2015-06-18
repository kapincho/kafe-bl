<?php

class database{

    private $connection = null;

    function database($server, $username, $password, $database){
        $this->connection = mysqli_connect($server, $username, $password);
        if ($this->connection) mysqli_select_db($database);
    }

    function close() {
        mysqli_close($this->connection);
    }

    function query($query) {
        $result = mysqli_query($query, $this->connection);
        return $result;
    }

    function getConnection(){
        return $this->connection;
    }
}
?>