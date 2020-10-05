<?php
require_once('funcions/function.php');
require_once('Controller/UserRolesController.php');
get_Header();
get_Sidebar();

$post = new UserRolesController();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $result = $post->InsertData($_POST);
}



?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Category</h2>
        <div class="block copyblock">
            <form action="" method="POST" enctype="multipart/form-data">
                <?php
                if (isset($result)) {
                    echo $result;
                }
                ?>
                <table class="form">
                    <tr>
                        <td>
                            <input type="text" name="name" placeholder="Enter Role Name..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button type="submit" name="submit">Submit</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php
get_Footer();
?>