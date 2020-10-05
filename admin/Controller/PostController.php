<?php 
    require_once('../Config/Database.php');
    class PostController{

        public $db;
        private $tableName = "blog_createpost";
        public function __construct()
        {
            $this->db = new Database();
        }

        public function insertData($data,$file){//insert data
            $title =$this->validation($data['title']); 
            $cat_id =$this->validation($data['category']); 
            $date =$this->validation($data['date']);
            $text =$this->validation($data['text']);
            $tag =$this->validation($data['tag']);
            $parmited = array('jpeg','jpg','png','gif');
            $Folder = 'uploads/';
            $file_name = $file['pic']['name'];
            $temp_name = $file['pic']['tmp_name'];
            $separate = explode('.',$file_name);
            $catchname = strtolower(end($separate));
            $uniqueName = substr(md5(time()),0,10).'.'.$catchname;
            $FulluniqueName = $Folder.$uniqueName;
            move_uploaded_file($temp_name,$FulluniqueName);
            if($title == '' || $text == '' || $file_name == '' || $cat_id == ''){
                return "<div class='alert alert-danger'>All field are require</div>";
            }else if(in_array( $catchname,$parmited) === false){
                return "<div class='alert alert-danger'>File type only:-. ".implode(', ',$parmited)."</div>";
            }else{
                $sql = "INSERT INTO $this->tableName(post_tile,cat_id,post_date,post_image,post_text,tag)VALUES('$title','$cat_id','$date','$FulluniqueName','$text','$tag')";
                $insert = $this->db->conn->query($sql);
                if($insert){
                    return '<div class="alert alert-success" role="alert">
                    <strong>Success!</strong> Insert successful
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
                }else{
                    return '<div class="alert alert-danger" role="alert">
                    <strong>Problem!</strong> Insert Unsuccessful
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
                }
            }
  
        }

        public function ReadData(){//Read Data
            error_reporting(0);
            $sql = "SELECT * FROM $this->tableName NATURAL JOIN blog_category";
            $readData = $this->db->conn->query($sql);
            if($readData == true){
                if($readData->num_rows>0){
                    return $readData;
                }else{
                    return false;
                }
            }

        }
        
        public function DeleteData($id){//Delete Data
            $sql = "DELETE FROM $this->tableName WHERE  post_id='$id' ";
            $delete = $this->db->conn->query($sql);
            return $delete;
        }

        public function ViewData($id){//View Data
            $sql = "SELECT * FROM $this->tableName WHERE  post_id='$id' ";
            $ViewData = $this->db->conn->query($sql);
            $showdata = $ViewData->fetch_assoc();
            return $showdata;
        }

        public function GetPostData($id){//UpDate Get Data
            $sql = "SELECT * FROM $this->tableName WHERE  post_id='$id' ";
            $ViewData = $this->db->conn->query($sql);
            $showdata = $ViewData->fetch_assoc();
            return $showdata;
        }

        public function UpdatePostData($data,$file){//update data
            $id = $data['id'];
            $title =$this->validation($data['title']); 
            $category =$this->validation($data['category']); 
            $date =$this->validation($data['date']);
            $text =$this->validation($data['text']);
            $parmited = array('jpeg','jpg','png','gif');
            $Folder = 'uploads/';
            $file_name = $file['pic']['name'];
            $temp_name = $file['pic']['tmp_name'];
            $separate = explode('.',$file_name);
            $catchname = strtolower(end($separate));
            $uniqueName = substr(md5(time()),0,10).'.'.$catchname;
            $FulluniqueName = $Folder.$uniqueName;
            move_uploaded_file($temp_name,$FulluniqueName);
            if($title == '' || $date == '' || $text == ''){
                return "<div class='alert alert-danger'>All field are require</div>";
            }else{
                if($file_name == ''){
                    $sql = "UPDATE $this->tableName SET post_tile='$title', post_date='$date', post_text='$text'  WHERE post_id='$id'";
                    $update = $this->db->conn->query($sql);
                    if($update){
                        return '<div class="alert alert-success" role="alert">
                        <strong>Success!</strong> Insert successful
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                    }else{
                        return '<div class="alert alert-danger" role="alert">
                        <strong>Problem!</strong> Insert Unsuccessful
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                    }
                }else{
                    $sql = "UPDATE $this->tableName SET post_tile='$title', post_date='$date', post_text='$text', post_image='$FulluniqueName' WHERE post_id='$id'";
                    $update = $this->db->conn->query($sql);
                    if($update){
                        return '<div class="alert alert-success" role="alert">
                        <strong>Success!</strong> Insert successful
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                    }else{
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

        
        public function validation($data){
            $data = trim($data);
            $data = htmlentities($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            $data = mysqli_real_escape_string($this->db->conn,$data);
            return $data;
        }

    }
?>