<?php 
// bản quyền
$data_copyright=getModuleByPosition('article','copyright');   
?>
<footer class="footer padding-top-15">
	<div class="container margin-top-15 box-footer">
		<div class="col-lg-3">
			<?php     
                    $args = array(                         
                        'menu_class'            => 'footermenu', 
                        'menu_id'               => 'support-menu',                         
                        'before_wrapper'        => '<div>',
                        'before_title'          => '<h3 class="footer-title h-title">',
                        'after_title'           => '</h3>',
                        'before_wrapper_ul'     =>  '<div class="margin-top-10">',
                        'after_wrapper_ul'      =>  '</div>',
                        'after_wrapper'         => '</div>'     ,
                        'link_before'           => '', 
                        'link_after'            => '',                                                                    
                        'theme_location'        => 'support' ,
                        'menu_li_actived'       => 'current-menu-item',
                        'menu_item_has_children'=> 'menu-item-has-children',
                        'alias'                 => $alias
                    );                    
                    wp_nav_menu($args);
                    ?>            
		</div>
		<div class="col-lg-3">
			<?php     
                    $args = array(                         
                        'menu_class'            => 'footermenu', 
                        'menu_id'               => 'direction-menu',                         
                        'before_wrapper'        => '<div>',
                        'before_title'          => '<h3 class="footer-title h-title">',
                        'after_title'           => '</h3>',
                        'before_wrapper_ul'     =>  '<div class="margin-top-10">',
                        'after_wrapper_ul'      =>  '</div>',
                        'after_wrapper'         => '</div>'     ,
                        'link_before'           => '', 
                        'link_after'            => '',                                                                    
                        'theme_location'        => 'direction' ,
                        'menu_li_actived'       => 'current-menu-item',
                        'menu_item_has_children'=> 'menu-item-has-children',
                        'alias'                 => $alias
                    );                    
                    wp_nav_menu($args);
                    ?>          
		</div>
		<div class="col-lg-3">
			<?php     
                    $args = array(                         
                        'menu_class'            => 'footermenu', 
                        'menu_id'               => 'policy-menu',                         
                        'before_wrapper'        => '<div>',
                        'before_title'          => '<h3 class="footer-title h-title">',
                        'after_title'           => '</h3>',
                        'before_wrapper_ul'     =>  '<div class="margin-top-10">',
                        'after_wrapper_ul'      =>  '</div>',
                        'after_wrapper'         => '</div>'     ,
                        'link_before'           => '', 
                        'link_after'            => '',                                                                    
                        'theme_location'        => 'policy' ,
                        'menu_li_actived'       => 'current-menu-item',
                        'menu_item_has_children'=> 'menu-item-has-children',
                        'alias'                 => $alias
                    );                    
                    wp_nav_menu($args);
                    ?>          
		</div>
		<div class="col-lg-3">
			<?php     
                    $args = array(                         
                        'menu_class'            => 'footermenu', 
                        'menu_id'               => 'about-us-menu',                         
                        'before_wrapper'        => '<div>',
                        'before_title'          => '<h3 class="footer-title h-title">',
                        'after_title'           => '</h3>',
                        'before_wrapper_ul'     =>  '<div class="margin-top-10">',
                        'after_wrapper_ul'      =>  '</div>',
                        'after_wrapper'         => '</div>'     ,
                        'link_before'           => '', 
                        'link_after'            => '',                                                                    
                        'theme_location'        => 'about-us' ,
                        'menu_li_actived'       => 'current-menu-item',
                        'menu_item_has_children'=> 'menu-item-has-children',
                        'alias'                 => $alias
                    );                    
                    wp_nav_menu($args);
                    ?>          
		</div>
		<div class="clr"></div>
		<div class="container copyright">
			<?php 			
			echo $data_copyright[0]['content'];
			?>			
		</div>
	</div>
</footer>