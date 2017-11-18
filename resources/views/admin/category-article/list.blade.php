@extends("admin.master")
@section("content")
<?php 
$linkNew				=	route('admin.'.$controller.'.getForm',['add']);
$linkCancel				=	route('admin.'.$controller.'.getList');
$linkLoadData			=	route('admin.'.$controller.'.loadData');
$linkChangeStatus		=	route('admin.'.$controller.'.changeStatus');
$linkDelete				=	route('admin.'.$controller.'.deleteItem');
$linkUpdateStatusToShow	=	route('admin.'.$controller.'.updateStatus',[1]);
$linkUpdateStatusToHide =	route('admin.'.$controller.'.updateStatus',[0]);
$linkTrash				=	route('admin.'.$controller.'.trash');
$linkSortOrder			=	route('admin.'.$controller.'.sortOrder');
?>
<form class="form-horizontal" role="form" name="frm" class="frm" action="">
	<input type="hidden" name="filter_page" value="1">     	
	{{ csrf_field() }}    		
	<div class="portlet light bordered">
		<div class="portlet-title">
			<div class="alert alert-success" id="alert" style="display: none">
				<strong>
				<?php 
                   	$message = Session::get("message");
                    echo $message;  
                ?>        
				</strong> 
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
							<a href="javascript:void(0)" onclick="javascript:submitForm('<?php echo $linkUpdateStatusToShow; ?>')" class="btn blue">Show <i class="fa fa-eye"></i></a> 
							<a href="javascript:void(0)" onclick="javascript:submitForm('<?php echo $linkUpdateStatusToHide; ?>')" class="btn yellow">Hide <i class="fa fa-eye-slash"></i></a> 
							<a href="javascript:void(0)" onclick="sort()" class="btn grey-cascade">Sort <i class="fa fa-sort"></i></a> 
							<a href="javascript:void(0)" onclick="trash()" class="btn red">Trash <i class="fa fa-trash"></i></a> 															
						</div>                                                
					</div>
				</div>    
			</div>                                 
		</div>
		<div class="portlet-body">		
			<table class="table table-bordered table-recursive">
				<thead>
					<tr>
						<th width="1%"><input type="checkbox" name="checkall-toggle"></th>           
						<th>Fullname</th>
						<th>Alias</th>		
						<th width="1%">Parent</th>				
						<th width="1%">Image</th>
						<th width="1%">Sort</th>
						<th width="1%">Status</th>							
						<th width="1%">Edit</th>  
						<th width="1%">Delete</th>              
					</tr>
				</thead>
				<tbody> 
				<?php 
					if(count($data) > 0){
						foreach($data as $key => $value){
							$checked=$value['checked'];
							$id=$value['id'];
							$fullname=$value['fullname'];							
							$parent_fullname=$value['parent_fullname'];
							$alias=$value['alias'];
							$image=$value['image'];
							$sort_order=$value['sort_order'];
							$status=$value['status'];
							$edited=$value['edited'];
							$deleted=$value['deleted'];
							?>
							<tr>
								<td><?php echo $checked; ?></td>                
								<td><?php echo $fullname; ?></td>
								<td><?php echo $alias; ?></td>		
								<td><?php echo $parent_fullname; ?></td>				
								<td><?php echo $image; ?></td>
								<td><?php echo $sort_order; ?></td>
								<td><?php echo $status; ?></td>							
								<td><?php echo $edited; ?></td>  
								<td><?php echo $deleted; ?></td>          
							</tr>
							<?php
						}
					}
				?>				                                               
				</tbody>
			</table>			
		</div>
	</div>	
</form>
<script type="text/javascript" language="javascript">
	
</script>
@endsection()         

