<?php
require_once('../Config/Database.php');
class UserController
{

    public $db;
    private $tableName = "blog_user";

    public function __construct()
    {
        $this->db = new Database();
    }

    public function ReadData()
    { //show data
        error_reporting(0);
        $sql = "SELECT * FROM $this->tableName NATURAL JOIN blog_user_role";
        $read = $this->db->conn->query($sql);
        if ($read == true) {
            if ($read->num_rows > 0) {
                return $read;
            } else {
                return false;
            }
        }
    }
    public function InsertData($data, $file)
    { //insert data
        $name = $this->validation($data['name']);
        $username = $data['username'];
        $userRole = $this->validation($data['userRole']);
        $email = $this->validation($data['email']);
        $password = $this->validation(md5($data['password']));
        $confirmPassword = $this->validation(md5($data['confirmPassword']));
        $checkem = $this->checkEmail($email);
        $parmited = array('jpeg', 'jpg', 'png', 'gif');
        $Folder = 'uploads/';
        $file_name = $file['pic']['name'];
        $temp_name = $file['pic']['tmp_name'];
        $separate = explode('.', $file_name);
        $catchname = strtolower(end($separate));
        $uniqueName = substr(md5(time()), 0, 10) . '.' . $catchname;
        $FulluniqueName = $Folder . $uniqueName;
        move_uploaded_file($temp_name, $FulluniqueName);
        if ($name == '' || $username == '' || $email == '' || $password == '' || $confirmPassword == '' || $file_name == '') {
            return "<div class='alert alert-danger'>All field are require</div>";
        } else if (in_array($catchname, $parmited) == false) {
            return "<div class='alert alert-danger'>File type only:-. " . implode(', ', $parmited) . "</div>";
        } else if ($checkem == true) {
            return "<div class='alert alert-danger'>email is already exist</div>";
        } else if ($password !== $confirmPassword) {
            return "<div class='alert alert-danger'>Password did not match</div>";
        } else {
            $sql = "INSERT INTO $this->tableName(name,user_username,user_role_id,email,user_password,user_image)VALUES('$name','$username','$userRole','$email','$password','$FulluniqueName')";
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
        $sql = "DELETE FROM $this->tableName WHERE  user_id='$id' ";
        $delete = $this->db->conn->query($sql);
        return $delete;
    }
    public function GetUpdate($id)
    { //Get data for update
        $sql = "SELECT * FROM $this->tableName WHERE  user_id='$id' ";
        $ViewData = $this->db->conn->query($sql);
        $showdata = $ViewData->fetch_assoc();
        return $showdata;
    }
    public function UpdateData($data, $file)
    { //Update data
        $id = $data['id'];
        $name = $this->validation($data['name']);
        $username = $this->validation($data['username']);
        $email = $this->validation($data['email']);
        $userRole = $this->validation($data['userRole']);
        $parmited = array('jpeg', 'jpg', 'png', 'gif');
        $Folder = 'uploads/';
        $file_name = $file['pic']['name'];
        $temp_name = $file['pic']['tmp_name'];
        $separate = explode('.', $file_name);
        $catchname = strtolower(end($separate));
        $uniqueName = substr(md5(time()), 0, 10) . '.' . $catchname;
        $FulluniqueName = $Folder . $uniqueName;
        move_uploaded_file($temp_name, $FulluniqueName);
        if ($name == '' || $username == '' || $email == '' || $userRole == '') {
            return "<div class='alert alert-danger'>All field are require</div>";
        } else {
            if ($file_name == '') {
                $sql = "UPDATE $this->tableName SET name='$name', user_username=' $username', email='$email', user_role_id='$userRole'  WHERE user_id='$id'";
                $update = $this->db->conn->query($sql);
                if ($update) {
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
            } else if (in_array($catchname, $parmited) === false) {
                return "<div class='alert alert-danger'>File type only:-. " . implode(', ', $parmited) . "</div>";
            } else {
                $sql = "UPDATE $this->tableName SET name='$name', user_username=' $username', email='$email', user_role_id='$userRole',user_image='$FulluniqueName'  WHERE user_id='$id'";
                $update = $this->db->conn->query($sql);
                if ($update) {
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

    public function checkEmail($email)
    {
        $sql = "SELECT * FROM $this->tableName WHERE email='$email'";
        $checkEmail = $this->db->conn->query($sql);
        if ($checkEmail != false) {
            $row = mysqli_num_rows($checkEmail);
            if ($row > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            echo 'query problem';
        }
    }
}
