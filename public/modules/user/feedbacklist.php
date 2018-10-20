<?php
session_start();
require_once '../../includes/autoload.php';

use classes\business\FeedbackManager;
//use classes\business\UserManager;
use classes\entity\User;

ob_start();
include '../../includes/security.php';
include '../../includes/header.php';
session_regenerate_id(TRUE);

$FM=new FeedbackManager();
$feeds=$FM->getAllFeedback();
//$UM=new UserManager();
//$users=$UM->getAllUsers();


if(isset($feeds)){
//if(isset($users)){
    ?>
	<link rel="stylesheet" href="..\..\css\pure-release-1.0.0\pure-min.css">
    <br/><br/>Below is the list of Feedback Given <br/><br/>
    <table class="pure-table pure-table-bordered" width="800">
            <tr>
			<thead>
               <th><b>Id</b></th>
               <th><b>First Name</b></th>
               <th><b>Last Name</b></th>
               <th><b>Email</b></th>
			   <th><b>Comments</b></th>
			   <th><b>Operation</b></th>
			   </thead>
            </tr>    
    <?php 
    	foreach ($feeds as $feed) {
        if($feed!=null){
            ?>
            <tr>
               <td><?=$feed->id?></td>
               <td><?=$feed->firstName?></td>
               <td><?=$feed->lastName?></td>
               <td><?=$feed->email?></td>
			   <td><?=$feed->comments?></td>
			   <td>
					<!--<a href='deleteuser.php?id=<?php echo $user->id ?>'>Respond</a>-->Respond
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