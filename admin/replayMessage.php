<?php
require_once('funcions/function.php');
require_once('Controller/ContactController.php');
require_once('../Config/Database.php');
get_Header();
get_Sidebar();

$replay = new Contact();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $result = $replay->replayMessage($_POST);
}
?>
<?php

if (isset($_GET['action'])) {
    $id = $_GET['id'];
    $data = $replay->getmessage($id);
}
?>






<div class="grid_10">
    <div class="box round first grid">
        <h2>Replay Message</h2>
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
                            <label>To Email</label>
                        </td>
                        <td>
                            <input type="text" readonly name="toemail" value="<?= $data['con_email'] ?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>From Email</label>
                        </td>
                        <td>
                            <input type="email" name="fromemail" placeholder="Enter Email" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Subject</label>
                        </td>
                        <td>
                            <input type="text" name="subject" placeholder="Enter Subject" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Replay</label>
                        </td>
                        <td>
                            <textarea style="width:70%" name="message" class="form-control" placeholder="enter Replay message" rows="10"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <button name="submit">Send</button>
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