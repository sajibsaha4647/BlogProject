  <?php
	require_once('funcions/function.php');
	require_once('Controller/ContactController.php');
	get_Header();
	get_Sidebar();
	$post = new Contact();
	if (isset($_GET['action'])) {
		$id = $_GET['id'];
		$data = $post->ViewContact($id);
	}
	?>
  <div class="grid_10">
  	<div class="box round first grid">
  		<h2>Post List</h2>
  		<div class="block">
  			<table class="data display datatable" id="example">
  				<thead>
  					<tr>
  						<th>F-Name</th>
  						<th>L-name</th>
  						<th>Email</th>
  						<th>Message</th>
  						<th>Date</th>
  					</tr>
  				</thead>
  				<tbody>
  					<tr class="odd gradeX">
  						<td><?= $data['con_fname'] ?></td>
  						<td><?= $data['con_lname'] ?></td>
  						<td><?= $data['con_email'] ?></td>
  						<td><?= $data['con_message']  ?></td>
  						<td><?= $data['con_date'] ?></td>
  					</tr>
  				</tbody>
  			</table>

  		</div>
  	</div>
  </div>
  <?php
	get_Footer();
	?>