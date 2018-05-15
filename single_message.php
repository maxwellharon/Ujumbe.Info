<?php
 include("header.php");

 
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

<script type="text/javascript">
function showUserOption() {
        var userOptions = document.getElementById("userOptions");
        userOptions.style.display = "block";
		
    }

    function hideUserOption() {
        var userOptions = document.getElementById("userOptions");
        userOptions.style.display = "none";
    }


    function showsms() {
        var userOptions = document.getElementById("sms");
        userOptions.style.display = "block";
    }

    function hidesms() {
        var userOptions = document.getElementById("sms");
        userOptions.style.display = "none";
    }

</script>

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
				<a class="navbar-brand" <?php 
				if($role=="governor")
				{
				?>href="governor.php"><?php }
				elseif($role=="senator"){?>href="senator.php">
				<?php }
				elseif($role=="deputy president") {?>href="deputy_president.php">
				<?php }
				elseif($role=="mp") {?>href="specific-constituency.php">
				<?php }
				elseif($role=="commissioner") {?>href="county_commissioner.php">
				<?php }
				elseif($role=="commandant") {?>href="county_commandant.php">
				<?php }
				elseif($role=="judiciary") {?>href="judiciary.php">
				<?php }
				elseif($role=="president") {?>href="president.php">
				<?php }
				elseif($role=="women rep") {?>href="women_rep.php">	
				<?php }
				elseif($role=="cs internal security") {?>href="internal_cs.php">	
				<?php }
				elseif($role=="cs health") {?>href="health_cs.php">	
				<?php }
				elseif($role=="cs education") {?>href="education_cs.php">	
				<?php }
				elseif($role=="cs devolution") {?>href="devolution_cs.php">	
				<?php }
				else {?>href="login.html"><?php } ?>			
				<span><?php echo $place;?></span>Messages</a>
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
			
            
            <li><a href="specific-messages.php"><span class="glyphicon glyphicon-comment"></span>Messages</a></li>
			
			<li role="presentation" class="divider"></li>
			<li><a href="logout.php"><span class="glyphicon glyphicon-user"></span> Logout</a></li>
		</ul>
	
	</div>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
					<li ><a href="constituency-dashboard.php"><span class="glyphicon glyphicon-eye-close"></span> <?php $qury="select constituency from constituency  where constituency='$place'"; 
						 $result= mysql_query($qury);
						while($data=mysql_fetch_assoc($result)){
                          echo $data['constituency'];}?> </a></li>
  <li ><a href="specific-messages.php"><span class="glyphicon glyphicon-comment"></span> Messages </a></li>
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
			
	
		
							<?php
               
        //$query="select * from  ujumbemessages where id='".$_GET['id']."' ";
	  $query="select ujumbe_users.firstname,ujumbe_users.secondName, ujumbe_users.gender,ujumbe_users.age, ujumbemessages.msisdn,constituency.constituency,issue.issue,ujumbemessages.issueId,ujumbemessages.id,
      ujumbemessages.message, ujumbemessages.dateCreated 
	  from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id where ujumbemessages.id='".$_GET['id']."'";
 $sql= mysql_query($query);
 if($sql === FALSE) { 
    die(mysql_error()); // TODO: better error handling
}
 
  while($row=mysql_fetch_array($sql))
{
			$id=$row['id'];
			$fname=$row['firstname'];
			$sname=$row['secondName'];
			$age=$row['age'];
			$gender=$row['gender'];
			$location=$row['constituency'];
			$msisdn=$row['msisdn'];
			$issue=$row['issue'];
			$message=$row['message'];
		  $datecreated=$row['dateCreated'];

		  if($gender=1){
		   $gender='Male';
				   
		  }else {
			  $gender='Female';
			  
			  
		  }
		  ?>
<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading"><?php echo $issue;  ?></div>
					<div class="panel-body">
						<?php		  
		  
		  
		
echo"
<p>Full Name: ".$fname." ".$sname."</p>
<p>Age: ".$age." </p>
<p>Gender: ".$gender."</p>
<p>Location: ".$location."</p>
<p> Phone number ".$msisdn."</p>
<p><strong>Message:</strong>".$row['message']."</p>
<hr>
";

		
	 }
?>

