@extends("admin.master")
@section("content")
<?php 
$linkLoadDataArticle       =   route('admin.article.loadData');
$linkLoadDataProduct       =   route('admin.product.loadData');
$linkCancel             =   route('admin.'.$controller.'.getList');
$linkSave               =   route('admin.'.$controller.'.save');
$linkInsertArticle               =   route('admin.'.$controller.'.insertArticle');
$linkInsertProduct               =   route('admin.'.$controller.'.insertProduct');
$linkSortItems               =   route('admin.'.$controller.'.sortItems');
$inputFullName          =   '<input type="text" class="form-control" name="fullname"   id="fullname"       value="'.@$arrRowData['fullname'].'">'; 
$ddlCategoryArticle     =   cmsSelectboxCategory('category_article_id','category_article_id', 'form-control', $arrCategoryArticleRecursive, 0,"");
$ddlCategoryProduct     =   cmsSelectboxCategory('category_product_id','category_product_id', 'form-control', $arrCategoryProductRecursive, 0,"");
$inputPosition          =   '<input type="text" class="form-control" name="position"   id="position"       value="'.@$arrRowData['position'].'">'; 
$status                 =   (count($arrRowData) > 0) ? @$arrRowData['status'] : 1 ;
$arrStatus              =   array(-1 => '- Select status -', 1 => 'Publish', 0 => 'Unpublish');  
$ddlStatus              =   cmsSelectbox("status","status","form-control",$arrStatus,$status,"");
$inputSortOrder         =   '<input type="text" class="form-control" name="sort_order" id="sort_order"     value="'.@$arrRowData['sort_order'].'">';
$id                     =   (count($arrRowData) > 0) ? @$arrRowData['id'] : "" ;
$inputID                =   '<input type="hidden" name="id" id="id" value="'.@$id.'" />'; 
?>
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="alert alert-success" id="alert" style="display: none">
                <strong>Success!</strong> 
            </div>
        <div class="caption">
            <i class="{{$icon}}"></i>
            <span class="caption-subject font-dark sbold uppercase">{{$title}}</span>
        </div>
        <div class="actions">
           <div class="table-toolbar">
            <div class="row">
                <div class="col-md-12">
                    <button onclick="save()" class="btn purple">Save new <i class="fa fa-floppy-o"></i></button> 
                    <a href="<?php echo $linkCancel; ?>" class="btn green">Cancel <i class="fa fa-ban"></i></a>                    </div>                                                
                </div>
            </div>    
        </div>
    </div>
    <div class="portlet-body form">
        <form class="form-horizontal" role="form" name='frm' enctype="multipart/form-data">
            {{ csrf_field() }}         
            <input type="hidden" name="sort_json" id="sort_json" value="" />   
            <input type="hidden" name="component" id="component" value="" />                              
            <?php echo  $inputID; ?>        
            <div class="form-body">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="col-md-2 control-label"><b>Name</b></label>
                        <div class="col-md-10">
                            <?php echo $inputFullName; ?>
                            <span class="help-block"></span>
                        </div>
                    </div>
                </div>
                <div class="row">   
                    <div class="form-group col-md-12">
                        <label class="col-md-2 control-label"><b>Position</b></label>
                        <div class="col-md-10">
                            <?php echo $inputPosition; ?>
                            <span class="help-block"></span>
                        </div>
                    </div>     
                </div>      
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="col-md-2 control-label"><b>Import data from</b></label>
                        <div class="col-md-10">
                            <button type="button" class="btn dark btn-outline sbold uppercase btn-article" data-toggle="modal" data-target="#modal-article">ARTICLE</button>
                            <button type="button" class="btn dark btn-outline sbold uppercase btn-product" data-toggle="modal" data-target="#modal-product">PRODUCT</button>
                            <span class="help-block"></span>
                        </div>
                    </div>   
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="col-md-2 control-label"><b>List</b></label>
                        <div class="col-md-10 list">
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="tbl-item">
                                <thead>
                                    <tr>
                                        <th width="1%"><input type="checkbox" onclick="checkAllAgent(this)"  name="checkall-toggle"></th>                                        
                                        <th>Fullname</th>   
                                        <th width="1%">Image</th>                                                
                                        <th width="1%">Sort</th>                                                                                
                                        <th width="1%">Delete</th>                
                                    </tr>
                                </thead>
                                <tbody>                                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">  
                    <div class="form-group col-md-12">
                        <label class="col-md-2 control-label"><b>Sort</b></label>
                        <div class="col-md-10">
                            <?php echo $inputSortOrder; ?>
                            <span class="help-block"></span>
                        </div>
                    </div>   
                </div>       
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="col-md-2 control-label"><b>Status</b></label>
                        <div class="col-md-10">                            
                            <?php echo $ddlStatus; ?>
                            <span class="help-block"></span>
                        </div>
                    </div>                       
                </div>                                                              
            </div>                      
        </form>
    </div>
