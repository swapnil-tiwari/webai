<?php
 session_start();
?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title>DM-AI</title>
		<link rel="stylesheet" type="text/css" href="../css/neural_style.css">
		<link rel="stylesheet" type="text/css" href="../css/main.css">
		<link href="../css/bootstrap.css" rel="stylesheet"/>
		<link href="font-awesome-4.7.0/css/font-awesome.css" rel="stylesheet"/>
		<meta charset="utf-8">
    	<meta name="Description" CONTENT="DawnMist">
		<link href="font-awesome-4.7.0/css/font-awesome.css" rel="stylesheet"/>
		<link href="csssss/bootstrap.min.css" rel="stylesheet"/>
		<script src="js/jquery-3.3.1.min.js"></script>
		<script type='text/javascript' src='../js/particles.js'></script>
		<script type='text/javascript' src='../js/app.js'></script>
		<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="keywords" content="HTML,CSS,XML,JavaScript">
		<meta name="theme-color" content="#2f2f2f">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript">
			$(document).ready(function(){
				$("#control_carousel").click(function()
				{
					$(this).hide();
				});
				$("#control_carousel").click(function()
				{
					$("#particles-js").css("visibility","visible");
				});
			});
		</script>
	</head>
	<body>
		<!--<div id="particles-js"></div>-->
    <br><center><h1 id="caption">DM-AI</h1></center>
    <br><br>
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="false">
     <div class="carousel-inner">
       <div class="carousel-item active">
         <div id="welcome_user" class="container">
     			Welcome to the DM-AI <br> DawnMist
     			<br>Your Username: <?php echo $_SESSION["user"] ?>
     		</div>
       </div>
       <div class="carousel-item ">
         <div id="price_container" class="container">
           <form action="amazon_results.php" method="POST">
                 <label class="price_label">Price Retriever v1.0</label><br>
                 <input class="form_items" placeholder="Enter Product Info" name="p_info" style="font-size:20px"><br>
                 <br>
                 <button type="submit" class="btn btn-outline-info">Search</button><br><br>
           </form>
         </div>
       </div>

     </div>

   </div><br><br>
   <center><button  id="control_carousel" class="btn btn-outline-info" class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
     Go On
     </button>


	</body>
	<script src="../js/particles.js"></script>
	<script src="../js/app.js"></script>
</html>
