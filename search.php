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
	if(!isset($_POST['search']) || $_POST['search'] == null ){
		header("location:404.php");
	}else{
        // echo"yes";
		$search = $_POST['search'];
	}
?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<?php 
					$sql = "SELECT * FROM blog_createpost WHERE post_tile like '%$search%' OR post_text  like '%$search%'";
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
                <?php }}else{?>
                    <p style="font-size:25px">Your search query not found!!</p>
                <?php }?>

				
				
	</div>
</div>
<?php 
get_Sidebar();
get_Footer();
?>