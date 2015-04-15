<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login System</title>
	<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300&subset=latin,vietnamese' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="assets/ui/semantic.css">
	<link rel="stylesheet" href="assets/css/main.css">
</head>
<body class="vertical-center">
	<div class="container">
		<div class="ui grid">
			<div class="row">
				<div class="ui header centered">
					<h1 class="ui header">Login via your Social Account</h1>
					<div class="sub header">A simple social network login system</div>
				</div>
			</div>
			<div class="ui horizontal divider">pick one</div>
			<div class="two column row">
				<div class="column">
					<div class="login-box centered">
						<a href="twitter.php?go=go" class="ui twitter button">
							<i class="twitter icon"></i>
								Twitter
						</a>
						<div class="subtitle">Login via Twitter</div>
					</div>	
				</div>
				<div class="column">
					<div class="login-box centered">
						<a href="flickr.php?step=1" class="ui flickr button">
							<i class="flickr icon"></i>
								Flickr
						</a>
						<div class="subtitle">Login via Flickr</div>
					</div>	
				</div>
			</div>
			<div class="two column row">
				<div class="column">
					<div class="login-box centered">
						<a href="dropbox.php?go=go" class="ui dropbox button">
							<i class="dropbox icon"></i>
								Dropbox
						</a>
						<div class="subtitle">Login via Dropbox</div>
					</div>	
				</div>
				<div class="column">
					<div class="login-box centered">
						<a href="yahoo.php?go=go" class="ui yahoo button">
							<i class="yahoo icon"></i>
								Yahoo
						</a>
						<div class="subtitle">Login via Yahoo</div>
					</div>	
				</div>
			</div>
			<div class="two column row">
				<div class="column">
					<div class="login-box centered">
						<a href="github.php?go=go" class="ui github button">
							<i class="github icon"></i>
								Github
						</a>
						<div class="subtitle">Login via Github</div>
					</div>	
				</div>
				<div class="column">
					<div class="login-box centered">
						<a href="foursquare.php?go=go" class="ui foursquare button">
							<i class="foursquare icon"></i>
								Foursquare
						</a>
						<div class="subtitle">Login via Foursquare</div>
					</div>	
				</div>
			</div>
		</div>
	</div>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="assets/ui/semantic.js"></script>
	<script type="text/javascript">
		$(document)
		  .ready(function(){
		    $('.demo .example .menu a.item')
		      .on('click', function() {
		        if(!$(this).hasClass('dropdown')) {
		          $(this)
		            .addClass('active')
		            .closest('.ui.menu')
		            .find('.item')
		              .not($(this))
		              .removeClass('active')
		          ;
		        }
		      })
		    ;
		  })
		;
	</script>
</body>
</html>