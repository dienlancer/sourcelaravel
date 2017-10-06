@extends("admin.master")
@section("content")
<?php 
$linkNew			=	route('admin.'.$controller.'.getForm',['add']);
$linkCancel			=	route('admin.'.$controller.'.getList');
$linkLoadData		=	route('admin.'.$controller.'.loadData');
$linkDelete			=	route('admin.'.$controller.'.deleteItem');
$linkTrash			=	route('admin.'.$controller.'.trash');
?>
<form class="form-horizontal" role="form">	
	<div class="portlet light bordered">
		<div class="portlet-title">
			<div class="alert alert-success" id="alert" style="display: none">
				<strong>Success!</strong> 
			</div>
			<div class="caption font-dark">
				<i class="{{$icon}}"></i>
				<span class="caption-subject bold uppercase">{{$title}}</span>
			</div>     
			<div class="actions">
				<div class="table-toolbar">
					<div class="row">
						<div class="col-md-12">						
							<a href="<?php echo $linkNew; ?>" class="btn green">Add new <i class="fa fa-plus"></i></a> 						
							<a href="javascript:void(0)" onclick="trash()" class="btn red">Trash <i class="fa fa-trash"></i></a> 	
							<input type="hidden" name="_token" value="{!! csrf_token() !!}" />    									
						</div>                                                
					</div>
				</div>    
			</div>                                 
		</div>
		<div class="portlet-body">					
			<div class="box-ads">
				<div><center><img src="<?php echo url("/public/admin/images/file-icon.png") ?>" /></center></div>	
				<div class="rowmedia">
					<div class="col-sm-6">
						<center><a href="javascript:void(0)" onclick="deleteItem(56)"><img src="http://demo.dev/sourcelaravel/public/admin/images/delete-icon.png"></a></center>
					</div>
					<div class="col-sm-6"><center><input type="checkbox" name="cid[]" value="huy-quoc.jpg" /></center></div>
					<div class="clr"></div>					
				</div>		
				<div class="title-media"><center>huy-quoc.jpg</center></div>		 					
			</div>
			<div class="box-ads">
				<div><center><img src="<?php echo url("/public/admin/images/file-icon.png") ?>" /></center></div>					 					
			</div>
			<div class="box-ads">
				<div><center><img src="<?php echo url("/public/admin/images/file-icon.png") ?>" /></center></div>					 					
			</div>
			<div class="box-ads">
				<div><center><img src="<?php echo url("/public/admin/images/file-icon.png") ?>" /></center></div>					 					
			</div>			
			<div class="box-ads">
				<div><center><img src="<?php echo url("/public/admin/images/file-icon.png") ?>" /></center></div>					 				
			</div>
			<div class="box-ads">
				<div><center><img src="<?php echo url("/public/admin/images/file-icon.png") ?>" /></center></div>					 				
			</div>
			<div class="clr"></div>
			<div class="box-ads">
				<div><center><img src="<?php echo url("/public/admin/images/file-icon.png") ?>" /></center></div>					 					
			</div>
			<div class="box-ads">
				<div><center><img src="<?php echo url("/public/admin/images/file-icon.png") ?>" /></center></div>					 					
			</div>
			<div class="box-ads">
				<div><center><img src="<?php echo url("/public/admin/images/file-icon.png") ?>" /></center></div>					 					
			</div>
			<div class="box-ads">
				<div><center><img src="<?php echo url("/public/admin/images/file-icon.png") ?>" /></center></div>					 					
			</div>			
			<div class="box-ads">
				<div><center><img src="<?php echo url("/public/admin/images/file-icon.png") ?>" /></center></div>					 				
			</div>
			<div class="box-ads">
				<div><center><img src="<?php echo url("/public/admin/images/file-icon.png") ?>" /></center></div>					 				
			</div>	
			<div class="clr"></div>	
		</div>		
	</div>	
</form>
<script type="text/javascript" language="javascript">		
</script>
@endsection()         

