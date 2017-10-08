@extends("admin.master")
@section("content")
<?php 

$linkCancel             =   route('admin.'.$controller.'.getList');
$linkSave               =   route('admin.'.$controller.'.save');

$inputCode              =   '<input type="text" class="form-control" name="code"  disabled      id="code"        value="'.@$arrRowData['code'].'">';
$inputUsername          =   '<input type="text" class="form-control" name="username"  disabled      id="username"        value="'.@$arrRowData['username'].'">';
$inputEmail             =   '<input type="text" class="form-control" name="email"      disabled     id="email"           value="'.@$arrRowData['email'].'">';
$inputFullName          =   '<input type="text" class="form-control" name="fullname"        id="fullname"        value="'.@$arrRowData['fullname'].'">';  
$inputAddress           =   '<input type="text" class="form-control" name="address"         id="address"         value="'.@$arrRowData['address'].'">'; 
$inputPhone             =   '<input type="text" class="form-control" name="phone"           id="phone"           value="'.@$arrRowData['phone'].'">';  
$inputMobilephone       =   '<input type="text" class="form-control" name="mobilephone"     id="mobilephone"     value="'.@$arrRowData['mobilephone'].'">';  
$inputFax               =   '<input type="text" class="form-control" name="fax"   id="fax"        value="'.@$arrRowData['fax'].'">';  
$lblQuantity            =   number_format((int)@$arrRowData['quantity'],0,".",",");
$lblTotalPrice          =   number_format((int)@$arrRowData['total_price'],0,".",",");
$status                 =   (count($arrRowData) > 0) ? @$arrRowData['status'] : 1 ;
$arrStatus              =   array(-1 => '- Select status -', 1 => 'Publish', 0 => 'Unpublish');  
$ddlStatus              =   cmsSelectbox("status","status","form-control",$arrStatus,$status,"");
$inputSortOrder         =   '<input type="text" class="form-control" name="sort_order" id="sort_order"     value="'.@$arrRowData['sort_order'].'">';
$id                     =   (count($arrRowData) > 0) ? @$arrRowData['id'] : "" ;
$inputID                =   '<input type="hidden" name="id" id="id" value="'.@$id.'" />'; 
?>
<div class="portlet light bordered">
    <div class="portlet-title">
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
        <form class="form-horizontal" role="form" enctype="multipart/form-data">
            <div class="form-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="col-md-3 control-label"><b>Username</b></label>
                        <div class="col-md-9">
                            <?php echo $inputUsername; ?>
                            <span class="help-block"></span>
                        </div>
                    </div>   
                    <div class="form-group col-md-6">
                        <label class="col-md-3 control-label"><b>Email</b></label>
                        <div class="col-md-9">
                            <?php echo $inputEmail; ?>
                            <span class="help-block"></span>
                        </div>
                    </div>     
                </div>      
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="col-md-3 control-label"><b>Fullname</b></label>
                        <div class="col-md-9">
                            <?php echo $inputFullName; ?>
                            <span class="help-block"></span>
                        </div>
                    </div>   
                    <div class="form-group col-md-6">
                        <label class="col-md-3 control-label"><b>Address</b></label>
                        <div class="col-md-9">
                            <?php echo $inputAddress; ?>
                            <span class="help-block"></span>
                        </div>
                    </div>      
                </div>       
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="col-md-3 control-label"><b>Phone</b></label>
                        <div class="col-md-9">
                            <?php echo $inputPhone; ?>
                            <span class="help-block"></span>
                        </div>
                    </div>   
                    <div class="form-group col-md-6">
                        <label class="col-md-3 control-label"><b>Mobilephone</b></label>
                        <div class="col-md-9">                            
                            <?php echo $inputMobilephone; ?>
                            <span class="help-block"></span>
                        </div>
                    </div>     
                </div> 
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="col-md-3 control-label"><b>Fax</b></label>
                        <div class="col-md-9">
                            <?php echo $inputFax; ?>
                            <span class="help-block"></span>
                        </div>
                    </div>   
                    <div class="form-group col-md-6">
                        <label class="col-md-3 control-label"><b>Status</b></label>
                        <div class="col-md-9">                            
                            <?php echo $ddlStatus; ?>
                            <span class="help-block"></span>
                        </div>
                    </div>     
                </div>       
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="col-md-3 control-label"><b>Sort</b></label>
                        <div class="col-md-9">
                            <?php echo $inputSortOrder; ?>
                            <span class="help-block"></span>
                        </div>
                    </div>   
                    <div class="form-group col-md-6">
                        <label class="col-md-3 control-label"><b>Code</b></label>
                        <div class="col-md-9">
                            <?php echo $inputCode; ?>
                            <span class="help-block"></span>
                        </div>
                    </div>       
                </div>                                                                        
            </div>  
            <div class="form-actions noborder">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}" />                                  
                <?php echo  $inputID; ?>                      
            </div>                  
        </form>
    </div>
