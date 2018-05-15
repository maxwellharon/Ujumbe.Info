<?php

require_once("config.php");


ini_set('error_reporting', E_ALL & ~E_NOTICE);
/*$query = mysql_query("select constituency from ujumbe_users where  msisdn='".$_SESSION['login_user']."'");
 if($query === FALSE) { 
    die(mysql_error()); // TODO: better error handling
}
$location=$row['constituency'];*/



?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>County Dashboard</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/bootstrap-table.css" rel="stylesheet">
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
		
		</div><!--/.row-->
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
			<li><a href="county-Dashboard.php"><span class="glyphicon glyphicon-dashboard"></span> County </a></li>
			<li><a href="constituency-dashboard.php"><span class="glyphicon glyphicon-eye-close"></span> Constituency </a></li>
             <li><a href="messages-county.php"><span class="glyphicon glyphicon-envelope"></span> Messages
		  <span class="badge"><?php $result=mysql_query("SELECT count(*) as total from   ujumbemessages join ujumbe_users on ujumbe_users.Id= ujumbemessages.userId join constituency on ujumbe_users.constituency=constituency.const_Id join county on county.id=constituency.cont_id");
$data=mysql_fetch_assoc($result);
echo $data['total'];?></span>
		 </a>
		 </li>
			
			<li role="presentation" class="divider"></li>
			<li><a href="login.html"><span class="glyphicon glyphicon-user"></span> Login Page</a></li>
		</ul>
	
	</div>
	</div><!--/.sidebar-->
		
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				
				<li ><a href="county-Dashboard.php"><span class="glyphicon glyphicon-dashboard"></span> County </a></li>
  <li ><a href="constituency-dashboard.php"><span class="glyphicon glyphicon-eye-close"></span> Constituency </a></li>
  <li ><a href="messages-county.php"><span class="glyphicon glyphicon-comment"></span> Messages </a></li>
			</ol>
		</div><!--/.row-->
	
  
	<div class="row">
        <div class="panel-heading">Analytics</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
					
                    
						<h4>Youth</h4>
						<h5>18 to 35 years old</h5>
						<div class="easypiechart" id="easypiechart-blue" data-percent="92" ><span class="percent">92%</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>Most pressing Issue</h4>
						<h5>Security</h5>
						<div class="easypiechart" id="easypiechart-orange" data-percent="65" ><span class="percent">65%</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>Gender Distribution</h4>
						<h5>Male</h5>
						<div class="easypiechart" id="easypiechart-teal" data-percent="56" ><span class="percent">56%</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>Incoming Messages</h4>
						<h5>New Messages</h5>
						<div class="easypiechart" id="easypiechart-red" data-percent="27" ><span class="percent">27%</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">County Users</div>
					<div class="panel-body">
						<table data-toggle="table"   data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
						    <thead>
						    <tr>
						        <th data-field="name" data-sortable="true" >Name</th>
								  <th data-field="surname" data-sortable="true" >Second Name</th>
						        <th data-field="age" data-sortable="true">Age</th>
						        <th data-field="gender"  data-sortable="true">Gender</th>
						        <th data-field="number" data-sortable="true"> Phone Number</th>
								
								   <th data-field="county" data-sortable="true"> County</th>
                                </tr>
						    </thead>
							<tbody>
							
							<?php
    
        $query="select firstname,secondName, gender,age, msisdn,county from ujumbe_users join constituency on ujumbe_users.constituency=constituency.const_Id join county on county.id=constituency.cont_id";
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
	  $msisdn=$row['msisdn'];
	
	   $location1=$row['county'];
  


 

  if($gender=1){
   $gender='Male';
           
  }
  else {
      $gender='Female';
	  }

  echo"
  <tr>
  <td><a href='message.php?id=$datecreated'>". $fname."</a> </td>
    <td>".$sname."</td>
       <td>".$gender."</td>
	    <td>".$age."</td>
		 <td>".$msisdn."</td>
		
		  <td><a href='specific-county.php?county=$location1'>".$location1."</td>

   
 
	 </tr>";
}
?>
                        </tbody>
						</table>
					</div>
				</div>
			</div>
		</div><!--/.row-->	
		<!--<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">Basic Table</div>
					<div class="panel-body">-->
						<!--<table data-toggle="table" data-url="tables/data2.json" >
						    <thead>
						    <tr>
						        <th data-field="id" data-align="right">Item ID</th>
						        <th data-field="name">Item Name</th>
						        <th data-field="price">Item Price</th>
						    </tr>
						    </thead>
						</table>-->
				<!--	</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">Styled Table</div>
					<div class="panel-body">
						<table data-toggle="table" id="table-style" data-url="tables/data2.json" data-row-style="rowStyle">
						    <thead>
						    <tr>
						        <th data-field="id" data-align="right" >Item ID</th>
						        <th data-field="name" >Item Name</th>
						        <th data-field="price" >Item Price</th>
						    </tr>
						    </thead>
						</table>-->
						<script>
						    $(function () {
						        $('#hover, #striped, #condensed').click(function () {
						            var classes = 'table';
						
						            if ($('#hover').prop('checked')) {
						                classes += ' table-hover';
						            }
						            if ($('#condensed').prop('checked')) {
						                classes += ' table-condensed';
						            }
						            $('#table-style').bootstrapTable('destroy')
						                .bootstrapTable({
						                    classes: classes,
						                    striped: $('#striped').prop('checked')
						                });
						        });
						    });
						
						    function rowStyle(row, index) {
						        var classes = ['active', 'success', 'info', 'warning', 'danger'];
						
						        if (index % 2 === 0 && index / 2 < classes.length) {
						            return {
						                classes: classes[index / 2]
						            };
						        }
						        return {};
						    }
						</script>
					</div>
				</div>
			</div>
		</div><!--/.row-->	
		
		
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
