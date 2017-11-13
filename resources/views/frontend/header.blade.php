<?php 
use App\SettingSystemModel;
use App\MenuModel;
use App\MenuTypeModel;
$alias_setting_system='setting-system';
$data_setting_system=SettingSystemModel::whereRaw("trim(lower(alias)) = ?",[trim(mb_strtolower($alias_setting_system))])->get()->toArray()[0];

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

$ssName="vmuser";
$arrUser=array();            
if(Session::has($ssName)){
  $arrUser=Session::get($ssName)["userInfo"];      
}         
$account_link=route("frontend.index.viewAccount");  
$logout_link=route("frontend.index.getLgout"); 
$security_link=route("frontend.index.viewSecurity"); 
$invoice_link=route("frontend.index.getInvoice");
$register_member_link=route("frontend.index.register");

$alias_menu_type='main-menu';
$data_menu_type=MenuTypeModel::whereRaw("trim(lower(alias)) = ?",[trim(mb_strtolower($alias_menu_type))])->select('id')->get()->toArray()[0];
$data_menu=MenuModel::whereRaw('menu_type_id = ?',[(int)@$data_menu_type['id']])->get()->toArray();
$arr_menu=array();  
if(count($data_menu) > 0){
  for ($i=0;$i<count($data_menu);$i++) {
    $menu=array();
    $menu=$data_menu[$i];
    $site_link='';
    if(!empty( $data_menu[$i]["site_link"] )){
      $site_link=$data_menu[$i]["site_link"].".html";
    }
    $menu["site_link"] =$site_link;            
    $data_child=MenuModel::whereRaw('parent_id = ?',[(int)$data_menu[$i]["id"]])->select('id')->get()->toArray();
    if(count($data_child) > 0){
      $menu["havechild"]=1;
    }else{
      $menu["havechild"]=0;
    }
    $arr_menu[]=$menu;
  }
}

$lanDau=0;
$newString="";      
$menu_class        = 'mainmenu'; 
$menu_id           = 'main-menu';
$theme_location    = $alias_menu_type ;
mooMenuRecursive($arr_menu, 0, $newString,$lanDau,url("/"),$alias,$menu_id,$menu_class);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">  
  <title><?php echo $slogan_about; ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="keywords" content="<?php echo @$meta_keyword; ?>" />
  <meta name="description" content="<?php echo @$meta_description; ?>"/>
  <script src="{{ asset('public/frontend/js/jquery-3.2.1.js') }}"></script>
  <script src="{{ asset('public/frontend/js/bootstrap.js') }}"></script>
  <script src="{{ asset('public/frontend/js/ddsmoothmenu.js') }}"></script>
  <script src="{{ asset('public/frontend/js/jquery.fancybox.js') }}"></script>
  <script src="{{ asset('public/frontend/js/jquery.fancybox-buttons.js') }}"></script>
  <script src="{{ asset('public/frontend/js/jquery.fancybox-thumbs.js') }}"></script>
  <script src="{{ asset('public/frontend/js/jquery.fancybox-media.js') }}"></script>
  <script src="{{ asset('public/frontend/nivo-slider/jquery.nivo.slider.js') }}"></script>
  <script src="{{ asset('public/frontend/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('public/frontend/js/jquery.simplyscroll.min.js') }}"></script>
  <script src="{{ asset('public/frontend/js/jquery.bxslider.min.js') }}"></script>
  <script src="{{ asset('public/frontend/js/jquery.elevatezoom-3.0.8.min.js') }}"></script>
  <script src="{{ asset('public/frontend/js/custom.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('public/frontend/css/font-awesome.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/frontend/css/bootstrap.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/frontend/css/ddsmoothmenu.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/frontend/css/jquery.fancybox.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/frontend/css/jquery.fancybox-buttons.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/frontend/css/jquery.fancybox-thumbs.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/frontend/css/hover.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/frontend/css/pagination.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/frontend/css/jquerysctipttop.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/frontend/nivo-slider/themes/default/default.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/frontend/nivo-slider/themes/light/light.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/frontend/nivo-slider/themes/dark/dark.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/frontend/nivo-slider/themes/bar/bar.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/frontend/nivo-slider/nivo-slider.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/frontend/css/owl.carousel.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/frontend/css/jquery.simplyscroll.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/frontend/css/jquery.bxslider.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/frontend/css/dropdownmenu.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/frontend/css/tab.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/frontend/css/menu-horizontal-right.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/frontend/css/template.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/frontend/css/custom.css') }}" />
