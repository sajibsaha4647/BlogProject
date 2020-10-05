<?php 
    require_once('funcions/function.php');
    require_once('Controller/PostController.php');
    get_Header();
    get_Sidebar();
	$post = new PostController();
	if(isset($_GET['action'])){
		$id = $_GET['id'];
		$result = $post->ViewData($id);
	  }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
                <div class="block">
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Post Title</th>
							<th>date</th>
							<th>Category</th>
							<th>Image</th>
							<th>ConTent</th>
						</tr>
					</thead>
					<tbody>
						
						<tr class="odd gradeX">
							<td><?=$result['post_tile']?></td>
							<td><?=$result['post_date']?></td>
							<td>Win 95+</td>
							<td>
							<img style="height:50px;width:50px" src="<?=$result['post_image']?>" alt="no image">
							</td>
							<td><?=$result['post_text']?></td>
						</tr>
					</tbody>
				</table>
	
               </div>
            </div>
        </div>
<?php 
get_Footer();
?>     