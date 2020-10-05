<?php
require_once('funcions/function.php');
require_once('Controller/UserController.php');
get_Header();
get_Sidebar();
$User = new UserController();
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
	$id = $_GET['id'];
	$result = $User->deleteData($id);
}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>User List</h2>
		<div class="block">
			<?php if (isset($result)) { ?>
				<?php echo '<div class="alert alert-success" role="alert">
                                  <strong>Success!</strong> Data Deleted
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>'; ?>
			<?php } ?>
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>Name</th>
						<th>User name</th>
						<th>email</th>
						<th>Image</th>
						<th>UserRole</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($User->ReadData() as $key => $val) {
					?>
						<tr class="odd gradeX">
							<td><?= $val['name'] ?></td>
							<td><?= $val['user_username'] ?></td>
							<td><?= $val['email'] ?></td>
							<td>
								<img style="height:50px;width:50px" src="<?= $val['user_image'] ?>" alt="no image">
							</td>
							<td><?= $val['user_role_name'] ?></td>
							<td>
								<a href="UpdateUser.php?action&id=<?= $val['user_id']; ?>">Edit</a> |
								<a href="UserList.php?action=delete&id=<?= $val['user_id'] ?>">Delete</a>
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