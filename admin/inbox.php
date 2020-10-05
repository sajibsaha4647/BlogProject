<?php
require_once('funcions/function.php');
require_once('Controller/ContactController.php');
// require_once('../Config/Database.php');
require_once('../helpers/Formate.php');
get_Header();
get_Sidebar();

?>

<?php
$Formate = new Formate();
$message = new Contact()
?>

<?php

if (isset($_GET['sendid'])) { //update status
	$seenid = $_GET['sendid'];
	$result = $message->updateStatus($seenid);
}
if (isset($_GET['delid'])) { //update status
	$delid = $_GET['delid'];
	$delete = $message->deleteMessage($delid);
}


?>

<div class="grid_10">
	<div class="box round first grid">
		<h2>Inbox</h2>
		<div class="block">
			<?php
			if (isset($result)) {
				echo $result;
			} else {
				null;
			}

			?>
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>F-Name</th>
						<th>L-name</th>
						<th>Email</th>
						<th>Message</th>
						<th>Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($message->showMessage() as $val => $data) {
					?>
						<tr class="odd gradeX">
							<td><?= $data['con_fname'] ?></td>
							<td><?= $data['con_lname'] ?></td>
							<td><?= $data['con_email'] ?></td>
							<td><?= substr(($data['con_message']), 0, 50) . "..."  ?></td>
							<td><?= $Formate->makeDate($data['con_date']) ?></td>
							<td><a href="ViewContactLIst.php?action&id=<?= $data['con_id'] ?>">View</a> ||
								<a href="replayMessage.php?action&id=<?= $data['con_id'] ?>">Replay</a> ||
								<a onclick="return confirm('are you sure!')" href="?sendid=<?= $data['con_id'] ?>">Seen</a></td>
						</tr>
					<?php 	} ?>
				</tbody>
			</table>
		</div>
	</div>
	<!-- seen box  -->
	<div class="box round first grid">
		<h2>SeenBox</h2>
		<div class="block">
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>F-Name</th>
						<th>L-name</th>
						<th>Email</th>
						<th>Message</th>
						<th>Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($message->showseenbox() as $val => $data) {
					?>
						<tr class="odd gradeX">
							<td><?= $data['con_fname'] ?></td>
							<td><?= $data['con_lname'] ?></td>
							<td><?= $data['con_email'] ?></td>
							<td><?= substr(($data['con_message']), 0, 50) . "..."  ?></td>
							<td><?= $data['con_date'] ?></td>
							<td><a onclick="return confirm('are you sure!')" href="?delid=<?= $data['con_id'] ?>">Delete</a>
						</tr>
					<?php 	} ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php
get_Footer();
?>