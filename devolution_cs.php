<?php include("header.php");?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Devolution dashboard</title>

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
				<a class="navbar-brand" href="devolution_cs.php"><span>
				DEVOLUTION AND PLANNING
                          </span>
                          </a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> User <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							
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
		 <a href='specific-messages.php'>"; ?><span class="glyphicon glyphicon-envelope"></span> </span>All Messages
		  <span class="badge"><?php $result=mysql_query("SELECT count(*) as total from ujumbemessages join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where  ujumbemessages.message<>'' " );
          $data=mysql_fetch_assoc($result);
          echo $data['total'];?></span>
		 </a></li>
		 <?php
		 $issues=mysql_query("SELECT * FROM issue");
		 while($issue=mysql_fetch_array($issues)):?>
		 <li><a href="specific-messages.php?issueid=<?php echo $issue['id'];?>"><span class="glyphicon glyphicon-envelope"></span></span><?php echo $issue['issue'];?>
		 
		 <span class="badge"><?php $result=mysql_query("SELECT count(*) as total from ujumbemessages join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join issue on ujumbemessages.issueId=issue.id join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where issue.id='".$issue['id']."'and ujumbemessages.message<>'' ");
          $data=mysql_fetch_assoc($result);
          echo $data['total'];?></span></a>
		 
		 
		 </li>
		 
		 <?php endwhile;  ?>
		 
		 
			
		<li role="presentation" class="divider"></li>
			<li><a href="logout.php"><span class="glyphicon glyphicon-user"></span> Logout</a></li>	
		</ul>
	
	</div>
	</div><!--/.sidebar-->
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active"><?php $qury="select constituency from constituency  where constituency='$place'"; 
						 $result= mysql_query($qury);
						while($data=mysql_fetch_assoc($result)){
                          echo $data['constituency'];}?></li>
			</ol>
		</div>
        <div class="row">
			<div class="col-lg-12">
				<h6 ></h6>
			</div>
			
		</div>
		<div class="row">
		<a href="county_messages.php">
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-blue panel-widget ">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<em class="glyphicon glyphicon-map-marker glyphicon-l"></em>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
						<div class="head"><strong>County Messages</strong></div>
							
						</div>
					</div>
				</div>
			</div></a>
			<a href="const_messages.php">
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-teal panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<em class="glyphicon glyphicon-eye-open glyphicon-l"></em>
						</div>
						<div class="col-sm-13 col-lg-7 widget-right">
							<div  class="head"><strong>Constituency Messages</strong></div>
                            
							
					</div>
				</div>
			</div>
		</div></a>
		</div><!--row ended-->
            
            
		<div class="row">
			<div class="col-lg-12">
				
			</div>
		</div><!--/.row-->
		
		<div class="row">
        <div class="panel-heading">Country-wide Analytics</div>
		<?php
		$place='sabatia';
		$array=most_pressing_issue_name($place);
		$i=0;
		$ids=array('easypiechart-red','easypiechart-orange','easypiechart-blue','easypiechart-teal');
		
		foreach($array as $key => $value)
        {
			if(all_messages($place)!=0)
		    $percentage=round(($value/all_messages($place))*100,2);
	        else $percentage=0;
			if($i<4):
		
			?>
        <div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4><?php echo $key;?></h4>
						
						<div class="easypiechart" id="<?php echo $ids[$i];?>" data-percent="<?php echo $percentage;?>" ><span class="percent"><?php echo $percentage;?>%</span>
						</div>
					</div>
				</div>
			</div>
			<?php
			endif;
			$i++;
           			
			
			}?>
			
			
			
		</div>
				
		
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
