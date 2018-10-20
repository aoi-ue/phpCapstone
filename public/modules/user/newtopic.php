<?php
session_start();
require_once '../../includes/autoload.php';

use classes\business\ForumManager;
use classes\entity\Forum;
use classes\business\Validation;


ob_start();
include '../../includes/security.php';
include '../../includes/header.php';
session_regenerate_id(TRUE);

?>

<?php
$success="";
$formerror="";
$error_fname="";
$error_lname="";
$userid="";
$company_name="";
$country="";
$details="";
$userid="";
//$posted_on="";
//$position_title="";
//$description="";
$to_id="";
$from_id="";
$firstName="";
$title="";
$post="";
$firstName="";
$validate=new Validation();
$validate1=new Validation();


if(isset($_POST["Forum_Submit"])){

    $title=strip_tags($_POST["title"]);
    $post=strip_tags($_POST["post"]);


    //$validate->check_fname($subject, $error_fname);
    //$validate1->check_lname($content, $error_lname);


    if($error_fname == "" && $error_lname == ""){

//			foreach($_POST['to_id'] as $to_id){
        if($_SESSION["id"] !== $to_id){
            $forum=new Forum();
            $forum->from_id=$_SESSION["id"];
//            $forum->to_id=$to_id;
            $forum->title=$title;
            $forum->post=$post;
            date_default_timezone_set('Singapore');
            $timestamp = date("Y-m-d H:i:s");
            $forum->time_sent=$timestamp;
            $MM=new forumManager();
            $MM->insertforum($forum);
            //print_r($forum);

            $success="forum Successfully Sent!";
            // header("Location:../../modules/user/jobopp.php");
        }else{
            $formerror="You can't send a forum to yourself";

        }
//			}


    }
}

?>

<link rel="stylesheet" href=".\css\pure-release-1.0.0\pure-min.css">
<style>
    .error{color:red;}
    }
</style>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css"></head>


<h1> Start a Topic</h1>
<form class="pure-form pure-u-lg-1-4" id="Form" method="post">
    <fieldset class="pure-group">
        <input type="text" class="pure-input-1-2" placeholder="Enter Name" name ="to_id">
        <input type="text" class="pure-input-1-2" placeholder="Title of Topic" name="title">
        <textarea class="pure-input-1-2" placeholder="Post it here" name="post"></textarea>
    </fieldset>
    <button type="submit" class="pure-button pure-input-1-2 pure-button-primary" name ="Forum_Submit" value="Send">Submit</button>
</form>


</body>
</html>

<?php
include '../../includes/footer.php';
?>
