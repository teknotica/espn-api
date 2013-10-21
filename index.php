<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ESPN API project</title>

    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/grid.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="container">

      <div class="page-header">	
        <h1>Football Hub</h1>
        <p class="lead">The perfect place to find what's happening with your favourite football team.</p>
		<a id="espn-logo" href="http://espn.go.com/" target="_blank" title="ESPN Go website">Built with the ESPN API</a>
      </div>

		<!-- Choose League -->
		<div id="choose-league" class="section row">
			
			<div class="col-md-4 league">
				<img id="champions" src="img/champions-logo.png" alt="Champions League" data-abbreviation="uefa.champions">
		   </div>
			
	       <div class="col-md-4 league">
				<img id="liga" src="img/liga-logo.png" alt="La Liga" data-abbreviation="esp.1">
		   </div>
	       <div class="col-md-4 league">
	       		<img id="premier" src="img/premier-logo.png" alt="Premier League" data-abbreviation="eng.1">
	       </div>
	    </div>	
	
		<img id="loader" class="hide" src="img/loader.gif">
	
		<!-- Choose Team -->
		<div id="choose-team" class="section hide"></div>
	
	
    </div>

	<script src="js/jquery-2.0.3.min.js"></script>
	<script src="js/espn.js"></script>

  </body>
</html>
