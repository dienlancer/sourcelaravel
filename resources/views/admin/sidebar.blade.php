<ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
    <li class="sidebar-toggler-wrapper hide">
        <div class="sidebar-toggler">
            <span></span>
        </div>
    </li>                                          
    <li class="nav-item  ">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-folder-open-o" ></i>
            <span class="title">Content</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">                                    
            <li class="nav-item  ">
                <a href="{!! route('admin.category-article.getList') !!}" class="nav-link nav-toggle">
                    <i class="icon-notebook"></i>
                    <span class="title">Category article</span>                                            
                </a>                                                                      
            </li>
            <li class="nav-item  ">
                <a href="{!! route('admin.article.getList') !!}" class="nav-link nav-toggle">
                    <i class="icon-notebook"></i>
                    <span class="title">Article</span>                                            
                </a>                                                                      
            </li>
        </ul>
    </li>
    <li class="nav-item  ">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-folder-open-o" ></i>
            <span class="title">Product</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">                                    
            <li class="nav-item  ">
                <a href="{!! route('admin.category-product.getList') !!}" class="nav-link nav-toggle">
                    <i class="icon-notebook"></i>
                    <span class="title">Category product</span>                                            
                </a>                                                                      
            </li>
            <li class="nav-item  ">
                <a href="{!! route('admin.product.getList') !!}" class="nav-link nav-toggle">
                    <i class="icon-notebook"></i>
                    <span class="title">Product</span>                                            
                </a>                                                                      
            </li>
        </ul>
    </li>
    <li class="nav-item  ">
                <a href="{!! route('admin.menu-type.getList') !!}" class="nav-link nav-toggle">
                    <i class="icon-notebook"></i>
                    <span class="title">Menu</span>                                            
                </a>                                                                      
    </li> 
    <li class="nav-item  ">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-folder-open-o" ></i>
            <span class="title">Module</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">                                    
            <li class="nav-item  ">
                <a href="{!! route('admin.module-menu.getList') !!}" class="nav-link nav-toggle">
                    <i class="icon-notebook"></i>
                    <span class="title">Module menu</span>                                            
                </a>                                                                      
            </li>
            <li class="nav-item  ">
                <a href="{!! route('admin.module-article.getList') !!}" class="nav-link nav-toggle">
                    <i class="icon-notebook"></i>
                    <span class="title">Module article</span>                                            
                </a>                                                                      
            </li>
        </ul>
    </li>                                                   
</ul>