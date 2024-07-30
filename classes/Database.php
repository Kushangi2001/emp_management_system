<?php
class Database {
    private $link;

    public function __construct() {
        $this->link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if($this->link === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
    }

    public function getLink() {
        return $this->link;
    }
}
?>
