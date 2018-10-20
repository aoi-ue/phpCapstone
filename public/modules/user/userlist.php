<?php
session_start();
require_once '../../includes/autoload.php';

use classes\business\FeedbackManager;
use classes\business\UserManager;
use classes\entity\User;


ob_start();
include '../../includes/security.php';
include '../../includes/header.php';
session_regenerate_id(TRUE);
//$FM=new FeedbackManager();
//$feeds=$FM->getAllFeedback();
$UM=new UserManager();
$users=$UM->getAllUsers();



if(isset($users)){
    ?>
	<link rel="stylesheet" href="..\..\css\pure-release-1.0.0\pure-min.css">
    <h4 style="margin-top: 60px;">Registered Developers in the community portal <h4/>
	<br>
    <table class="pure-table pure-table-bordered" width="800">
            <tr>
			<thead>
               <th><b>Id</b></th>
               <th><b>First Name</b></th>
               <th><b>Last Name</b></th>
               <th><b>Email</b></th>
			   <th><b>Role</b></th>
			   <th><b>Operation</b></th>
			   </thead>
            </tr>    
    <?php 

	foreach ($users as $user) {
        if($user!=null){
            ?>
            <tr>
               <td><?=$user->id?></td>
               <td><?=$user->firstName?></td>
               <td><?=$user->lastName?></td>
               <td><?=$user->email?></td>
			   <td><?=$user->role?></td>
			   <td>
					<a href='edituser.php?id=<?php echo $user->id ?>'>Edit</a>
					<a href='deleteuser.php?id=<?php echo $user->id ?>'>Delete</a>
			   </td>
            </tr>
            <?php 
        }
    }
    ?>
    </table><br/><br/>
    <?php 
}
?>



<?php
include '../../includes/footer.php';
?>