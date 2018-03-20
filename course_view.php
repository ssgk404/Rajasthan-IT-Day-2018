<?php
	include("config.php");
	$db_handle = new DBController();
	
	$g_course_id=$_GET['id'];
	$cor1 = "select * from courses where course_id='$g_course_id'";
	$cour1 = $db_handle->runQuery($cor1);	
	
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
<div id="navLft" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="#home" id="home_"><i class="smallIcn" ><img src="images/homeicn.png"></i>Home</a>
  <a href="#courses" id="courses_"><i class="smallIcn" ><img src="images/coursesicn.png"></i>Courses</a>
  <a href="#subscription" id="subscription_"><i class="smallIcn" ><img src="images/subsicn.png"></i>Subsription</a>
  <a href="#certificate " id="certificate_"><i class="smallIcn"><img src="images/certificateicn.png"></i>Certificates</a>
</div>

<span style="font-size:20px;cursor:pointer;  color:#fff; position:absolute; top:10px; border:1px solid #fff; padding:0px 5px; border-radius:5px;" onclick="openNav()">&#9776;</span>

<div  class="hmDvWd" id="hmDvWdCrcVew">
	<p style="font-size:24px;"><?php echo $cour1[0]['course_name']; ?></p>
	<hr/>
	<table style="width:100%;">
		<tr>
			<th>Course ID</th>
			<th>Course Name</th>
			<th>Course Duration</th>
			
		</tr>
		<tr style="width:100%; text-align:center;">
			<td><?php echo $cour1[0]['course_id']; ?></td>
			<td><?php echo $cour1[0]['course_name']; ?></td>
			<td><?php echo $cour1[0]['course_duration']; ?></td>
			<td>
			<?php
				$cid=$cour1[0]['course_id'];
				
				$nsubs = "SELECT * FROM subscription where course_id='$cid' and user_id='2017107'";
				$countSubs = $db_handle->numRows($nsubs);
				if($countSubs<1)
				{
				?>
					<button class="btn-success" id="course_subs" onclick="callCrudAction('SubsCourse','<?php echo $cour1[0]['course_id']; ?>')">Subscribe</button>
				<?php
				}
				else
				{
				?>
					<button class="btn-cancel" id="course_cancel"  onclick="callCrudAction('unsubsCourse','<?php echo $cour1[0]['course_id']; ?>')">Unsubscribe</button>
				<?php
				}
				?>
			</td>
		</tr>
	</table>
	<hr/>
	<table style="width:100%;">
		<tr><th style="float:left;">Description</th></tr>
		<tr><td><?php echo nl2br($cour1[0]['description']); ?></td></tr>
	</table>
</div>

<div id="home" class="hmDvWd" style="display:none;">
	<p>HOME</p>
	<hr/>
	<div id="running_courses" class="crs_mod">
		home gdbjdfgbjdf
	</div>
	<div id="running_courses" class="crs_mod">
		home gdbjdfgbjdf
	</div>
	<div id="running_courses" class="crs_mod">
		home gdbjdfgbjdf
	</div>
	<div id="running_courses" class="crs_mod">
		home gdbjdfgbjdf
	</div>
</div>
<div id="courses" class="hmDvWd" style="display:none;">
	<p>COURSES</p>
		<hr/>
	<?php
		if($rec1 > 0)
			{
				$result = mysql_query($re1);
				while($query2=mysql_fetch_array($result))
				{
				?>
				<a href="course_view.php?id=<?php echo $query2['course_id']; ?>">
				<div id="aval_courses" class="crs_mod" style="background:url(<?php echo $query2['icon']; ?>); background-size:100% 100%;">
					<span style="width:100%; height:40px; color:#fff; background:#000; opacity:0.8; padding:10px; float:left;"><?php echo $query2['course_name']; ?></span>
				</div>
				</a>
				<?php
				}
			}
			else
			{
			 ?>
			 <img src="images/not_found.png" class="not_found"><br/><span class="not_found_txt">No Course Found</span></img>
			<?php
			}
	?>
</div>
<div id="subscription" class="hmDvWd" style="display:none;">
	<p>SUBSCRIPTION</p>
	<hr/>
		<?php
		if($subs1 > 0)
			{
				$result = mysql_query($sub1);
				while($query2=mysql_fetch_array($result))
				{
					$cid=$query2['course_id'];
					$cq1 = "select * from courses where course_id='$cid'";
					$cqu1 = $db_handle->runQuery($cq1);	
					$cname = $cqu1[0]['course_name'];
				?>
				<a href="course.php?id=<?php echo $query2['course_id']; ?>">
				<div id="aval_courses" class="crs_mod" style="background:url(<?php echo $cqu1[0]['icon']; ?>); background-size:100% 100%;">
					<span style="width:100%; height:40px; color:#fff; background:#000; opacity:0.8; padding:10px; float:left;"><?php echo $cname; ?></span>
				</div>
				</a>
				<?php
				}
			}
			else
			{
			 ?>
			 <img src="images/not_found.png" class="not_found"><br/><span class="not_found_txt">You have not subscribe for any course</span></img>
			<?php
			}
	?>
</div>
<div id="certificate" class="hmDvWd" style="display:none;">
	<p>CERTIFICATES</p>
	<hr/>
			<?php
		if($cert1 > 0)
			{
				$result = mysql_query($cer1);
				while($query2=mysql_fetch_array($result))
				{
					$cid=$query2['course_id'];
					$cq1 = "select * from courses where course_id='$cid'";
					$cqu1 = $db_handle->runQuery($cq1);	
					$cname = $cqu1[0]['course_name'];
				?>
				<div id="aval_courses" class="crs_mod" style="background:url(<?php echo $cqu1[0]['icon']; ?>); background-size:100% 100%;">
					<span style="width:100%; height:40px; color:#fff; background:#000; opacity:0.8; padding:10px; float:left;"><?php echo $cname; ?></span>
				</div>
				<?php
				}
			}
			else
			{
			 ?>
			 <img src="images/not_found.png" class="not_found"><br/><span class="not_found_txt">You have not completed any course</span></img>
			<?php
			}
	?>
</div>
</body>
</html>
