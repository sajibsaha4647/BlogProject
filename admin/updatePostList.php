<?php 
    require_once('funcions/function.php');
    require_once('Controller/PostController.php');
    get_Header();
    get_Sidebar();

    $post = new PostController();

    $id = $_GET['id'];
    $val = $post->GetPostData($id);
        
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $result = $post->UpdatePostData($_POST,$_FILES);
    }


		

    
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Post</h2>
                <div class="block">  
                <?php 
                    if(isset($result)){
                      echo $result;
                    }
                  ?>             
                 <form action="" method="POST" enctype="multipart/form-data">
                 <input  value="<?=$val['post_id']?>" type="hidden" name="id" placeholder="Enter Post Title..." class="medium" />
                    <table class="form">
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input  value="<?=$val['post_tile']?>" type="text" name="title" placeholder="Enter Post Title..." class="medium" />
                            </td> 
                        </tr>
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="category" name="select">
                                    <option value="1">Category One</option>
                                    <option value="2">Category Two</option>
                                    <option value="3">Cateogry Three</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Date Picker</label>
                            </td>
                            <td>
                                <input value="<?=$val['post_date']?>" type="text" name="date" id="date-picker" />
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
                                <textarea  style="width:70%" name="text" class="form-control" placeholder="emter message" rows="10" ><?=$val['post_text']?></textarea>
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