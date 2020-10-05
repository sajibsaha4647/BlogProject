<?php
require_once('Config/Database.php');
require_once('Config/Seassion.php');

$db = new Database();
$Session = new Session();
?>
<div class="sidebar clear">
	<div class="samesidebar clear">
		<h2>Categories</h2>
		<ul>
			<?php
			$sql = "SELECT * FROM  blog_category";
			$post = $db->conn->query($sql);
			if ($post) {
				while ($result = $post->fetch_assoc()) {
			?>
					<li><a href="posts.php?id=<?= $result['cat_id'] ?>"><?= $result['cat_name'] ?></a></li>
			<?php }
			} ?>
		</ul>
	</div>

	<div class="samesidebar clear">
		<h2>Latest articles</h2>
		<?php
		$sql = "SELECT * FROM  blog_createpost limit 5";
		$post = $db->conn->query($sql);
		if ($post) {
			while ($result = $post->fetch_assoc()) {
		?>
				<div class="popular clear">
					<h3><a href="post.php?id=<?= $result['post_id'] ?>"><?= $result['post_tile'] ?></a></h3>
					<a href="post.php?id=<?= $result['post_id'] ?>"><img src="admin/<?= $result['post_image'] ?>" alt="post image" /></a>
					<p><?= substr(($result['post_text']), 0, 100) . '...' ?></p>

				</div>
		<?php }
		} ?>
	</div>

</div>
</div>