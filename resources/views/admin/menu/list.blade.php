@extends("admin.master")
@section("content")
<?php 
$linkNew			=	route('admin.'.$controller.'.getForm',['add',$menu_type_id]);
$linkCancel			=	route('admin.'.$controller.'.getList');
$linkLoadData		=	route('admin.'.$controller.'.loadData');
$linkChangeStatus	=	route('admin.'.$controller.'.changeStatus');
$linkDelete			=	route('admin.'.$controller.'.deleteItem');
$linkUpdateStatus	=	route('admin.'.$controller.'.updateStatus');
$linkTrash			=	route('admin.'.$controller.'.trash');
$linkSortOrder		=	route('admin.'.$controller.'.sortOrder');
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
							<a href="javascript:void(0)" onclick="updateStatus(1)" class="btn blue">Show <i class="fa fa-eye"></i></a> 
							<a href="javascript:void(0)" onclick="updateStatus(0)" class="btn yellow">Hide <i class="fa fa-eye-slash"></i></a> 
							<a href="javascript:void(0)" onclick="sort()" class="btn grey-cascade">Sort <i class="fa fa-sort"></i></a> 
							<a href="javascript:void(0)" onclick="trash()" class="btn red">Trash <i class="fa fa-trash"></i></a> 	
							<input type="hidden" name="_token" value="{!! csrf_token() !!}" />    	
							<input type="hidden" id="menu_type_id" name="menu_type_id" value="{!! $menu_type_id !!}" />    		
							<input type="hidden" name="sort_json" id="sort_json" value="" />	
						</div>                                                
					</div>
				</div>    
			</div>                                 
		</div>
		<div class="portlet-body">		
			<table class="table table-striped table-bordered table-hover table-checkable order-column" id="tbl-menu">
				<thead>
					<tr>
						<th><input type="checkbox" onclick="checkAllAgent(this)"  name="checkall-toggle"></th>                
						<th>Fullname</th>						
						<th>Sort</th>
						<th>Status</th>
						<th>Created at</th>
						<th>Update at</th>     
						<th>Edit</th>  
						<th>Delete</th>                
					</tr>
				</thead>
				<tbody>                                                
				</tbody>
			</table>
		</div>
	</div>	
</form>
<script type="text/javascript" language="javascript">	

	function getList() {  	
		var token = $('input[name="_token"]').val();   
		var menu_type_id=$("#menu_type_id").val();
		var dataItem={            
			'_token': token
			,'menu_type_id':menu_type_id
		};
		$.ajax({
			url: '<?php echo $linkLoadData; ?>',
			type: 'POST', 		     
			data: dataItem,			
			success: function (data, status, jqXHR) {   	
	            var data = $.map(data, function(el) { return el });	            
				basicTable.init();
				vMenuTable.clear().draw();
				vMenuTable.rows.add(data).draw();
				spinner.hide();
			},
			beforeSend  : function(jqXHR,setting){
				spinner.show();
			},
		});
	}	
	function checkWithList(this_checkbox){
		var dr = vMenuTable.row( $(this_checkbox).closest('tr') ).data();       		
		if(parseInt(dr['is_checked']) == 0){
			dr['checked'] ='<input type="checkbox" checked onclick="checkWithList(this)" name="cid" />';
			dr['is_checked'] = 1;
		}else{
			dr['checked'] ='<input type="checkbox" onclick="checkWithList(this)" name="cid" />';
			dr['is_checked'] = 0;
		}
		vMenuTable.row( $(this_checkbox).closest('tr') ).data(dr);
	}	
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
				var list = $.map(data.data, function(el) { return el });		
				showMsg('alert',data.msg,data.type_msg);               		
				vMenuTable.clear().draw();
				vMenuTable.rows.add(list).draw();
				spinner.hide();
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
				var list = $.map(data.data, function(el) { return el });		
				showMsg('alert',data.msg,data.type_msg);               		
				vMenuTable.clear().draw();
				vMenuTable.rows.add(list).draw();
				spinner.hide();
			},
			beforeSend  : function(jqXHR,setting){
				spinner.show();
			},
		});
		$("input[name='checkall-toggle']").prop("checked",false);
	}
	function updateStatus(status){		
		var token 	= 	$('input[name="_token"]').val();   
		var dt 		= 	vMenuTable.data();
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
				var list = $.map(data.data, function(el) { return el });		
				showMsg('alert',data.msg,data.type_msg);               		
				vMenuTable.clear().draw();
				vMenuTable.rows.add(list).draw();
				spinner.hide();
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
		var dt 		= 	vMenuTable.data();
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
				var list = $.map(data.data, function(el) { return el });		
				showMsg('alert',data.msg,data.type_msg);               		
				vMenuTable.clear().draw();
				vMenuTable.rows.add(list).draw();
				spinner.hide();
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
				var list = $.map(data.data, function(el) { return el });		
				showMsg('alert',data.msg,data.type_msg);               		
				vMenuTable.clear().draw();
				vMenuTable.rows.add(list).draw();
				spinner.hide();
			},
			beforeSend  : function(jqXHR,setting){
				spinner.show();
			},
		});
		$("input[name='checkall-toggle']").prop("checked",false);
	}
	function setSortOrder(ctrl){
		var id=$(ctrl).attr("id");
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
				async:0,
				success: function (data, status, jqXHR) {  
					var data = $.map(data, function(el) { return el }); 				                               				
					data_sort = new Array(data.length);
					for(var i=0;i<data_sort.length;i++){					
						var sort_order=parseInt($(data[i]["sort_order"]).val());						
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
	$(document).ready(function(){
		getList();
	});
</script>
@endsection()         

