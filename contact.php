<?php
require_once('Functions/functions.php');
require_once('./admin/Controller/ContactController.php');
get_Header();
get_menu();
?>

<?php
$contact = new Contact();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	$result = $contact->GetContact($_POST);
}

?>


<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<div class="about">
			<h2>Contact us</h2>
			<form action="contact.php" method="post" enctype="multipart/form-data">
				<table>
					<?php
					if (isset($result)) {
						echo $result;
					}
					?>
					<tr>
						<td>Your First Name:</td>
						<td>
							<input type="text" name="firstname" placeholder="Enter first name" required="1" />
						</td>
					</tr>
					<tr>
						<td>Your Last Name:</td>
						<td>
							<input type="text" name="lastname" placeholder="Enter Last name" required="1" />
						</td>
					</tr>

					<tr>
						<td>Your Email Address:</td>
						<td>
							<input type="email" name="email" placeholder="Enter Email Address" required="1" />
						</td>
					</tr>
					<tr>
						<td>Your Message:</td>
						<td>
							<textarea name="message"></textarea>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="submit" name="submit" value="Submit" />
						</td>
					</tr>
				</table>
				<form>
		</div>
	</div>
	<?php
	get_Sidebar();
	get_Footer();
	?>