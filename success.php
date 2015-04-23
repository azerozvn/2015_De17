<?php 
	session_start();
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<title>Sucessful login!</title>
 	<link href='//fonts.googleapis.com/css?family=Roboto+Slab:400,700,300&subset=latin,vietnamese' rel='stylesheet' type='text/css'>
 	<link rel="stylesheet" href="assets/ui/semantic.css">
 	<link rel="stylesheet" href="assets/css/main.css">
 </head>
 <body class="vertical-center">
 	<div class="container">
 		<div class="ui grid">
 			<div class="row">
 				<div class="column">
	 				<div class="ui header centered">
	 					<h1 class="ui header" style="margin-bottom: 1em;">Hello, <?php echo $_SESSION['name']; ?>!</h1>
	 				</div>
	 				<div class="return-box text-center">
	 					<p>You have successfully logged in! Thank you for using our app! </p>
	 					<p>Press the button below to return to homepage</p>
	 					<a href="index.php" class="ui primary button">Return</a>
	 				</div>
 				</div>
 			</div>
 		</div>
 	</div>
 </body>
 </html>

 <?php 
 	session_destroy();
  ?>