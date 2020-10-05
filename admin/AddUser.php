<?php ob_start();
require_once('funcions/function.php');
require_once('Controller/UserController.php');
require_once('../Config/Database.php');
require_once('../Config/Seassion.php');
get_Header();
get_Sidebar();
if (Session::get('user_role_id') !== '3') {
    header('location: index.php');
    // echo Session::get('user_role_id');
} else {
    echo "condition hoi nai";
}
$post = new UserController();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $result = $post->InsertData($_POST, $_FILES);
}
$db = new Database();
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New User</h2>
        <div class="block">
            <?php
            if (isset($result)) {
                echo $result;
            }
            ?>
            <form action="" method="Post" enctype="multipart/form-data">
                <table class="form">
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" name="name" placeholder="Enter Name" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>User Name</label>
                        </td>
                        <td>
                            <input type="text" name="username" placeholder="Enter Username" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>User Role</label>
                        </td>
                        <td>
                            <select id="select" name="userRole" name="select">
                                <option>select userRole</option>
                                <?php
                                $sql = "SELECT * FROM blog_user_role";
                                $role = $db->conn->query($sql);
                                if ($role) {
                                    while ($result = $role->fetch_assoc()) {

                                ?>
                                        <option value="<?= $result['user_role_id'] ?>"><?= $result['user_role_name'] ?></option>
                                <?php }
                                } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Email</label>
                        </td>
                        <td>
                            <input type="email" name="email" placeholder="Enter Email" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>password</label>
                        </td>
                        <td>
                            <input type="password" name="password" placeholder="Enter Password" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>confirm password</label>
                        </td>
                        <td>
                            <input type="password" name="confirmPassword" placeholder="Enter ConfirmPassword" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="hidden" name="date" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <input name="pic" type="file" />
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <button name="submit">submit</button>
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