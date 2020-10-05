<?php 
	require_once('Functions/functions.php');
	require_once('Config/Database.php');
	require_once('helpers/Formate.php');
	get_Header();
	get_menu();
	
	
?>

<?php 
	$db = new Database();
	$Formate = new Formate();
?>
<!-- start pasination  -->
<?php 
	$per_Page = 2;
	if(isset($_GET['page'])){
		$page = $_GET['page'];
	}else{
		$page = 1;
	}
	$start_Form = ($page-1)*$per_Page;
	// echo $start_Form;
?>
<!-- end pasination  -->
<div class="slidersection templete clear">
        <div id="slider">
            <a href="#"><img src="images/slideshow/01.jpg" alt="nature 1" title="This is slider one Title or Description" /></a>
            <a href="#"><img src="images/slideshow/02.jpg" alt="nature 2" title="This is slider Two Title or Description" /></a>
            <a href="#"><img src="images/slideshow/03.jpg" alt="nature 3" title="This is slider three Title or Description" /></a>
            <a href="#"><img src="images/slideshow/04.jpg" alt="nature 4" title="This is slider four Title or Description" /></a>
        </div>
</div>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<?php 
				$sql = "SELECT * FROM  blog_createpost order by post_id desc limit $start_Form,$per_Page";
				$post = $db->conn->query($sql) ;
				if($post){
					while($result = $post->fetch_assoc()){
				?>
			<div class="samepost clear">
				<h2><a href="post.php?id=<?=$result['post_id']?>"><?=$result['post_tile']?></a></h2>
				<h4><?=$Formate->makeDate($result['post_date'])?>, By <a href="#"> sajib</a></h4>
				 <a href="#"><img src="admin/<?=$result['post_image']?>" alt="post image"/></a>
				<p><?=$Formate->shortext($result['post_text'])?></p>
				<div class="readmore clear">
					<a href="post.php?id=<?=$result['post_id']?>&catId=<?=$result['cat_id']?>">Read More</a>
				</div>
			</div>
			
			<?php }}else{header('location:404.php');}?>
			<!-- pasination start -->
			<?php 
				$sel = "SELECT * FROM blog_createpost ";
				$result = $db->conn->query($sel);
				$total_rows = mysqli_num_rows($result);
				$total_Page = ceil($total_rows/$per_Page);

				echo "<span class='pasination'><a href='index.php?page=1'>".'<<'."</a>";
				for($i = 1 ; $i<=$total_Page;$i++){
					echo"<a href='index.php?page=".$i."'> ". $i ." </a>";
				}
				echo" <a href='index.php?page=$total_Page'>".'>>'."</a></span>"?>
			<!-- pasination end  -->
		</div>
		
<?php 
get_Sidebar();
get_Footer();
?>
	