</div>
<script type="text/javascript" language="javascript">
    function resetErrorStatus(){
        var id              =   $("#id");        
        var fullname        =   $("#fullname");
        var address         =   $("#address");
        var phone           =   $("#phone");
        var mobilephone     =   $("#mobilephone");
        var fax             =   $("#fax");
        var sort_order      =   $("#sort_order");
        var status          =   $("#status");
                
        $(fullname).closest('.form-group').removeClass("has-error");
        $(address).closest('.form-group').removeClass("has-error");        
        $(phone).closest('.form-group').removeClass("has-error");
        $(mobilephone).closest('.form-group').removeClass("has-error");        
        $(fax).closest('.form-group').removeClass("has-error");        
        $(sort_order).closest('.form-group').removeClass("has-error");        
        $(status).closest('.form-group').removeClass("has-error");        
        
        $(fullname).closest('.form-group').find('span').empty().hide();
        $(address).closest('.form-group').find('span').empty().hide();        
        $(phone).closest('.form-group').find('span').empty().hide();
        $(mobilephone).closest('.form-group').find('span').empty().hide();        
        $(fax).closest('.form-group').find('span').empty().hide();
        $(sort_order).closest('.form-group').find('span').empty().hide();        
        $(status).closest('.form-group').find('span').empty().hide();        
    }

    function save(){
        var id=$("#id").val();                
        var fullname=$("#fullname").val();
        var address=$("#address").val();
        var phone=$("#phone").val();
        var mobilephone=$("#mobilephone").val();
        var fax=$("#fax").val();
        var sort_order=$("#sort_order").val();
        var status=$("#status").val();     
        var token = $('input[name="_token"]').val();   
        resetErrorStatus();
        var dataItem={
            "id":id,        
            "fullname":fullname,
            "address":address,
            "phone":phone,
            "mobilephone":mobilephone,
            "fax":fax,                
            "sort_order":sort_order,
            "status":status,
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
                    if(typeof data_error.address               != "undefined"){
                        $("#address").closest('.form-group').addClass(data_error.address.type_msg);
                        $("#address").closest('.form-group').find('span').text(data_error.address.msg);
                        $("#address").closest('.form-group').find('span').show();                        
                    }         
                    if(typeof data_error.phone               != "undefined"){
                        $("#phone").closest('.form-group').addClass(data_error.phone.type_msg);
                        $("#phone").closest('.form-group').find('span').text(data_error.phone.msg);
                        $("#phone").closest('.form-group').find('span').show();                        
                    }     
                    if(typeof data_error.mobilephone               != "undefined"){
                        $("#mobilephone").closest('.form-group').addClass(data_error.mobilephone.type_msg);
                        $("#mobilephone").closest('.form-group').find('span').text(data_error.mobilephone.msg);
                        $("#mobilephone").closest('.form-group').find('span').show();                        
                    } 
                    if(typeof data_error.fax               != "undefined"){
                        $("#fax").closest('.form-group').addClass(data_error.fax.type_msg);
                        $("#fax").closest('.form-group').find('span').text(data_error.fax.msg);
                        $("#fax").closest('.form-group').find('span').show();                        
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
</script>
@endsection()            