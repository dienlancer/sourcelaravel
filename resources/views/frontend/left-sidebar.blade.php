<?php   
// đối tác
$data_featured_article=getModuleByPosition('article','featured-article-leftside');      
                    $args = array(                         
                        'menu_class'            => 'categoryarticlemenu', 
                        'menu_id'               => 'category-article-menu',                         
                        'before_wrapper'        => '<div id="module-common-5" class="category-col-left">',
                        'before_title'          => '<h3 class="page-title-left h-title">',
                        'after_title'           => '</h3>',
                        'before_wrapper_ul'     =>  '<div>',
                        'after_wrapper_ul'      =>  '</div>',
                        'after_wrapper'         => '</div>'     ,
                        'link_before'       	=> '<i class="fa fa-angle-double-right" aria-hidden="true"></i>&nbsp;&nbsp;', 
						'link_after'        	=> '',                                                                    
                        'theme_location'        => 'category-article' ,
                        'menu_li_actived'       => 'current-menu-item',
                        'menu_item_has_children'=> 'menu-item-has-children',
                        'alias'                 => $alias
                    );                    
                    wp_nav_menu($args);
                    ?>
                    <div id="module-item-15" class="category-col-left margin-top-15">
                        <h3 class="page-title-left h-title">Bài viết nổi bật</h3>  
                        <?php 
                        for($i=0;$i<count($data_featured_article);$i++){
                            $id=$data_featured_article[$i]['id'];           
                            $permalink=url('/bai-viet/'.$data_featured_article[$i]['alias'].'.html');
                            $featureImg=asset('/resources/upload/'.$data_featured_article[$i]['image']);
                            $fullname=$data_featured_article[$i]['fullname'];
                            $intro=$data_featured_article[$i]['intro'];
                            $content=$data_featured_article[$i]['content'];
                            ?>
                            <div class="product-index">
                                <div class="col-lg-4 no-padding">
                                    <center><figure><a href="<?php echo $permalink; ?>"><img src="<?php echo $featureImg; ?>"></a></figure></center>
                                </div>
                                <div class="col-lg-8 no-padding-right">
                                    <div class="margin-top-15"><a href="<?php echo $permalink; ?>"><?php echo $fullname; ?></a></div>                          
                                </div>
                                <div class="clr"></div>
                            </div>      
                            <?php
                        }
                        ?>
                        <div class="clr"></div>                                         
                    </div>                                            