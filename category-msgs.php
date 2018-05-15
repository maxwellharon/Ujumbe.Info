<?php
session_start();
if(!isset($_SESSION["username"])){
	header("location:county-login.php");
}
ini_set('error_reporting', E_ALL & ~E_NOTICE);
require_once("config.php");
 $place=$_GET['county'];


?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Ujumbe-Mailbox</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><span><?php $qury="select county from county  where county='$place'"; 
						 $result= mysql_query($qury);
						while($data=mysql_fetch_assoc($result)){
                          echo $data['county'];}?></span>Messages</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> User <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
							<li><a href="#"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
							<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form>
		<ul class="nav menu">
			<ul class="nav menu">
			
				<li> <?php
		 echo"
		 <a href='specific-county.php?county=$place'>"; ?><span class="glyphicon glyphicon-dashboard"></span> <?php $qury="select county from county  where county='$place'"; 
						 $result= mysql_query($qury);
						while($data=mysql_fetch_assoc($result)){
                          echo $data['county'];}?> </a></li>
			
         <li> <?php
		 echo"
		 <a href='category-msgs.php?county=$place'>"; ?>
		 <span class="glyphicon glyphicon-envelope">
		
		 </span> Messages
		   <span class="badge"><?php $result=mysql_query("SELECT count(*) as total from   ujumbemessages join ujumbe_users on ujumbe_users.Id= ujumbemessages.userId join constituency on ujumbe_users.constituency=constituency.const_Id join county on county.id=constituency.cont_id  where county='$place'");
$data=mysql_fetch_assoc($result);
echo $data['total'];?></span>
		 
		 
		 </a></li>
			
			
		</ul>
	
	</div>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
					<li ><a href="constituency-dashboard.php"><span class="glyphicon glyphicon-eye-close"></span> Constituency </a></li>
  <li ><a href="messages-county.php"><span class="glyphicon glyphicon-comment"></span> Messages </a></li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				
			</div>
		</div><!--/.row-->
				<script>
				var pieData = [
				{
					value: 300,
					color:"#30a5ff",
					highlight: "#62b9fb",
					label: "Naivasha"
				},
				{
					value: 50,
					color: "#ffb53e",
					highlight: "#fac878",
					label: "Kibera"
				},
				{
					value: 100,
					color: "#1ebfae",
					highlight: "#3cdfce",
					label: "Nairobi"
				},
				{
					value: 120,
					color: "#f9243f",
					highlight: "#f6495f",
					label: "Mtwapa"
				}

			];
			
	var doughnutData = [
					{
						value: 300,
						color:"#30a5ff",
						highlight: "#62b9fb",
						label: "Nairobi"
					},
					{
						value: 50,
						color: "#ffb53e",
						highlight: "#fac878",
						label: "Narok"
					},
					{
						value: 100,
						color: "#1ebfae",
						highlight: "#3cdfce",
						label: "Mombasa"
					},
					{
						value: 120,
						color: "#f9243f",
						highlight: "#f6495f",
						label: "Kiambu"
					}
	
				];

window.onload = function(){
	
	
	var chart3 = document.getElementById("doughnut-chart").getContext("2d");
	window.myDoughnut = new Chart(chart3).Doughnut(doughnutData, {responsive : true
	});
	var chart4 = document.getElementById("pie-chart").getContext("2d");
	window.myPie = new Chart(chart4).Pie(pieData, {responsive : true
	});
	
};
				</script>
			
	<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">Incoming Messages</div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							<canvas class="chart" id="pie-chart" ></canvas>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">Most Pressing Issue</div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							<canvas class="chart" id="doughnut-chart" ></canvas>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">County Messages</div>
					<div class="panel-body">
						<table data-toggle="table"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
						    <thead>
						    <tr>
						        <th data-field="name" data-sortable="true" >Name</th>
						        <th data-field="surname" data-sortable="true">Surname</th>
								<th data-field="gender"  data-sortable="true">Gender</th>
								<th data-field="age" data-sortable="true">Age</th>
						        <th data-field="number" data-sortable="true"> Phone Number</th>
                               
								       <th data-field="message" data-sortable="true">Issue</th>
									    <th data-field="date" data-sortable="true">Date created</th>
										 <th data-field="constituency" data-sortable="true">Constituency</th>
						    </tr>
						    </thead>
							<tbody>
							<?php
                 
        $query="select firstname,secondName, gender,age, msisdn,constituency.constituency,issue,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.Id= ujumbemessages.userId join constituency on ujumbe_users.constituency=constituency.const_Id  join county on county.id=constituency.cont_id  where county='$place' ";
 $sql= mysql_query($query);
 if($sql === FALSE) { 
    die(mysql_error()); // TODO: better error handling
}
 
  while($row=mysql_fetch_array($sql))
{
   
    $fname=$row['firstname'];
    $sname=$row['secondName'];
    $age=$row['age'];
    $gender=$row['gender'];
    $location=$row['constituency'];
    $msisdn=$row['msisdn'];
    $issue=$row['issue'];
  $datecreated=$row['dateCreated'];

  if($gender=1){
   $gender='Male';
           
  }else {
      $gender='Female';
  }
  

  
            
  echo"
  <tr>
  	
  <td><a href='message.php?id=$datecreated'>". $fname."</a> </td>
    <td>".$sname."</td>
       <td>".$gender."</td>
	    <td>".$age."</td>
		 <td>".$msisdn."</td>

   
    <td> ".$issue." </td>
     <td> ".$datecreated ."</td>
	 <td>". $location."</a> </td>
	 </tr>";
	 }
?>
          
     
      </tbody>
						</table>
					</div>
				</div>
			</div>
		</div><!--/.main-->

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/bootstrap-table.js"></script>
	<script>
		!function ($) {
			$(document).on("click","ul.nav li.parent > a > span.icon", function(){		  
				$(this).find('em:first').toggleClass("glyphicon-minus");	  
			}); 
			$(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	
</body>

</html>
