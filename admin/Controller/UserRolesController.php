<?php
require_once('../Config/Database.php');
class UserRolesController
{

    public $db;
    private $tableName = " blog_user_role";

    public function __construct()
    {
        $this->db = new Database();
    }

    public function ReadData()
    { //show data
        error_reporting(0);
        $sql = "SELECT * FROM $this->tableName";
        $read = $this->db->conn->query($sql);
        if ($read == true) {
            if ($read->num_rows > 0) {
                return $read;
            } else {
                return false;
            }
        }
    }
    public function InsertData($data)
    { //insert data
        $user_role_name = $this->validation($data['name']);
        if ($user_role_name == '') {
            return "<div class='alert alert-danger'>All field are require</div>";
        } else {
            $sql = "INSERT INTO $this->tableName(user_role_name)VALUES('$user_role_name')";
            $insert = $this->db->conn->query($sql);
            if ($insert) {
                return '<div class="alert alert-success" role="alert">
                    <strong>Success!</strong> Insert successful
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            } else {
                return '<div class="alert alert-danger" role="alert">
                    <strong>Problem!</strong> Insert Unsuccessful
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            }
        }
    }
    public function deleteData($id)
    { //delete data
        $sql = "DELETE FROM $this->tableName WHERE  user_role_id='$id' ";
        $delete = $this->db->conn->query($sql);
        return $delete;
    }
    public function GetUpdate($id)
    { //Get data for update
        $sql = "SELECT * FROM $this->tableName WHERE  user_role_id='$id' ";
        $updatdata = $this->db->conn->query($sql);
        $getdata = $updatdata->fetch_assoc();
        return $getdata;
    }
    public function UpdateData($data)
    { //Update data
        $user_role_name = $this->validation($data['user_role_name']);
        $id = $this->validation($data['id']);
        if ($user_role_name == "") {
            return "<div class='alert alert-danger'> field are require</div>";
        } else {
            $sql = "UPDATE $this->tableName SET user_role_name='$user_role_name' WHERE user_role_id='$id'";
            $UPDATE = $this->db->conn->query($sql);
            if ($UPDATE) {
                return '<div class="alert alert-success" role="alert">
                    <strong>Success!</strong> Update successful
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            } else {
                return '<div class="alert alert-danger" role="alert">
                    <strong>Problem!</strong> Update Unsuccessful
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            }
        }
    }
    public function validation($data)
    { //validation data
        $data = trim($data);
        $data = htmlentities($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = mysqli_real_escape_string($this->db->conn, $data);
        return $data;
    }
}
