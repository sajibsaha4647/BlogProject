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
<!-- pasination  -->
<?php 
	$per_Page = 2;
	if(isset($_GET['page'])){
		$page = $_GET['page'];
	}else{
		$page = 1;
	}
	$start_Form = ($page-1)*$per_Page;

?>
<!-- pasination  -->
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<?php 
					$sql = "SELECT * FROM blog_createpost WHERE cat_id='$id' limit $start_Form,$per_Page";
					$post = $db->conn->query($sql);
					if($post){
						while($result = $post->fetch_assoc()){
				?>
				<h2><?=$result['post_tile']?></h2>
				<h4><?=$Formate->makeDate($result['post_date'])?> By <a href="#"> sajib</a></h4>
				<img src="admin/<?=$result['post_image']?>" alt="post image"/>
				<p><?=$Formate->shortext($result['post_text'])?></p>
				<div class="readmore clear">
					<a href="post.php?id=<?=$result['post_id']?>&catId=<?=$result['cat_id']?>">Read More</a>
				</div>

						<?php }}else{header('location:404.php');}	?>

				<!-- pasination  -->
				<?php 
					$sel = "SELECT * FROM blog_createpost";
					$result = $db->conn->query($sel);
					$total_rows = mysqli_num_rows($result);
					$total_Page = ceil($total_rows/$per_Page);
					echo "<span class='pasination'><a href='posts.php?page=1'>".'<<'."</a>";
					for($i = 1 ; $i<=$total_Page;$i++){
						echo"<a href='index.php?page=".$i."'>".$i."</a>";
					}
					echo" <a href='posts.php?page=$total_Page'>".'>>'."</a></span>"?>


				<!-- pasination  -->
				
	</div>
</div>
<?php 
get_Sidebar();
get_Footer();
?>