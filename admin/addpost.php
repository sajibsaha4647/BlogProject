<?php 
    require_once('funcions/function.php');
    require_once('Controller/PostController.php');
    require_once('../Config/Database.php');
    get_Header();
    get_Sidebar();

    $post = new PostController();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $result = $post->insertData($_POST,$_FILES);
    }
    $db = new Database();
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Post</h2>
                <div class="block">  
                <?php 
                    if(isset($result)){
                      echo $result;
                    }
                  ?>             
                 <form action="" method="Post" enctype="multipart/form-data">
                    <table class="form">
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" placeholder="Enter Post Title..." class="medium" />
                            </td> 
                        </tr>
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="category" name="select">
                                <option>select category</option>
                                    <?php 
                                        $sql = "SELECT * FROM  blog_category";
                                        $category = $db->conn->query($sql);
                                        if($category){
                                            while($result = $category->fetch_assoc()){
                                    ?>
                                        <option value="<?=$result['cat_id']?>"><?=$result['cat_name']?></option>
                                    <?php }}?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="hidden" name="date"  />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tag</label>
                            </td>
                            <td>
                            <input type="text" name="tag" placeholder="Enter Post tag..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <input name="pic" type="file" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea style="width:70%" name="text" class="form-control" placeholder="emter message" rows="10"></textarea>
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <button name="submit" >submit</button>
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
        
<?php 
get_Footer();
?>         