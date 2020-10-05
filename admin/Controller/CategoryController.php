<?php 

    require_once('../Config/Database.php');
 class CategoryController{
    public $db;
    private $tableName = "blog_category";
    public function __construct()
    {
        $this->db = new Database();
    }

    public function ReadData(){
        error_reporting(0);
        $sql = "SELECT * FROM $this->tableName";
        $read = $this->db->conn->query($sql);
        if($read == true){
            if($read->num_rows>0){
                return $read;
            }else{
                return false;
            }
        }
    }

    public function InsertData($data){
        $catName = $this->validation($data['category']);
        if($catName == ""){
            return "<div class='alert alert-danger'>All field are require</div>";
        }else{
            $sql = "INSERT INTO $this->tableName(cat_name)VALUES('$catName')";
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

    public function DeleteData ($id){
        $sql = "DELETE FROM $this->tableName WHERE  cat_id='$id' ";
        $delete = $this->db->conn->query($sql);
        return $delete;
    }

    

    public function GetCatUpdateData($id){//get data for update
        $sql = "SELECT * FROM $this->tableName WHERE  cat_id='$id' ";
        $updatdata = $this->db->conn->query($sql);
        $getdata = $updatdata->fetch_assoc();
        return $getdata;
    }

    public function Updatecatlit($data){ //update cat list
        $catName = $this->validation($data['category']);
        $id = $this->validation($data['id']);
        if($catName == ""){
            return "<div class='alert alert-danger'> field are require</div>";
        }else{
            $sql = "UPDATE $this->tableName SET cat_name='$catName' WHERE cat_id='$id'";
            $UPDATE = $this->db->conn->query($sql);
                if($UPDATE){
                    return '<div class="alert alert-success" role="alert">
                    <strong>Success!</strong> Update successful
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
                }else{
                    return '<div class="alert alert-danger" role="alert">
                    <strong>Problem!</strong> Update Unsuccessful
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
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