<?php
// require_once('../Config/Database.php');
error_reporting(0);
include 'Config/Database.php';
// require_once('../Config/Seassion.php');
class Contact
{

    public $db;
    private $tableName = "blog_contactus";
    public function __construct()
    {
        $this->db = new Database();
    }

    public function GetContact($contact)
    {
        $firstname = $this->Validation($contact['firstname']);
        $lastname = $this->Validation($contact['lastname']);
        $email = $this->Validation($contact['email']);
        $message = $this->Validation($contact['message']);
        if ($firstname == '' || $lastname == '' || $email == '' || $message == '') {
            return "<div class='alert alert-danger'>All field are require</div>";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "<div class='alert alert-danger'>Invalid email</div>";
        } else {
            $sql = "INSERT INTO $this->tableName(con_fname,con_lname,con_email,con_message)VALUES('$firstname','$lastname','$email','$message')";
            $insert = $this->db->conn->query($sql);

            if ($insert) {

                return '<div class="alert alert-success" role="alert">
                    <strong>Success!</strong> Message send successful
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            } else {

                return '<div class="alert alert-danger" role="alert">
                    <strong>Problem!</strong> Message Not send
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            }
        }
    }

    public function showMessage()
    {
        error_reporting(0);
        $sql = "SELECT * FROM $this->tableName where staus='0' order by con_id desc";
        $read = $this->db->conn->query($sql);
        if ($read == true) {
            if ($read->num_rows > 0) {
                return $read;
            } else {
                return false;
            }
        }
    }

    public function showseenbox()
    {
        error_reporting(0);
        $sql = "SELECT * FROM $this->tableName where staus='1' order by con_id desc";
        $read = $this->db->conn->query($sql);
        if ($read == true) {
            if ($read->num_rows > 0) {
                return $read;
            } else {
                return false;
            }
        }
    }

    public function updateStatus($id) //update status
    {
        $sql = "UPDATE $this->tableName SET staus='1' where con_id='$id' ";
        $qur = $this->db->conn->query($sql);
        if ($qur) {
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

    public function deleteMessage($id)
    {
        $sql = "DELETE FROM $this->tableName WHERE  con_id='$id' ";
        $delete = $this->db->conn->query($sql);
        return $delete;
    }

    public function ViewContact($id)
    {
        $sql = "SELECT * FROM $this->tableName WHERE  con_id='$id' ";
        $ViewData = $this->db->conn->query($sql);
        $showdata = $ViewData->fetch_assoc();
        return $showdata;
    }

    public function getmessage($id)
    {
        $sql = "SELECT * FROM $this->tableName WHERE  con_id='$id' ";
        $ViewData = $this->db->conn->query($sql);
        $showdata = $ViewData->fetch_assoc();
        return $showdata;
    }


    public function replayMessage($data)
    {
        $toemail = $this->Validation($data['toemail']);
        $fromemail = $this->Validation($data['fromemail']);
        $subject = $this->Validation($data['subject']);
        $message = $this->Validation($data['message']);
        $headers = array(
            'From' => $fromemail,
            'Reply-To' => $toemail,
            'X-Mailer' => 'PHP/' . phpversion()
        );
        $sendemail = mail($toemail, $subject, $message, $headers);
        if ($sendemail) {
            return '<div class="alert alert-success" role="alert">
                    <strong>Success!</strong> Message send successful
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        } else {
            return '<div class="alert alert-danger" role="alert">
                    <strong>Problem!</strong> Message Not send
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        }
    }








    public function Validation($data)
    {
        $data = trim($data);
        $data = htmlentities($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = mysqli_real_escape_string($this->db->conn, $data);
        return $data;
    }
}
