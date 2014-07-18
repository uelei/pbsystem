<html>
<head>

	<link href="<?php echo site_url(); ?>/../css/bootstrap.css" rel="stylesheet">
	<!-- <link href="<?php echo site_url(); ?>/../css/signin.css" rel="stylesheet"> -->

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>

</head>
<body>
	<div class="container">
		<!-- <form action=​login/​verifica' class=​"form-signin" method=​"post" accept-charset=​"utf-8">​ -->

		<?php echo form_open('login/verifica','class="form-signin"' ); ?>
<div class="row">
 <div class="col-xs-12 col-sm-6 col-md-offset-4 col-sm-offset-4 col-md-4 col-lg-3 col-lg-offset-4">

			<h2 class="form-signin-heading" >LOGIN </h2>
			<h5>Username</h5>
			<input type="text" name="username" class="form-control" value="" />
			<h5>Password</h5>
			<input type="password" name="password" class="form-control" value=""  />
			<div class="row"><center><br>
				<button type="submit" class="btn btn-lg btn-default glyphicon btn-primary glyphicon-log-in" > Submit</button>
			</div>
		</form>
</div>
</div>

	</div>



 <!-- <div class="container">
    <div class="row">
		<div class="span12">
			<form class="form-horizontal" action='' method="POST">
			  <fieldset>
			    <div id="legend">
			      <legend class="">Login</legend>
			    </div>
			    <div class="control-group">
			      
			      <label class="control-label"  for="username">Username</label>
			      <div class="controls">
			        <input type="text" id="username" name="username" placeholder="" class="input-xlarge">
			      </div>
			    </div>
			    <div class="control-group">
			      
			      <label class="control-label" for="password">Password</label>
			      <div class="controls">
			        <input type="password" id="password" name="password" placeholder="" class="input-xlarge">
			      </div>
			    </div>
			    <div class="control-group">
			      
			      <div class="controls">
			        <button class="btn btn-success">Login</button>
			      </div>
			    </div>
			  </fieldset>
			</form>
		</div>
	</div>
</div>
 -->
</body>
</html>