</div>
<div class="modal fade category-modal" id="modal-article" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">  
          <b>ARTICLE LIST      </b>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>        
      </div>
      <div class="modal-body">
        <form name="frm-article">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-4">
                    <div><b>CATEGORY ARTICLE</b>  </div>
                    <div><?php echo $ddlCategoryArticle ; ?></div>
                </div>            
                <div class="col-md-4">
                    <div><b>ARTICLE NAME</b>  </div>
                    <div><input type="text" class="form-control" name="filter_search"          value=""></div>
                </div>            
                <div class="col-md-4">
                    <div>&nbsp;</div>
                    <div>
                        <button type="button" class="btn dark btn-outline sbold uppercase btn-product" onclick="getListArticle();">Search</button>
                        &nbsp;  
                        <button type="button" class="btn dark btn-outline sbold uppercase btn-product" onclick="insertArticle();">Insert</button>                      
                    </div>                
                </div>                
            </div>   
            <div class="row margin-top-15">
                <div class="col-md-12">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="tbl-article-module-item">
                        <thead>
                            <tr>
                                <th width="1%"><input type="checkbox" onclick="checkAllAgentArticle(this)"  name="checkall-toggle"></th>                
                                <th width="1%">ID</th>
                                <th>Fullname</th>
                                <th>Alias</th>
                                <th width="1%">Image</th>                                
                            </tr>
                        </thead>
                        <tbody>                                                
                        </tbody>
                    </table>
                </div>            
            </div>     
        </form>        
    </div>      
</div>
</div>
</div>
<div class="modal fade category-modal" id="modal-product" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">  
          <b>PRODUCT LIST      </b>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>        
      </div>
      <div class="modal-body">
        <form name="frm-product">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-4">
                    <div><b>CATEGORY PRODUCT</b>  </div>
                    <div><?php echo $ddlCategoryProduct ; ?></div>
                </div>            
                <div class="col-md-4">
                    <div><b>PRODUCT NAME</b>  </div>
                    <div><input type="text" class="form-control" name="filter_search"          value=""></div>
                </div>            
                <div class="col-md-4">
                    <div>&nbsp;</div>
                    <div>
                        <button type="button" class="btn dark btn-outline sbold uppercase btn-product" onclick="getListProduct();">Search</button>
                        &nbsp;  
                        <button type="button" class="btn dark btn-outline sbold uppercase btn-article" onclick="insertProduct();">Insert</button>
                    </div>                
                </div>
            </div>   
            <div class="row margin-top-15">
                <div class="col-md-12">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="tbl-product-module-item">
                        <thead>
                            <tr>
                                <th width="1%"><input type="checkbox" onclick="checkAllAgentProduct(this)"  name="checkall-toggle"></th>                
                                <th width="1%">ID</th>
                                <th>Fullname</th>
                                <th>Alias</th>
                                <th width="1%">Image</th>                                
                                
                            </tr>
                        </thead>
                        <tbody>                                                
                        </tbody>
                    </table>
                </div>            
            </div>     
        </form>        
    </div>      
