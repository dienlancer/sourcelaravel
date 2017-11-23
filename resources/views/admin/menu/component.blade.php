@extends("admin.master")
@section("content")
<?php 
$linkCategoryArticleComponent                =   route('admin.'.$controller.'.getCategoryArticleComponent',[@$menu_type_id]);
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
                </div>                                                
            </div>
        </div>    
    </div>
</div>
    <div class="portlet-body form">
        <form class="form-horizontal" role="form" enctype="multipart/form-data">
            <div class="form-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <center><a class="btn dark btn-outline sbold uppercase btn-component" href="<?php echo $linkCategoryArticleComponent; ?>">CATEGORY ARTICLE</a></center>
                    </div>   
                    <div class="form-group col-md-6">
                        <center><a class="btn dark btn-outline sbold uppercase btn-component" href="index.php">CATEGORY PRODUCT</a></center>
                    </div>   
                </div> 
                <div class="row">
                    <div class="form-group col-md-6">
                        <center><a class="btn dark btn-outline sbold uppercase btn-component" href="index.php">ARTICLE</a></center> 
                    </div>   
                    <div class="form-group col-md-6">
                        <center><a class="btn dark btn-outline sbold uppercase btn-component" href="index.php">PRODUCT</a></center> 
                    </div>   
                </div>                                                                   
            </div>  
            <div class="form-actions noborder">
                                
            </div>                  
        </form>
    </div>
</div>
@endsection()            