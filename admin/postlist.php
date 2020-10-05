<?php 
    require_once('funcions/function.php');
    require_once('Controller/PostController.php');
    get_Header();
    get_Sidebar();
	$post = new PostController();
	if(isset($_GET['action']) && $_GET['action'] == 'delete'){
		$id = $_GET['id'];
		$result = $post->DeleteData($id);
	  }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
                <div class="block">
				<?php if(isset($result)){?>
                  <?php echo '<div class="alert alert-success" role="alert">
                                  <strong>Success!</strong> Data Deleted
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>';?>
                <?php }?>
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Post Title</th>
							<th>date</th>
							<th>Category</th>
							<th>Image</th>
							<th>ConTent</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							foreach($post->ReadData() as $key=>$val){
						?>
						<tr class="odd gradeX">
							<td><?=$val['post_tile']?></td>
							<td><?=$val['post_date']?></td>
							<td><?=$val['cat_name']?></td>
							<td>
							<img style="height:50px;width:50px" src="<?=$val['post_image']?>" alt="no image">
							</td>
							<td><?=substr(($val['post_text']),0,50).'...'?></td>
							<td>
								<a href="updatePostList.php?action&id=<?=$val['post_id'];?>">Edit</a> |
								<a href="ViewPostlist.php?action&id=<?=$val['post_id'];?>">View</a> |
								<a href="postlist.php?action=delete&id=<?=$val['post_id']?>">Delete</a>
							</td>
						</tr>
						<?php 
							}
						?>
					</tbody>
				</table>
	
               </div>
            </div>
        </div>
<?php 
get_Footer();
?>     