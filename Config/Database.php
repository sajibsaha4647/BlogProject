<?php


class Database
{

    private $host = "localhost";
    private $dbuser = "root";
    private $dbpass = "";
    private $dbname = "myblog";


    public $conn;
    public $err;
    public function __construct()
    {
        if (!isset($this->conn)) {
            $this->conn = mysqli_connect($this->host, $this->dbuser, $this->dbpass, $this->dbname);
            if (!$this->conn) {
                $this->err =  '<div class="alert alert-danger" role="alert">
                <strong>Problem!</strong> database connection error
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>';
                echo $this->err;
            }
        }
    }

    public function TitleBar()
    {
        $title = "sajib saha";
        return $title;
    }

    public function CatchFilename()
    {
        $path = $_SERVER['SCRIPT_FILENAME'];
        $title = basename($path, '.php');
        if ($title == 'index') {
            $title = 'Home';
        } elseif ($title == 'about') {
            $title = 'about';
        } elseif ($title == 'contact') {
            $title = 'contact';
        } else {
            $title = 'Home';
        }
        return  $title = ucfirst($title);
    }
}
