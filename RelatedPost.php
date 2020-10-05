<?php 

require_once('Functions/functions.php');
require_once('Config/Database.php');
require_once('helpers/Formate.php');
get_Header();
get_menu();

	$db = new Database();
	$Formate = new Formate();

?>

<?php 
	if(!isset($_GET['id']) || $_GET['id'] == null ){
		header("location:404.php");
	}else{
		$id = $_GET['id'];

	}

?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<?php 
					$sql = "SELECT * FROM blog_createpost WHERE post_id='$id'";
					$post = $db->conn->query($sql);
					if($post){
						while($result = $post->fetch_assoc()){
				?>
				<h2><?=$result['post_tile']?></h2>
				<h4><?=$Formate->makeDate($result['post_date'])?> By <a href="#"> sajib</a></h4>
				<img src="admin/<?=$result['post_image']?>" alt="post image"/>
				<p><?=$result['post_text']?></p>
						<?php }}else{header('location:404.php');}	?>
				
	</div>
</div>
<?php 
get_Sidebar();
get_Footer();
?>