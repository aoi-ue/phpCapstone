<?php
use classes\business\UserManager;
use classes\business\Validation;
ob_start();
session_start();
require_once 'includes/autoload.php';
include 'includes/header.php';
session_regenerate_id(TRUE);
?>
<!--<br><div>--><?//=$formerror?><!--</div>-->
<h3 style="margin-top: 60px; text-align:center;">CONTACT INFORMATION</h3>
<div style="text-align:center;">
<h4>Customer Online Care</h4>
Call us at +65 1800 222 6868 for any assistance required.<br>
   Operating hour is from Monday to Saturday, 10am to 7pm;<br>
   Sunday & Public Holiday, 10am to 2pm.<br><br> 
   
   
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.7600334737967!2d103.88985331447665!3d1.3196913620398996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31da19149fe4a925%3A0x82606eb494fd093c!2sLithan+Academy!5e0!3m2!1sen!2ssg!4v1514739525393" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>
<?php
include './feedback.php';
?>

<?php
include 'includes/footer.php';
?>