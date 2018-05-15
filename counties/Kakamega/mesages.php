<?php
ini_set('error_reporting', E_ALL & ~E_NOTICE);
require_once("config.php");



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
				<a class="navbar-brand" href="#"><span>Messages</span>Admin</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> User <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
							<li><a href="#"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
							<li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
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
		<li><a href="../../county-Dashboard.html"><span class="glyphicon glyphicon-dashboard"></span>County Dashboard</a></li>
			<li><a href="Dashboard.html"><span class="glyphicon glyphicon-dashboard"></span>Kakamega Dashboard</a></li>
			<li class="parent ">
				<a  href="constituency-dashboard.html">
					<span class="glyphicon glyphicon-list"></span> Constituencies <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="glyphicon glyphicon-s glyphicon-plus"></em></span> 
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li>
							
						<a class="" href="constituency/lugari.html">
						<span class="glyphicon glyphicon-share-alt"></span> Lugari

</a>
					</li>
					<li>
						<a class="" href="constituency/likuyani.html">
							<span class="glyphicon glyphicon-share-alt"></span>  Likuyani
						</a>
					</li>
					<li>
						<a class="" href="constituency/malava.html">
							<span class="glyphicon glyphicon-share-alt"></span> Malava
						</a>
					</li>
					<li>
						<a class="" href="constituency/lurambi.html">
							<span class="glyphicon glyphicon-share-alt"></span> Lurambi
						</a>
					</li>
						<li>
						<a class="" href="constituency/navakholo.html">
							<span class="glyphicon glyphicon-share-alt"></span> Navakholo
						</a>
					</li>
					<li>
						<a class="" href="constituency/butere.html">
							<span class="glyphicon glyphicon-share-alt"></span> Butere
						</a>
					</li>
					<li>
						<a class="" href="constituency/matungu.html">
							<span class="glyphicon glyphicon-share-alt"></span> Matungu
						</a>
					</li>
					
					
					<li>
						<a class="" href="constituency/khwisero.html">
							<span class="glyphicon glyphicon-share-alt"></span> Khwisero
						</a>
					</li>
					<li>
						<a class="" href="constituency/shinyalu.html">
							<span class="glyphicon glyphicon-share-alt"></span> Shinyalu
						</a>
					</li>
					<li>
						<a class="" href="constituency/ikolomani.html">
							<span class="glyphicon glyphicon-share-alt"></span> Ikolamani
						</a>
					</li>
					
					<li>
						<a class="" href="constituency/mumias-east.html">
							<span class="glyphicon glyphicon-share-alt"></span>Mumias East
						</a>
					</li>
					<li>
						<a class="" href="constituency/mumias-west.html">
							<span class="glyphicon glyphicon-share-alt"></span> Mumias West
						</a>
					</li>
					
				</ul>
				</li>
                <li><a href="analytics.html"><span class="glyphicon glyphicon-stats"></span> Analytics</a></li>
		<!--	<li><a href="con-analytics.html"><span class="glyphicon glyphicon-pencil"></span> Constituency Analytics</a></li>-->
               <li><a href="mesages.php"><span class="glyphicon glyphicon-comment"></span> Messages</a></li
			
			<li role="presentation" class="divider"></li>
			<li><a href="login.html"><span class="glyphicon glyphicon-user"></span> Login Page</a></li>
		</ul>
	
	</div>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">Sms</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">MailBox</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Messages</div>
					<div class="panel-body">
						<table data-toggle="table"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
						    <thead>
						    <tr>
						        <th data-field="name" data-sortable="true" >Name</th>
						        <th data-field="surname" data-sortable="true">Surname</th>
								<th data-field="gender"  data-sortable="true">Gender</th>
								<th data-field="age" data-sortable="true">Age</th>
						        <th data-field="number" data-sortable="true">Issue Phone Number</th>
                                <th data-field="constituency" data-sortable="true">Constituency</th>
								       <th data-field="message" data-sortable="true">Issue</th>
									    <th data-field="date" data-sortable="true">Date created</th>
						    </tr>
						    </thead>
							<tbody>
							<?php
       
        $query="select firstname,secondName, gender,age, msisdn,constituency,message,  ujumbemessages.dateCreated from ujumbe_users join ujumbemessages on ujumbe_users.Id= ujumbemessages.userId  ";
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
    $issue=$row['message'];
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
	<td>".$location."</td>
   
    <td> ".$issue." </td>
     <td> ".$datecreated ."</td>
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
	<script src="js/chart-data.js"></script>
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
