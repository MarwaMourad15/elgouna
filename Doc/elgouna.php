<?php
if(!file_exists("settings.ini")) {
        printf("No settings file found. Aborting");
        exit ;
    }

    $settings = parse_ini_file("settings.ini");

    if(!array_key_exists("yaml.index",$settings)) {
        printf("{yaml.index} key is not defined in settings. Aborting");
        exit ;
    }
	
    $hotel_yaml = "hotel.yaml";
    $dinings_yaml = "dinings.yaml";
    $night_lifes_yaml = "night-lifes.yaml";
    $things_yaml = "things.yaml";
	$review_yaml = "user-review.yaml";
	$setting_yaml = "user-settings.yaml";

   /* if(!file_exists($index_yaml)) {
        printf("index YAML file {%s} Not Found",$index_yaml);
        exit;
    }*/

    // YAML parser
    include('Spyc.php');
    $brand_name = array_key_exists("brand.name",$settings) ? $settings["brand.name"] : ""  ;
    $api_version = array_key_exists("api.version",$settings) ? $settings["api.version"] : "v1.0"  ;
    $detail_url = "detail.php?token=" ;
    $hotel = Spyc::YAMLLoad($hotel_yaml);
    $dinings = Spyc::YAMLLoad($dinings_yaml);
    $night_lifes = Spyc::YAMLLoad($night_lifes_yaml);
    $things = Spyc::YAMLLoad($things_yaml);
	$review = Spyc::YAMLLoad($review_yaml);
	$setting = Spyc::YAMLLoad($setting_yaml);
?>
<html>
<meta charset="UTF-8">
<title><?php echo $brand_name ?> REST API Documentation</title>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0-wip/css/bootstrap.min.css">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/style2.css">
<body>
	<div class="container">
		<div class="row">
			<div class="col-lg-11">
				<nav class="navbar navbar-top" role="navigation">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex5-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="/"><?php echo $brand_name ?></a>
					</div>


					<ul class="nav navbar-nav">
						<li><a href="index.php">Home</a></li>
					</ul>
				</nav>
			</div>
		</div> <!-- top toolbar  -->

		<div class="row">
			<div class="col-lg-8">
				<ol class="breadcrumb">
					<li><a href="index.php">Home</a></li>
					<li class="active">El-Gouna Rest API</li>
				</ol>
			</div>

		</div> <!--  breadcrumbs  -->

		<div class="row">
			<div class=" col-lg-11">
				<div class="page-header">
					<h1>El-Gouna Rest API</h1>
				</div>

			</div>
		</div>

		<div class="row">
			<div class="col-lg-1">&nbsp;</div>
			<div class="col-lg-8">
				<h3>Hotel</h3>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Resource</th>
                        <th>Description</th>
                    </tr>

                    </thead>

                    <tbody>
                    <?php foreach($hotel as $api ) {
						$token = "#" ;
						if(array_key_exists("file_name",$api)){ $token = base64_encode($api["file_name"]); }
						$api_url = $detail_url.$token ; ?>
                    <tr>
                        <td><a href="<?php echo $api_url?>"><b><?php echo $api["name"] ?> </b></a></td>
                        <td><?php echo $api["description"] ?> </td>
                    </tr>

                    <?php } ?>
                    </tbody>

                </table>
                <br>
                </hr>
                <h3>Setting</h3>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Resource</th>
                        <th>Description</th>
                    </tr>

                    </thead>

                    <tbody>
                    <?php foreach($setting as $api ) {
						$token = "#" ;
						if(array_key_exists("file_name",$api)){ $token = base64_encode($api["file_name"]); }
						$api_url = $detail_url.$token ; ?>
                    <tr>
                        <td><a href="<?php echo $api_url?>"><b><?php echo $api["name"] ?> </b></a></td>
                        <td><?php echo $api["description"] ?> </td>
                    </tr>

                    <?php } ?>
                    </tbody>

                </table>
                <br>
                </hr>


                <h3>Dining</h3>
				<table class="table table-hover">
					<thead>
					<tr>
						<th>Resource</th>
						<th>Description</th>
					</tr>

					</thead>

					<tbody>
					<?php foreach($dinings as $api ) {
						$token = "#" ;
						if(array_key_exists("file_name",$api)){ $token = base64_encode($api["file_name"]); }
						$api_url = $detail_url.$token ; ?>
						<tr>
							<td><a href="<?php echo $api_url?>"><b><?php echo $api["name"] ?> </b></a></td>
							<td><?php echo $api["description"] ?> </td>
						</tr>

					<?php } ?>
					</tbody>

				</table>
<br>
</hr>

                <h3>Night life</h3>
				<table class="table table-hover">
					<thead>
					<tr>
						<th>Resource</th>
						<th>Description</th>
					</tr>

					</thead>

					<tbody>
					<?php foreach($night_lifes as $api ) {
						$token = "#" ;
						if(array_key_exists("file_name",$api)){ $token = base64_encode($api["file_name"]); }
						$api_url = $detail_url.$token ; ?>
						<tr>
							<td><a href="<?php echo $api_url?>"><b><?php echo $api["name"] ?> </b></a></td>
							<td><?php echo $api["description"] ?> </td>
						</tr>

					<?php } ?>
					</tbody>

				</table>
<br>
</hr>
                <h3>Things to do </h3>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Resource</th>
                        <th>Description</th>
                    </tr>

                    </thead>

                    <tbody>
                    <?php foreach($things as $api ) {
                        $token = "#" ;
                        if(array_key_exists("file_name",$api)){ $token = base64_encode($api["file_name"]); }
                        $api_url = $detail_url.$token ; ?>
                        <tr>
                            <td><a href="<?php echo $api_url?>"><b><?php echo $api["name"] ?> </b></a></td>
                            <td><?php echo $api["description"] ?> </td>
                        </tr>

                    <?php } ?>
                    </tbody>

                </table>
                <br>
                </hr>
				<!--<h3>Review</h3>
				<table class="table table-hover">
					<thead>
					<tr>
						<th>Resource</th>
						<th>Description</th>
					</tr>

					</thead>

					<tbody>
					<?php /*foreach($review as $api ) {
						$token = "#" ;
						if(array_key_exists("file_name",$api)){ $token = base64_encode($api["file_name"]); }
						$api_url = $detail_url.$token ; */?>
						<tr>
							<td><a href="<?php /*echo $api_url*/?>"><b><?php /*echo $api["name"] */?> </b></a></td>
							<td><?php /*echo $api["description"] */?> </td>
						</tr>

					<?php /*} */?>
					</tbody>

				</table>-->


			</div>
			<div class="col-lg-2">
				<!-- sidebar --> &nbsp;
			</div>
		</div>
	</div>

	
</body>
</html>