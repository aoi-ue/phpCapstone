<?php
session_start();
require_once '../../includes/autoload.php';

use classes\business\MessageManager;
use classes\entity\Reply;
use classes\business\Validation;
use classes\business\UserManager;
use classes\entity\User;

ob_start();
include '../../includes/security.php';
include '../../includes/header.php';
session_regenerate_id(TRUE);

$_SESSION['message_id'] = $_GET['message_id'];
?>

<?php

$formerror="";
$respond="";
$content="";
$success="";
$topic="";
$time_sent="";
$from_id="";
$error_lname="";
$validate=new Validation();



if(isset($_POST["submitted"])){

    $content=strip_tags($_POST["content"]);
    //$validate->check_lname($content, $error_lname);


    if($error_lname == ""){

        $reply=new Reply();
        $reply->respond=$content;
        $reply->from_id=$_SESSION["id"];
        $reply->content=$content;
        $reply->message_id=$_GET["message_id"];
        date_default_timezone_set('Singapore');
        $timestamp = date("Y-m-d H:i:s");
        $reply->time_sent=$timestamp;
        $MM=new MessageManager();
        $MM->insertReply($reply);
        //print_r($reply);
        $success="Updated Successfully!";

    }else{
        $formerror="Please provide required values";

    }
}

if(isset($_GET["message_id"])){
    $MM=new MessageManager();
    $viewmessage=$MM->getMessageById($_GET["message_id"]);
    $from_id=$viewmessage->from_id;
    $topic=$viewmessage->topic;
    $content=$viewmessage->content;
    $time_sent=$viewmessage->time_sent;
}

$UM=new UserManager();
$username=$UM->getUserById($viewmessage->from_id);
$firstName=$username->firstName;

?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Read Message</title>
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


            <div class="col-md-1"></div>

            <div class="col-md-8" style="background: rgba(255, 255, 255, 1.0); border-radius: 10px; padding: 20px; margin-bottom: 50px;">
                <form name="msgview" method="post">
                    <h1 style="text-align: center;"><strong>View Message</strong></h1>
                    <br>
                    <div><?=$formerror?></div> <div><?=$success?></div>
                    <h4><strong>From</strong> <?=$firstName?></h4>
                    <h4><strong>Topic</strong> <?=$topic?></h4>
                    <hr>
                    <div class='text-justified'>
                        <p><?=$content?></p>
                    </div>
                    <hr>



                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </body>
    </html>

<?php
include '../../includes/footer.php';
?>