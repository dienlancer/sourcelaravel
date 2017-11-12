<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="<?php echo url('public/admin/css/bootstrap.min.css'); ?>">
	<script type="text/javascript" language="javascript" src="<?php echo url('public/admin/js/bootstrap.min.js'); ?>"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Login</div>
					<div class="panel-body">
						<form class="form-horizontal" role="form" method="POST" action="">
							{{ csrf_field() }}							
							<div class="form-group">
								<label for="username" class="col-md-4 control-label">Username</label>
								<div class="col-md-6">
									<input id="username" type="text" class="form-control" name="username" value="" />	
								</div>
							</div>							
							<div class="form-group">
								<label for="password" class="col-md-4 control-label">Password</label>
								<div class="col-md-6">
									<input id="password" type="password" class="form-control" name="password" required>
								</div>
							</div>							
							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary">
										Login
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>