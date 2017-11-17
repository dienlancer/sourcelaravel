@extends("admin.master")
@section("content")
<?php 
$linkNew			=	route('admin.'.$controller.'.getForm',['add']);
$linkCancel			=	route('admin.'.$controller.'.getList');
$linkLoadData		=	route('admin.'.$controller.'.loadData');
$linkChangeStatus	=	route('admin.'.$controller.'.changeStatus');
$linkDelete			=	route('admin.'.$controller.'.deleteItem');
$linkUpdateStatus	=	route('admin.'.$controller.'.updateStatus');
$linkTrash			=	route('admin.'.$controller.'.trash');
$linkSortOrder		=	route('admin.'.$controller.'.sortOrder');
?>
<form class="form-horizontal" role="form" name="frm" class="frm">
	<input type="hidden" name="filter_page" value="1">         
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
							<a href="javascript:void(0)" onclick="updateStatus(1)" class="btn blue">Show <i class="fa fa-eye"></i></a> 
							<a href="javascript:void(0)" onclick="updateStatus(0)" class="btn yellow">Hide <i class="fa fa-eye-slash"></i></a> 
							<a href="javascript:void(0)" onclick="sort()" class="btn grey-cascade">Sort <i class="fa fa-sort"></i></a> 
							<a href="javascript:void(0)" onclick="trash()" class="btn red">Trash <i class="fa fa-trash"></i></a> 	
							{{ csrf_field() }}    		
							<input type="hidden" name="sort_json" id="sort_json" value="" />	
						</div>                                                
					</div>
				</div>    
			</div>                                 
		</div>
		<div class="portlet-body">		
			<table class="table table-bordered">
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
	function changeStatus(id,status){		
		var token = $('input[name="_token"]').val();   
		var dataItem={   
			'id':id,
			'status':status,         
			'_token': token
		};
		$.ajax({
			url: '<?php echo $linkChangeStatus; ?>',
			type: 'POST', 
			             
			data: dataItem,
			success: function (data, status, jqXHR) {   							                              		
				
			},
			beforeSend  : function(jqXHR,setting){
				spinner.show();
			},
		});		
		$("input[name='checkall-toggle']").prop("checked",false);
	}
	
	function deleteItem(id){		
		var xac_nhan = 0;
		var msg="Do you really want to delete this item ?";
		if(window.confirm(msg)){ 
			xac_nhan = 1;
		}
		if(xac_nhan  == 0)
			return 0;
		var token 	 = $('input[name="_token"]').val();   
		var dataItem ={   
			'id':id,			
			'_token': token
		};
		$.ajax({
			url: '<?php echo $linkDelete; ?>',
			type: 'POST', 
			             
			data: dataItem,
			success: function (data, status, jqXHR) {  
				
			},
			beforeSend  : function(jqXHR,setting){
				spinner.show();
			},
		});
		$("input[name='checkall-toggle']").prop("checked",false);
	}
	function updateStatus(status){		
		var token 	= 	$('input[name="_token"]').val();   
		var dt 		= 	vCategoryArticleTable.data();
		var str_id	=	"";		
		for(var i=0;i<dt.length;i++){
			var dr=dt[i];
			if(dr.is_checked==1){
				str_id +=dr.id+",";	            
			}
		}
		var dataItem ={   
			'str_id':str_id,
			'status':status,			
			'_token': token
		};
		$.ajax({
			url: '<?php echo $linkUpdateStatus; ?>',
			type: 'POST', 
			             
			data: dataItem,
			success: function (data, status, jqXHR) {   							                              				
				
			},
			beforeSend  : function(jqXHR,setting){
				spinner.show();
			},
		});
		$("input[name='checkall-toggle']").prop("checked",false);		
	}
	function trash(){	
		var xac_nhan = 0;
		var msg="Do you really want to delete this item ?";
		if(window.confirm(msg)){ 
			xac_nhan = 1;
		}
		if(xac_nhan  == 0)
			return 0;	
		var token 	= 	$('input[name="_token"]').val();   
		var dt 		= 	vCategoryArticleTable.data();
		var str_id	=	"";		
		for(var i=0;i<dt.length;i++){
			var dr=dt[i];
			if(dr.is_checked==1){
				str_id +=dr.id+",";	            
			}
		}
		var dataItem ={   
			'str_id':str_id,				
			'_token': token
		};
		$.ajax({
			url: '<?php echo $linkTrash; ?>',
			type: 'POST', 
			             
			data: dataItem,
			success: function (data, status, jqXHR) {
				
			},
			beforeSend  : function(jqXHR,setting){
				spinner.show();
			},
		});
		$("input[name='checkall-toggle']").prop("checked",false);
	}
	function sort(){			
		var token 	= 	$('input[name="_token"]').val();   
		var sort_json=$("#sort_json").val();
		var dataItem ={   
			sort_json:sort_json,		
			'_token': token
		};        
		$.ajax({
			url: '<?php echo $linkSortOrder; ?>',
			type: 'POST', 
			             
			data: dataItem,
			success: function (data, status, jqXHR) {   	
				
			},
			beforeSend  : function(jqXHR,setting){
				spinner.show();
			},
		});
		$("input[name='checkall-toggle']").prop("checked",false);
	}
	function setSortOrder(ctrl){
		var id=$(ctrl).attr("sort_order_id");
		var giatri=$(ctrl).val();		
		var sort_json=$("#sort_json").val();
		var data_sort=null;
		if(sort_json != ''){
			data_sort=$.parseJSON(sort_json);	
		}		
		if(data_sort == null){
			var token = $('input[name="_token"]').val();   
			var dataItem={            
				'_token': token
			};
			$.ajax({
				url: '<?php echo $linkLoadData; ?>',
				type: 'POST', 
				             
				data: dataItem,
				async:false,
				success: function (data, status, jqXHR) {  
					var data = $.map(data, function(el) { return el }); 				                               						
					data_sort = new Array(data.length);
					for(var i=0;i<data_sort.length;i++){							
						var sort_order_input=	$(data[i]["sort_order"]).find("input[name='sort_order']");
						var sort_order=parseInt($(sort_order_input).val());												
						var obj={"id":parseInt(data[i]["id"]),"sort_order":sort_order};						
						data_sort[i]=obj;
					}					
				},
				beforeSend  : function(jqXHR,setting){
					
				},
			});
		}					
		var data=new Array(data_sort.length);	
		for(var i=0;i<data_sort.length;i++){								
			var sort_order=parseInt(data_sort[i].sort_order);
			if(parseInt(id)==parseInt(data_sort[i].id)){
				sort_order=parseInt(giatri);
			}
			var obj={"id":data_sort[i].id,"sort_order":sort_order};
			data[i]=obj;
		}				
		$("#sort_json").val(JSON.stringify(data));
	}
	
</script>
@endsection()         

