<?php
session_start();
require_once '../../includes/autoload.php';

use classes\business\UserManager;
use classes\entity\User;
use classes\business\ForumManager;
use classes\entity\forum;
use classes\business\Validation;

ob_start();
include '../../includes/security.php';
include '../../includes/header.php';
session_regenerate_id(TRUE);


$formerror="";
$title="";
$date_created="";
$userid="";
$error_fname="";
$to_id="";
$validate=new Validation();


$MM=new ForumManager();
$forums=$MM->getReceiveById($_SESSION["id"]);

$UM=new UserManager();

if(isset($forums)){
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Inbox</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </head>
    <body style="background: url('../../images/91134-OIW11W-632.png') no-repeat center center fixed;
	  -webkit-background-size: cover;
	  -moz-background-size: cover;
	  -o-background-size: cover;
	  background-size: cover;"> <!--<a href="http://www.freepik.com">Designed by Freepik</a>-->


                                                 <!--Content -->
    <div class="container" style="margin-top: 70px;">
    <div class="row">
    <div class="col-md-3" style="background: whitesmoke; border-radius: 10px;text-align: center; padding: 20px;">

        <a href="compose.php" style="font-size: 20px;"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;"></span> New forum</a>
        <br>
        <a href="inbox.php" style="font-size: 20px;"><span class="glyphicon glyphicon-envelope" style="font-size: 20px;"></span> Inbox</a>
        <br>
        <a href="sent.php" style="font-size: 20px;"><span class="glyphicon glyphicon-send" style="font-size: 20px;"></span> Sent </a>
    </div>

    <div class="col-md-1"></div>

    <div class="col-md-8" style="background: rgba(255, 255, 255, 1.0); border-radius: 10px; padding: 20px; margin-bottom: 120px;">
    <h1 class="text-center"><strong>Inbox</strong></h1>

    <br>
    <br>
    <form method="post" action="inbox.php">
    <table class="table table-hover">
        <thead>
        <tr>
            <th>From</th>
            <th>Topic</th>
            <th>Received</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php

        foreach ($forums as $forum) {
            if($forum!=null){
                $users=$UM->getUserById($forum->from_id);
                ?>
                <tr>
                    <td><?=$users->firstName?></td>
                    <td><?=$forum->title?></td>
                    <td><?=$forum->post?></td>
                    <td><?=$forum->time_sent?></td>
                    <td><a href='readforum.php?forum_id=<?php echo $forum->forum_id ?>'>Read</a></td>
                </tr>
                <?php
            }
        }
        ?>
        </tbody>
    </table>
    <?php
} else { echo "no results";}
?>
    </form>
    </div>

    </div>
    <div class="row">
        <div class="col-md-12" style="margin: 67px;"></div>
    </div>
</div>
</body>
    </html>

<?php
include '../../includes/footer.php';
?>