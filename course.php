<?php
	include("config.php");
	$db_handle = new DBController();
	
	$g_course_id=$_GET['id'];
	$cor1 = "select * from courses where course_id='$g_course_id'";
	$cour1 = $db_handle->runQuery($cor1);
	
	$chead1 = "select * from course_heading where course_id='$g_course_id'";
	$cheading1 = $db_handle->runQuery($chead1);	
	
	$re1 = "select * from courses";
	$rec1 = $db_handle->runQuery($re1);	
	
	$sub1 = "select * from  subscription where user_id='2017107'";
	$subs1 = $db_handle->runQuery($sub1);	
	
	$cer1 = "select * from  completed where user_id='2017107'";
	$cert1 = $db_handle->runQuery($cer1);
	
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/function.js"></script>
<script src="js/jAction.js"></script>
<script>
function callCrudActionLoada() {
	alert('ssk');
	
}
$(document).ready(function() {
$('.crcHead').click(function() { 	
    var id = $(this).attr('id');
    var queryString;
	queryString = 'course_heading='+id;
	jQuery.ajax({
	url: "control/LoadTopic.php",
	data:queryString,
	type: "POST",
	success:function(data){
		$("#hmDvWdCrcLd").val('');
		$("#hmDvWdCrcLd").val(data);		
	},
	error:function (){}
	});
	});
});
</script>
</head>
<body>

<ul>
   <li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn">User Name</a>
    <div class="dropdown-content">
      <a href="#">Profile Settings</a>
      <a href="#">Change Password</a>
      <a href="#">Logout</a>
    </div>
  </li>
  <li><a href="notification.php">Notifications</a></li>
  <li><a href="index.php">Home</a></li> 
  <input type="text" name="search" id="hm_srch" placeholder="Search..">
</ul>
<div id="navLft" class="sidenav" style="background:#fff; color:#000; border-right:1px solid #000; margin-left:-30px;">
 <p style="text-align:center; font-weight:bold;"><?php echo $cour1[0]['course_name']; ?></p>
 <hr/>
 <?php
			
			$result = mysql_query($chead1);
			while($cheading21=mysql_fetch_array($result))
			{
			?>
			<ol style="cursor:pointer; border-bottom:1px solid #888;" onclick="callCrudActionLoad()" class="crcHead" id="<?php echo $cheading21['id']; ?>"><i>&#8594; </i><?php echo $cheading21['topic']; ?></ol>				
			<?php
			}
?>
</div>

<span style="font-size:20px;cursor:pointer;  color:#fff; position:absolute; top:10px; border:1px solid #fff; padding:0px 5px; border-radius:5px;" onclick="openNav()">&#9776;</span>

<div  class="hmDvWd" id="hmDvWdCrcLd">
gdfgdfgdfg
</div>
</body>
</html>