<?php
if($role=='mp' || $role=='senator' || $role=='governor' || $role=='women rep' || $role=='commissioner' || $role=='commandant')
{
?>
 <label class="control-label" for="response">Response By </label>				
<select id="sbox" >
<option value="1" onClick= "hideUserOption(),hidesms();">...Choose one...</option>
<option value="2" onClick="hideUserOption(),showsms();">SMS</option>
<option value="3" onClick="showUserOption(),hidesms ();">FORWARD</option>
</select>
<?php } 
else {?>

<label class="control-label" for="response">Response By </label>				
<select id="sbox" >
<option value="1" onClick="hidesms();">...Choose one...</option>
<option value="2" onClick="showsms();">SMS</option>
</select>
<?php } ?>
      
      
      
  
   <div id="sms" style="display:none">
    <div id="container">
    
   
   
    <form action="replysms.php" method="post">
     <div class="control-group">
        <label for="phoneNumber">Phone Number</label>
       <input type="text" name="phoneNumber" id="phoneNumber" disabled value="<?php echo $msisdn ?>"/>
       <input type="hidden" name="id" id="id" value="<?php echo $_GET['id']?>"/>
    </div>
       
        <div class="control-group">
        <label for="smsMessage">Message</label>
       <textarea name="smsMessage" id="smsMessage" cols="45" rows="5" class="input-xxlarge"></textarea>
    </div>
    	  
    <p class="stdformbutton">
   <input class="btn btn-primary" name="submit" id="submit" type="submit" value="Submit" >

   </form>
  </div>
  </div>
  
   
              <div id="userOptions" style="display:none">
              <div id="container">
                  <form method="post" action="forward.php">
                  
						

    <label class="control-label" for="receiver">Receiver </label>
    <select name="receiver">
     
         <!--<option value="select recipient" selected="">select recipient</option> -->
         <?php 
         
    $query=mysql_query("select ujumbemessages.msisdn,constituency.const_id,issue.issue,ujumbemessages.issueId,ujumbemessages.id       
	  from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id where ujumbemessages.id='".$_GET['id']."'");
	  
	  if(!query)
	  {
	  echo "could not execute query";
	  die(mysql_error());
	  }
	  
	  while($resultss=mysql_fetch_array($query))
	  {
	  $const=$resultss['const_id'];
	  $queryy=mysql_query("select honourable from constituency where const_id='$const'");
	  
	  if(!queryy)
	  {
	  echo "could not execute queryy";
	  die(mysql_error());
	  }
	  
	  while($rr=mysql_fetch_array($queryy))
	  {
	  $mp=$rr['honourable'];
	  }
	  
	  $query2=mysql_query("select id from county join constituency on constituency.cont_id=county.id where constituency.const_id='$const'");
	  
	  if(!query2)
	  {
	  echo "could not execute query2";
	  die(mysql_error());
	  }
	  
	  while($res=mysql_fetch_array($query2))
	  {
	  $county=$res['id'];
	  
	  $query3=mysql_query("select honorable_governor,honorable_senator,women_rep,county_commissioner,county_commandant from county where id='$county'");
	  
	  if(!query3)
	  {
	  echo "could not execute query3";
	  die(mysql_error());
	  }
	  
	  while($rset=mysql_fetch_array($query3))
	  {
	  $governor=$rset['honorable_governor'];
	  $senator=$rset['honorable_senator'];
	  $womenrep=$rset['women_rep'];
	  $commissioner=$rset['county_commissioner'];
	  $commandant=$rset['county_commandant'];
	  }
	  }
	  }
	  
         ?> 
         <?php      
if($role=='mp'){ ?>
            <option value="<?php echo $governor?>"><?php echo $governor?>&nbsp;&nbsp;(Governor)</option>
            <option value="<?php echo $senator ?>"><?php echo $senator ?>&nbsp;&nbsp;(Senator)</option>
            <option value="<?php echo $womenrep?>"><?php echo $womenrep?>&nbsp;&nbsp;(Women Rep)</option>
            <option value="<?php echo $commissioner ?>"><?php echo $commissioner ?>&nbsp;&nbsp;(Commissioner)</option>
            <option value="<?php echo $commandant ?>"><?php echo $commandant ?>&nbsp;&nbsp;(Commandant)</option>
            <div class="controls"><input type="hidden" name="sender" id="sender" class="input-large" value="<?php echo $mp;?>"/></div>		
           <?php } ?>
           
           
           <?php
            if($role=='governor'){ ?>
            <option value="<?php echo $mp?>"><?php echo $mp ?>&nbsp;&nbsp;(MP)</option>
            <option value="<?php echo $senator ?>"><?php echo $senator ?>&nbsp;&nbsp;(Senator)</option>
            <option value="<?php echo $womenrep?>"><?php echo $womenrep?>&nbsp;&nbsp;(Women Rep)</option>
            <option value="<?php echo $commissioner ?>"><?php echo $commissioner ?>&nbsp;&nbsp;(Commissioner)</option>
            <option value="<?php echo $commandant ?>"><?php echo $commandant ?>&nbsp;&nbsp;(Commandant)</option>
            <div class="controls"><input type="hidden" name="sender" id="sender" class="input-large" value="<?php echo $governor;?>"/></div>		
            <?php } ?>
            
            <?php
            if($role=='senator') {
            ?>
            <option value="<?php echo $mp?>"><?php echo $mp?>&nbsp;&nbsp;(MP)</option>
            <option value="<?php echo $governor?>"><?php echo $governor?>&nbsp;&nbsp;(Governor)</option>
            <option value="<?php echo $womenrep?>"><?php echo $womenrep?>&nbsp;&nbsp;(Women Rep)</option>
            <option value="<?php echo $commissioner ?>"><?php echo $commissioner ?>&nbsp;&nbsp;(Commissioner)</option>
            <option value="<?php echo $commandant ?>"><?php echo $commandant ?>&nbsp;&nbsp;(Commandant)</option>
            <div class="controls"><input type="hidden" name="sender" id="sender" class="input-large" value="<?php echo $senator;?>"/></div>		
            <?php } ?>
            
            <?php
            if($role=='women rep') {
            ?>
            <option value="<?php echo $mp?>"><?php echo $mp?>&nbsp;&nbsp;(MP)</option>
            <option value="<?php echo $governor?>"><?php echo $governor?>&nbsp;&nbsp;(Governor)</option>
            <option value="<?php echo $senator ?>"><?php echo $senator ?>&nbsp;&nbsp;(Senator)</option>
            <option value="<?php echo $commissioner ?>"><?php echo $commissioner ?>&nbsp;&nbsp;(Commissioner)</option>
            <option value="<?php echo $commandant ?>"><?php echo $commandant ?>&nbsp;&nbsp;(Commandant)</option>
            <div class="controls"><input type="hidden" name="sender" id="sender" class="input-large" value="<?php echo $womenrep;?>"/></div>		
            <?php } ?>
            
            <?php
            if($role=='commissioner') {
            ?>
            <option value="<?php echo $mp?>"><?php echo $mp?>&nbsp;&nbsp;(MP)</option>
            <option value="<?php echo $governor?>"><?php echo $governor?>&nbsp;&nbsp;(Governor)</option>
            <option value="<?php echo $senator ?>"><?php echo $senator ?>&nbsp;&nbsp;(Senator)</option>
            <option value="<?php echo $womenrep?>"><?php echo $womenrep?>&nbsp;&nbsp;(Women Rep)</option>
            <option value="<?php echo $commandant ?>"><?php echo $commandant ?>&nbsp;&nbsp;(Commandant)</option>
            <div class="controls"><input type="hidden" name="sender" id="sender" class="input-large" value="<?php echo $commissioner;?>"/></div>		
            <?php } ?>
            
            <?php
            if($role=='commandant') {
            ?>
            <option value="<?php echo $mp?>"><?php echo $mp?>&nbsp;&nbsp;(MP)</option>
            <option value="<?php echo $governor?>"><?php echo $governor?>&nbsp;&nbsp;(Governor)</option>
            <option value="<?php echo $senator ?>"><?php echo $senator ?>&nbsp;&nbsp;(Senator)</option>
            <option value="<?php echo $womenrep?>"><?php echo $womenrep?>&nbsp;&nbsp;(Women Rep)</option>
            <option value="<?php echo $commissioner ?>"><?php echo $commissioner ?>&nbsp;&nbsp;(Commissioner)</option>
            <div class="controls"><input type="hidden" name="sender" id="sender" class="input-large" value="<?php echo $commandant;?>"/></div>		
            <?php } ?>
            
          
     
    </select> 
    
               
        <p>                   
        
        <label class="control-label" for="subject">Subject</label>
      <input readonly type="text" name="subject" id="subject" class="input-large" value="<?php echo $issue ?>" />
      
      </p>
   
    <div class="control-group">
      <label for="Body">Sender's Message</label>
       <textarea readonly name="body" id="body" cols="45" rows="5" class="input-xxlarge" ><?php echo  $message ?></textarea>
       <input type="hidden" name="subject1" id="subject1" class="input-large" value="<?php echo $_GET['id'];?>" />
    </div>  
    <div>
    <label for="Body">Your message</label>
       <textarea name="message" id="message" cols="45" rows="5" class="input-xxlarge"></textarea>
    </div>                                         
        <p class="stdformbutton">
   <input class="btn btn-primary" name="submit" id="submit" type="submit" value="Submit" >


             
</form>
</div>
</div>

  
     
     
      
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