</div>
</div>
</div>
<script type="text/javascript" language="javascript">
    function checkWithList(this_checkbox){
        var dr = vItemTable.row( $(this_checkbox).closest('tr') ).data();               
        if(parseInt(dr['is_checked']) == 0){
            dr['checked'] ='<input type="checkbox" checked onclick="checkWithList(this)" name="cid" />';
            dr['is_checked'] = 1;
        }else{
            dr['checked'] ='<input type="checkbox" onclick="checkWithList(this)" name="cid" />';
            dr['is_checked'] = 0;
        }
        vItemTable.row( $(this_checkbox).closest('tr') ).data(dr);
    }   
    function checkWithListArticle(this_checkbox){
        var dr = vArticleModuleItemTable.row( $(this_checkbox).closest('tr') ).data();            
        if(parseInt(dr['is_checked']) == 0){
            dr['checked'] ='<input type="checkbox" checked onclick="checkWithListArticle(this)" name="cid" />';
            dr['is_checked'] = 1;
        }else{
            dr['checked'] ='<input type="checkbox" onclick="checkWithListArticle(this)" name="cid" />';
            dr['is_checked'] = 0;
        }
        vArticleModuleItemTable.row( $(this_checkbox).closest('tr') ).data(dr);
    }   
    function checkWithListProduct(this_checkbox){
        var dr = vProductModuleItemTable.row( $(this_checkbox).closest('tr') ).data();            
        if(parseInt(dr['is_checked']) == 0){
            dr['checked'] ='<input type="checkbox" checked onclick="checkWithListProduct(this)" name="cid" />';
            dr['is_checked'] = 1;
        }else{
            dr['checked'] ='<input type="checkbox" onclick="checkWithListProduct(this)" name="cid" />';
            dr['is_checked'] = 0;
        }
        vProductModuleItemTable.row( $(this_checkbox).closest('tr') ).data(dr);
    }   
    function getListArticle() {    
        var token = $('form[name="frm-article"] > input[name="_token"]').val(); 
        var category_article_id=$('#category_article_id').val();
        var filter_search=$('form[name="frm-article"] input[name="filter_search"]').val();
        var dataItem={            
            '_token': token,
            'filter_search':filter_search,
            'category_article_id':category_article_id            
        };
        $.ajax({
            url: '<?php echo $linkLoadDataArticle; ?>',
            type: 'POST', 
            data: dataItem,
            success: function (data, status, jqXHR) {                  
                
                vArticleModuleItemTable.clear().draw();
                vArticleModuleItemTable.rows.add(data).draw();
                spinner.hide();
            },
            beforeSend  : function(jqXHR,setting){
                spinner.show();
            },
        });
    }      
    function getListProduct() {    
        var token = $('form[name="frm-product"] > input[name="_token"]').val(); 
        var category_product_id=$('#category_product_id').val();
        var filter_search=$('form[name="frm-product"] input[name="filter_search"]').val();
        var dataItem={            
            '_token': token,
            'filter_search':filter_search,
            'category_product_id':category_product_id        
        };
        $.ajax({
            url: '<?php echo $linkLoadDataProduct; ?>',
            type: 'POST', 
            data: dataItem,
            success: function (data, status, jqXHR) {                                  
                vProductModuleItemTable.clear().draw();
                vProductModuleItemTable.rows.add(data).draw();
                spinner.hide();
            },
            beforeSend  : function(jqXHR,setting){
                spinner.show();
            },
        });
    }     
    function insertArticle(){
        var dt      =   vArticleModuleItemTable.data();        
        var str_id  =   "";     
        for(var i=0;i<dt.length;i++){
            var dr=dt[i];
            if(dr.is_checked==1){
                var id=(dr.id).replace('<center>','');
                id=id.replace('</center>','');
                str_id +=id+",";      
            }
        }
        
        if(str_id == ''){
            alert('Please choose at least one item');    
        }else{
            var token = $('form[name="frm-article"] > input[name="_token"]').val(); 
            var dataItem ={   
                'str_id':str_id,    
                '_token': token
            };      
            $.ajax({
                url: '<?php echo $linkInsertArticle; ?>',
                type: 'POST',                        
                data: dataItem,
                success: function (data, status, jqXHR) { 
                    vItemTable.clear().draw();
                    vItemTable.rows.add(data).draw();
                    spinner.hide();
                    $('#component').val('article');
                    $('#modal-article').modal('hide');                  
                },
                beforeSend  : function(jqXHR,setting){
                    spinner.show();
                },
            });
        }             
    }
    function insertProduct(){
        var dt      =   vProductModuleItemTable.data();        
        var str_id  =   "";     
        for(var i=0;i<dt.length;i++){
            var dr=dt[i];
            if(dr.is_checked==1){
                var id=(dr.id).replace('<center>','');
                id=id.replace('</center>','');
                str_id +=id+",";      
            }
        }        
        if(str_id == ''){
            alert('Please choose at least one item');    
        }else{
            var token = $('form[name="frm-product"] > input[name="_token"]').val(); 
            var dataItem ={   
                'str_id':str_id,    
                '_token': token
            };      
            $.ajax({
                url: '<?php echo $linkInsertProduct; ?>',
                type: 'POST',                        
                data: dataItem,
                success: function (data, status, jqXHR) { 
                    vItemTable.clear().draw();
                    vItemTable.rows.add(data).draw();
                    spinner.hide();
                    $('#component').val('product');
                    $('#modal-product').modal('hide');                  
                },
                beforeSend  : function(jqXHR,setting){
                    spinner.show();
                },
            });
        }             
    }
    function resetErrorStatus(){
        var id                   =   $("#id");
        var fullname             =   $("#fullname");        
        var sort_order           =   $("#sort_order");
        var status               =   $("#status");
        
        $(fullname).closest('.form-group').removeClass("has-error");        
        $(sort_order).closest('.form-group').removeClass("has-error");
        $(status).closest('.form-group').removeClass("has-error");        

        $(fullname).closest('.form-group').find('span').empty().hide();        
        $(sort_order).closest('.form-group').find('span').empty().hide();
        $(status).closest('.form-group').find('span').empty().hide();        
    }   
    function save(){
        var id=$("#id").val();        
        var fullname=$("#fullname").val();
        var item_id=$('#sort_json').val();
        console.log(item_id);
        var menu_id=$("#menu_id").val();
        var position=$("#position").val();          
        var component=$('#component').val();
        var status=$("#status").val();        
        var sort_order=$("#sort_order").val();        
        var token = $('input[name="_token"]').val();   
        resetErrorStatus();
        var dataItem={
            "id":id,
            "fullname":fullname,
            "item_id":item_id,
            "menu_id":menu_id,
            "position":position,    
            "component":component,
            "status":status,        
            "sort_order":sort_order,            
            "_token": token
        };
        $.ajax({
            url: '<?php echo $linkSave; ?>',
            type: 'POST',
            data: dataItem,
            async: false,
            success: function (data) {
                if(data.checked==true){
                    window.location.href = "<?php echo $linkCancel; ?>";
                }else{
                    var data_error=data.error;
                    if(typeof data_error.fullname               != "undefined"){
                        $("#fullname").closest('.form-group').addClass(data_error.fullname.type_msg);
                        $("#fullname").closest('.form-group').find('span').text(data_error.fullname.msg);
                        $("#fullname").closest('.form-group').find('span').show();                        
                    }                    
                    if(typeof data_error.sort_order               != "undefined"){
                        $("#sort_order").closest('.form-group').addClass(data_error.sort_order.type_msg);
                        $("#sort_order").closest('.form-group').find('span').text(data_error.sort_order.msg);
                        $("#sort_order").closest('.form-group').find('span').show();                        
                    }
                    if(typeof data_error.status               != "undefined"){
                        $("#status").closest('.form-group').addClass(data_error.status.type_msg);
                        $("#status").closest('.form-group').find('span').text(data_error.status.msg);
                        $("#status").closest('.form-group').find('span').show();

                    }                    
                }
                spinner.hide();
            },
            error : function (data){
                spinner.hide();
            },
            beforeSend  : function(jqXHR,setting){
                spinner.show();
            },
        });
    }    
    function sort(){
        var tbody=$('div.list > div.dataTables_wrapper > div.table-scrollable > table > tbody');        
        var rows=tbody[0].rows;
        var data=new Array(rows.length);
        for(var i=0;i<rows.length;i++){
            var row=rows[i];
            var cell_sort_order=row.cells[3];
            var input_sort_order=$(cell_sort_order).find('input[name="sort_order"]');
            var id=$(input_sort_order).attr('sort_order_id');
            var sort_order=$(input_sort_order).val();
            var item={
                'id':id,
                'sort_order':sort_order
            };            
            data[i]=item;
        }
        var data_sort=JSON.stringify(data);
        var token = $('form[name="frm"] > input[name="_token"]').val(); 
        var dataItem={
            'data_sort' : data_sort,
            "_token": token
        };
        $.ajax({
            url: '<?php echo $linkSortItems; ?>',
            type: 'POST',                        
            data: dataItem,
            success: function (data, status, jqXHR) { 
                $('form[name="frm"] > input[name="sort_json"]').empty();
                $('form[name="frm"] > input[name="sort_json"]').val(JSON.stringify(data));
                spinner.hide();                
            },
            beforeSend  : function(jqXHR,setting){
                spinner.show();
            },
        });        
    }
    $(document).ready(function(){
        var sort_button='<div class="sort-button"><a href="javascript:void(0)" onclick="sort();" class="btn grey-cascade">Sort <i class="fa fa-sort"></i></a></div>';
        $('div.list > div.dataTables_wrapper > div:first-child > div:nth-child(2)').append(sort_button);
    })
</script>
@endsection()            