<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="<?php echo url('public/admin/css/bootstrap.min.css'); ?>">
	<script type="text/javascript" language="javascript" src="<?php echo url('public/admin/js/bootstrap.min.js'); ?>"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Register</div>
					<div class="panel-body">
						<form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
							{{ csrf_field() }}
							<div class="form-group">
								<label for="email" class="col-md-4 control-label">E-Mail Address</label>
								<div class="col-md-6">
									<input id="email" type="email" class="form-control" name="email" value="" />	
								</div>
							</div>
							<div class="form-group">
								<label for="first_name" class="col-md-4 control-label">Firstname</label>
								<div class="col-md-6">
									<input id="first_name" type="text" class="form-control" name="first_name" value="" />	
								</div>
							</div>
							<div class="form-group">
								<label for="last_name" class="col-md-4 control-label">Lastname</label>
								<div class="col-md-6">
									<input id="last_name" type="text" class="form-control" name="last_name" value="" />	
								</div>
							</div>
							<div class="form-group">
								<label for="location" class="col-md-4 control-label">Location</label>
								<div class="col-md-6">
									<input id="location" type="text" class="form-control" name="location" value="" />	
								</div>
							</div>
							<div class="form-group">
								<label for="password" class="col-md-4 control-label">Password</label>
								<div class="col-md-6">
									<input id="password" type="password" class="form-control" name="password" required>
								</div>
							</div>
							<div class="form-group">
								<label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
								<div class="col-md-6">
									<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary">
										Register
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