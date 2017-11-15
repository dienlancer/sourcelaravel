@extends("frontend.master")
@section("content")
<?php 
$data_setting_system=getSettingSystem(); 
$contacted_phone=$data_setting_system['contacted_phone'];
$email_to=$data_setting_system['email_to'];
$address=$data_setting_system['address'];
$to_name=$data_setting_system['to_name'];
$telephone=$data_setting_system['telephone'];
$website=$data_setting_system['website'];
$slogan_about=$data_setting_system['slogan_about'];
$opened_time=$data_setting_system['opened_time'];
$opened_date=$data_setting_system['opened_date'];
$contaced_name=$data_setting_system['contacted_name'];
$facebook_url=$data_setting_system['facebook_url'];
$twitter_url=$data_setting_system['twitter_url'];
$google_plus=$data_setting_system['google_plus'];
$youtube_url=$data_setting_system['youtube_url'];
$instagram_url=$data_setting_system['instagram_url'];
$pinterest_url=$data_setting_system['pinterest_url'];  
$map_url=$data_setting_system['map_url'];     
?>
<div class="container margin-top-15 margin-bottom-15 page-right">
	<h3 class="page-title h-title">Liên hệ</h3>
	<div class="padding-left-15 padding-right-15">
		<div class="margin-top-15">
			<div class="col-md-4 contact no-padding">
				<form method="post" name="frm" enctype="multipart/form-data">							
					{{ csrf_field() }}      
					<div class="margin-top-5"><input type="input" class="form-control" name="fullname" placeholder="Họ và tên"></div>
					<div class="margin-top-5"><input type="input" class="form-control" name="email" placeholder="Email"></div>
					<div class="margin-top-5"><input type="input" class="form-control" name="phone" placeholder="Điện thoại"></div>
					<div class="margin-top-5"><input type="input" class="form-control" name="title" placeholder="Chủ đề"></div>
					<div class="margin-top-5"><input type="input" class="form-control" name="address" placeholder="Địa chỉ"></div>
					<div class="margin-top-5"><textarea name="content" class="form-control" placeholder="Nội dung"></textarea></div>
					<div class="margin-top-5">
						<input type="submit" name="btnSend" class="btn btn-default" value="Gửi">					  
					</div>				
				</form>
			</div>
			<div class="col-md-8 contact-info no-padding-right">
				<div class="company-name"><?php echo $to_name; ?></div>
				<div class="contact-info-child"><?php echo $address; ?></div>
				<div class="contact-info-child">Website: <?php echo $website; ?></div>
				<div class="contact-info-child">E-mail: <?php echo $email_to; ?></div>
				<div class="contact-info-child">Tel: <font color="#D41010"><?php echo $telephone; ?></font></div>
			</div>
			<div class="clr"></div>
		</div>
		<div class="margin-top-15">
					<iframe src="<?php echo $map_url; ?>" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>	
	</div>
</div>
@endsection()               