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
      </div>

		<!-- Choose League -->
		<div id="choose-league" class="section row">
	       <div class="col-md-4">
				<img id="liga" src="img/liga-logo.png" alt="La Liga" data-abbreviation="esp.1">
		   </div>
	       <div class="col-md-4">
	       		<img id="premier" src="img/premier-logo.png" alt="Premier League" data-abbreviation="eng.1">
	       </div>
	       <div class="col-md-4">
	       		<img id="pliga" src="img/ligap-logo.png" alt="Liga Portuguesa" data-abbreviation="por.1">
	       </div>
	    </div>	
	
		<!-- Choose Team -->
		<div id="choose-team" class="section">
	       	
	    </div>
	
	
    </div>

	<script src="js/jquery-2.0.3.min.js"></script>
	<script src="js/api.js"></script>

  </body>
</html>
