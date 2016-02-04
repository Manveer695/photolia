<?php
require_once(__DIR__.'/../../includes/helpers.php');
require_once(__DIR__.'/../../loader.php');
Session::checkSession();
$a = new Auth;
if (!$a->isLoggedIn()) {
    redirect_to('login.php');
    exit();
}
$u = User::getUser();
$msg = "";
    if (isset($_POST['addPicture'])) {
        $p = new Pics;
        $p->caption = $_POST['caption'];
        $p->slug = slugify($_POST['caption']);
        $upload = $p->start($_FILES['picture']);
        if ($upload) {
            Logger::start()->add($u->username, $_SERVER['PHP_SELF'], 'File Upload');
            $msg = opmsg("Picture uploaded successfully", "success");
        } else {
            $msg = opmsg($p->errors[0], "failed");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<!--<link rel="icon" href="../../favicon.ico"> -->
<title>Photolia</title>

<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">    
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link rel="stylesheet" href="../css/style.css"
<!-- Custom styles for this template -->
<link href="../css/style.css" rel="stylesheet">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
<h1 class="text-center">Add Picture</h1>
<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Photolia</a>
		</div>
		<div id="navbar" class="collapse navbar-collapse">
		<?php require_once('navbar.php');?>
		</div><!--/.nav-collapse -->
	</div>
</nav>
<div class="container">
	<?=$msg;?>
	<form action="" name="formpic" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label for="pic">Select Picture</label>
			<input type="file" id="pic" name="picture">
			<p class="help-block">Only jpg, png and gif</p>
		</div>
		<input class="form-control" type="text" name="caption" placeholder="Enter the caption">		
		&nbsp;		
		<button type="submit" name="addPicture" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Upload</button>
	</form> 
</div>
<footer class="footer">
<div class="container">
				<p class="text-muted text-center" id="footer_text">Copyright &copy; <?=date('Y'); ?> Shubhamoy</p>
			</div>
		</footer>

		<!-- Bootstrap core JavaScript================================================== -->
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	</body>
</html>
