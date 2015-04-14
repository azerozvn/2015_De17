<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login System</title>
	<link rel="stylesheet" href="assets/ui/semantic.css">
	<link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
	<div class="container">
		<div class="ui grid">
			<div class="two column row">
				<div class="column">
					<div class="centered">
						<div class="ui twitter button">
							<i class="twitter icon"></i>
								Twitter
						</div>
					</div>	
				</div>
				<div class="column">
					<div class="centered">
						<div class="ui flickr button">
							<i class="flickr icon"></i>
								Flickr
						</div>
					</div>	
				</div>
			</div>
			<div class="two column row">
				<div class="column">
					<div class="centered">
						<div class="ui dropbox button">
							<i class="dropbox icon"></i>
								Dropbox
						</div>
					</div>	
				</div>
				<div class="column">
					<div class="centered">
						<div class="ui yahoo button">
							<i class="yahoo icon"></i>
								Yahoo
						</div>
					</div>	
				</div>
			</div>
			<div class="two column row">
				<div class="column">
					<div class="centered">
						<div class="ui github button">
							<i class="github icon"></i>
								Github
						</div>
					</div>	
				</div>
				<div class="column">
					<div class="centered">
						<div class="ui foursquare button">
							<i class="foursquare icon"></i>
								Foursquare
						</div>
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