</head>
<body>
  <header>
    <div class="top-header">
      <div class="container">
        <div class="col-lg-2 no-padding"><font color="#ffffff">Tư vấn 24/7:</font>&nbsp;<font color="#bbb"><?php echo $contacted_phone; ?></font></div>
        <div class="col-lg-6 no-padding"><font color="#ffffff">Địa chỉ:</font>&nbsp;<font color="#bbb"><?php echo $address; ?></font></div>
        <div class="col-lg-4 no-padding">
          <div class="col-lg-9 no-padding">
            <ul class="top-user">
              <?php                                                              
              if( count($arrUser) == 0 ){
                ?>
                <li><a href="<?php echo $register_member_link; ?>" class="header-action-item"><i class="fa fa-unlock" aria-hidden="true"></i>&nbsp;Đăng ký</a></li>
                <li><a href="<?php echo $account_link; ?>" class="header-action-item"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;Đăng nhập</a></li>
                <?php
              }else{                                     
                ?>
                <li><a class="header-action-item" href="<?php echo $account_link; ?>"><?php echo $arrUser["username"]; ?></a></li>
                <li><a class="header-action-item" href="<?php echo $security_link; ?>">Đổi mật khẩu</a></li>                                
                <li><a class="header-action-item" href="<?php echo $invoice_link; ?>">Invoice</a></li>
                <li><a class="header-action-item" href="<?php echo $logout_link; ?>">Logout</a></li>
                <?php                                     
              }
              ?>       
            </ul> 
          </div>                    
          <div class="col-lg-3 no-padding">
            <div class="mini-cart dropdown box-cart cart hidden-xs">
              <a href="#" >
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;Giỏ hàng
                <span class="cart-total"></span>
              </a>                            
            </div>
          </div>
          <div class="clr"></div>             
        </div>       
      </div>
    </div>
    <div class="bg-header">
    <div class="container">        
        <div class="menu">
            <div class="col-lg-3 no-padding">                
                <center><a href="<?php echo url('/'); ?>">                
                    <img src="<?php echo asset('resources/upload/logo-megashop.png');?>" />
                </a></center>
            </div>
            <div class="col-lg-6 no-padding">                
                <div id="smoothmainmenu" class="ddsmoothmenu">
                    <?php     
                    $args = array( 
                        'menu'              => '', 
                        'container'         => '', 
                        'container_class'   => '', 
                        'container_id'      => '', 
                        'menu_class'        => 'mainmenu', 
                        'menu_id'           => 'main-menu', 
                        'echo'              => true, 
                        'fallback_cb'       => 'wp_page_menu', 
                        'before'            => '', 
                        'after'             => '', 
                        'link_before'       => '', 
                        'link_after'        => '', 
                        'items_wrap'        => '<ul id="%1$s" class="%2$s">%3$s</ul>',  
                        'depth'             => 3, 
                        'walker'            => '', 
                        'theme_location'    => 'main-menu' 
                    );
                    //wp_nav_menu($args);
                    ?>                
                </div>                
            </div>
            <div class="col-lg-3 no-padding">
                <div class="desktop-box-search">                    
                    <div class="box-search">
                        <form action="#" method="get">
                            <input type="text" name="q" autocomplete="off" placeholder="Tìm kiếm sản phẩm" value="">
                            <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </form>
                        <div class="clr"></div>
                    </div>
                    <div class="clr"></div>
                </div>       
            </div>      
            <div class="clr"></div>      
        </div>      
    </div>    
</div>   
  </header>