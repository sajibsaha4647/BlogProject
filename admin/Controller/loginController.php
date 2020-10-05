<?php
require_once('../Config/Database.php');
require_once('../Config/Seassion.php');
Session::init();
class loginController
{

    private $db;
    private $tableName = "blog_user";
    public function __construct()
    {
        $this->db = new Database();
    }

    public function AuthuserLogin($data)
    {
        $user_username = $this->validation($data['username']);
        $password = $this->validation(md5($data['password']));
        $sql = "SELECT * FROM $this->tableName WHERE user_username = '$user_username' AND user_password ='$password'";
        $fetch = $this->db->conn->query($sql);
        if ($fetch !== false) {
            $value = mysqli_fetch_array($fetch);
            $row = mysqli_num_rows($fetch);
            if ($row > 0) {
                Session::set("login", true);
                Session::set('username', $value['user_username']);
                Session::set('user_id', $value['user_id']);
                Session::set('user_image', $value['user_image']);
                Session::set('user_role_id', $value['user_role_id']);

                header("location:index.php");
            } else {
                return '<div class="alert alert-danger" role="alert">
                <strong>alas!</strong> user name or password did not match
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>';
            }
        } else {
            return '<div class="alert alert-danger" role="alert">
                <strong>alas!</strong> something went wrong
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>';
        }
    }

    public function getForgotpass($saha)
    {
        $email = $this->validation($saha['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "<div class='alert alert-danger'>email is invalid</div>";
        } else {
            $sql = "SELECT * FROM $this->tableName WHERE email='$email' limit 1";
            $check = $this->db->conn->query($sql);
            $userid = "";
            if ($check != false) {
                $row = mysqli_num_rows($check);
                if ($row > 0) {
                    foreach ($check as $val) {
                        $userid = $val['user_id'];
                        echo $userid;
                    }
                    $text = substr($email, 0, 3);
                    $rand = rand(10000, 99999);
                    $newpass = "$text$rand";
                    $pass = md5($newpass);
                    $updateQuery = "UPDATE blog_user SET  user_password='$pass' where user_id=$userid";
                    $update = $this->db->conn->query($updateQuery);
                    $to = "$email";
                    $from = "sajibsaha4647@gmail.com";
                    $headers = "from: $from\n";
                    $headers .= "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $subject = "Your Password";
                    $message = "Your password is " . $newpass . " ";
                    $sendemail = mail($to, $subject, $message, $headers);
                    if ($sendemail !== false) {
                        return "<div class='alert alert-danger'>email Send Successfully</div>";
                    } else {
                        return "<div class='alert alert-danger'>email not send</div>";
                    }
                } else {
                    return "<div class='alert alert-danger'>email not exist</div>";
                }
            } else {
                return "<div class='alert alert-danger'>email not exist</div>";
            }
        }
    }

    public function validation($data)
    {
        $data = trim($data);
        $data = htmlentities($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = mysqli_real_escape_string($this->db->conn, $data);
        return $data;
    }
}
