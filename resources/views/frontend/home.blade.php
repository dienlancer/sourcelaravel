@extends("frontend.master")
@section("content")
<div class="container">
	<div id="wrapper">
			<div class="slider-wrapper theme-default">
				<div id="slider" class="nivoSlider"> 
					<?php 
					for($i=0 ; $i < count($data_banner) ; $i++ ){
						$banner=asset('resources/upload/'.$data_banner[$i]['image']);
						?>
						<img src="<?php echo $banner; ?>" data-thumb="<?php echo $banner; ?>" alt="" />     
						<?php
					} 
					?>

				</div>				
			</div>
		</div>
		<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery('#slider').nivoSlider();
			});    
		</script>	
</div>
<div class="hotline-bg">
	<div class="container">
		<div class="re-ship-phone">
			<div class="col-lg-3 no-padding">
				<div class="item">
					<span class="icon icon1">
					</span>
					<p class="des">
						<span>Tư vấn 24/7</span> Miễn phí
					</p>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="item">
					<span class="icon icon2">

					</span>
					<p class="des">
						Vận chuyển <span>miễn phí</span>
					</p>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="item">
					<span class="icon icon3">

					</span>
					<p class="des">
						Nhận hàng <span>Nhận tiền</span>
					</p>
				</div>
			</div>
			<div class="col-lg-3 no-padding">
				<div class="item">
					<span class="icon icon4">

					</span>
					<p class="des">
						Gọi ngay <span>096.302.7720</span>
					</p>
				</div>
			</div>
			<div class="clr"></div>
		</div>        
	</div>
	<div class="container thiet-bi-ve-sinh-cao-cap-banner">
		<div class="col-lg-8 no-padding"><img src="<?php echo asset('resources/upload/t5.jpg'); ?>"></div>
		<div class="col-lg-4 no-padding-right"><img src="<?php echo asset('resources/upload/t6.jpg'); ?>"></div>
	</div>
</div>
<div class="container main">
	<div class="header-title">
		<h4><span><font color="#3AB54A">Danh mục</font></span> sản phẩm</h4>               
	</div>
	<div class="margin-top-15 product-kemma">
		<div>
			<div class="cate-product-horizontal-right">
				<?php     
				$args = array(                         
					'menu_class'            => 'cateprodhorizontalright', 
					'menu_id'               => 'cate-prod-horizontal-right',                         
					'before'                => '', 
					'after'                 => '', 
					'link_before'       	=> '<i class="fa fa-angle-double-right" aria-hidden="true"></i>&nbsp;&nbsp;', 
					'link_after'        	=> '<i class="fa fa-caret-down pull-right" aria-hidden="true"></i>',                                                        
					'theme_location'        => 'category-product-home' ,
					'menu_li_actived'       => 'current-menu-item',
					'menu_item_has_children'=> 'menu-item-has-children',
					'alias'                 => $alias
				);                    
				wp_nav_menu($args);
				?>                 
				<div class="clr"></div>
			</div>
			<div class="margin-top-15"><center><img src="<?php echo asset('/resources/upload/noi-that-sang-trong.jpg'); ?>"></center></div>
		</div>
		<div>
			<div class="product-sale-shop">
				<?php
				if(count($data_featured_product) > 0){
					$k=1;				
					$post_count=count($data_featured_product);							
					for($i=0;$i<count($data_featured_product);$i++){							
						$id=$data_featured_product[$i]['id'];			
						$permalink=url('/san-pham/'.$data_featured_product[$i]['alias'].'.html');
						$featureImg=asset('/resources/upload/'.$data_featured_product[$i]['image']);
						$fullname=$data_featured_product[$i]['fullname'];	
						$price=$data_featured_product[$i]['price'];
						$sale_price=$data_featured_product[$i]['sale_price'];
						$str_price='';
						$sale_price_des='';
						$regular_price='';
						if(!empty($price)){						
							$sale_price_des=fnPrice($price);								
						}
						if(!empty($sale_price)){				
							$regular_price ='<span class="price-regular">'.fnPrice($price).' đ</span>';										
							$sale_price_des=fnPrice($sale_price);						
						}
						$sale_price_des='<span class="price-sale">'.$sale_price_des. ' đ'.'</span>' ;					
						$str_price=$regular_price . '&nbsp;&nbsp;' . $sale_price_des ;				
						?>
						<div class="col-lg-3 no-padding-right">
							<div class="box-product">
								<div class="product-img"><center><figure><a href="<?php echo $permalink; ?>"><img src="<?php echo $featureImg; ?>" alt="" /></a></figure></center>
									<div class="box-product-add-to-cart">
										<div class="them-vao-gio-hang">
											<a href="javascript:void(0)" data-toggle="modal" data-target="#modal-alert-add-cart" onclick="addToCart(<?php echo $id; ?>);" ><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;Thêm vào giỏ</a>									
										</div>
									</div>								
								</div>								
								<div class="box-product-title"><a href="<?php echo $permalink; ?>"><?php echo $fullname; ?></a></div>
								<div class="box-product-star">								
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>								
								</div>
								<div class="box-product-general-price margin-top-5">
									<center><?php echo $str_price; ?></center>								                    
								</div>							                     
							</div>           
						</div>		
						<?php
						if($k%4 ==0 || $k==$post_count){
							echo '<div class="clr"></div>';
						}
						$k++;
					}
				}				
				?>
			</div>
		</div>
		<div class="clr"></div>
	</div>
	<div class="header-title">
		<h4><span><font color="#3AB54A">Thiết bị</font></span> vệ sinh</h4>                          
	</div>
	<div class="margin-top-15">
		<script type="text/javascript" language="javascript">
			jQuery(document).ready(function(){
				jQuery(".owl-carousel-toilet-equipment").owlCarousel({
					autoplay:false,                    
					loop:true,
					margin:10,                        
					nav:true,                                            
					responsiveClass:true,
					responsive:{
						0:{
							items:1,
							nav:true
						},
						600:{
							items:1,
							nav:false
						},
						1000:{
							items:4,
							nav:true,
							loop:false
						}
					}
				})
			});                
		</script>
		<div class="owl-carousel owl-carousel-toilet-equipment owl-theme">
			<?php
			if(count($data_toilet_equipment) > 0){
				$k=1;
				$post_count=count($data_toilet_equipment);				 
				for($i=0;$i<count($data_toilet_equipment);$i++){
					$id=$data_toilet_equipment[$i]['id'];			
					$permalink=url('/san-pham/'.$data_toilet_equipment[$i]['alias'].'.html');
					$featureImg=asset('/resources/upload/'.$data_toilet_equipment[$i]['image']);
					$fullname=$data_toilet_equipment[$i]['fullname'];	
					$price=$data_toilet_equipment[$i]['price'];
					$sale_price=$data_toilet_equipment[$i]['sale_price'];
					$str_price='';
					$sale_price_des='';
					$regular_price='';
					if(!empty($price)){						
						$sale_price_des=fnPrice($price);								
					}
					if(!empty($sale_price)){				
						$regular_price ='<span class="price-regular">'.fnPrice($price).' đ</span>';										
						$sale_price_des=fnPrice($sale_price);						
					}
					$sale_price_des='<span class="price-sale">'.$sale_price_des. ' đ'.'</span>' ;					
					$str_price=$regular_price . '&nbsp;&nbsp;' . $sale_price_des ;				
					?>
					<div>
						<div class="box-product">
							<div class="product-img"><center><figure><a href="<?php echo $permalink; ?>"><img src="<?php echo $featureImg; ?>" alt="" /></a></figure></center>
								<div class="box-product-add-to-cart">
									<div class="them-vao-gio-hang">
										<a href="javascript:void(0)" data-toggle="modal" data-target="#modal-alert-add-cart" onclick="addToCart(<?php echo $id; ?>);" ><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;Thêm vào giỏ</a>									
									</div>
								</div>								
							</div>									
							<div class="box-product-title"><a href="<?php echo $permalink; ?>"><?php echo $fullname; ?></a></div>
							<div class="box-product-star">								
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star" aria-hidden="true"></i>								
							</div>
							<div class="box-product-general-price margin-top-5">
								<center><?php echo $str_price; ?></center>								                    
							</div>							                     
						</div>           
					</div>				
					<?php
				}
			}		
			?>		
		</div>
	</div>	
	<div class="header-title">
            <h4><span><font color="#3AB54A">Thiết bị</font></span> bếp</h4>                          
    </div>
    <div class="margin-top-15">
    	<script type="text/javascript" language="javascript">
    		jQuery(document).ready(function(){
    			jQuery(".owl-carousel-chicken-equipment").owlCarousel({
    				autoplay:false,                    
    				loop:true,
    				margin:10,                        
    				nav:true,                                            
    				responsiveClass:true,
    				responsive:{
    					0:{
    						items:1,
    						nav:true
    					},
    					600:{
    						items:1,
    						nav:false
    					},
    					1000:{
    						items:4,
    						nav:true,
    						loop:false
    					}
    				}
    			})
    		});                
    	</script>
    	<div class="owl-carousel owl-carousel-chicken-equipment owl-theme">
    		<?php
			if(count($data_chicken_equipment) > 0){
				$k=1;
				$post_count=count($data_chicken_equipment);				 
				for($i=0;$i<count($data_chicken_equipment);$i++){
					$id=$data_chicken_equipment[$i]['id'];			
					$permalink=url('/san-pham/'.$data_chicken_equipment[$i]['alias'].'.html');
					$featureImg=asset('/resources/upload/'.$data_chicken_equipment[$i]['image']);
					$fullname=$data_chicken_equipment[$i]['fullname'];	
					$price=$data_chicken_equipment[$i]['price'];
					$sale_price=$data_chicken_equipment[$i]['sale_price'];
					$str_price='';
					$sale_price_des='';
					$regular_price='';
					if(!empty($price)){						
						$sale_price_des=fnPrice($price);								
					}
					if(!empty($sale_price)){				
						$regular_price ='<span class="price-regular">'.fnPrice($price).' đ</span>';										
						$sale_price_des=fnPrice($sale_price);						
					}
					$sale_price_des='<span class="price-sale">'.$sale_price_des. ' đ'.'</span>' ;					
					$str_price=$regular_price . '&nbsp;&nbsp;' . $sale_price_des ;				
					?>
					<div>
						<div class="box-product">
							<div class="product-img"><center><figure><a href="<?php echo $permalink; ?>"><img src="<?php echo $featureImg; ?>" alt="" /></a></figure></center>
								<div class="box-product-add-to-cart">
									<div class="them-vao-gio-hang">
										<a href="javascript:void(0)" data-toggle="modal" data-target="#modal-alert-add-cart" onclick="addToCart(<?php echo $id; ?>);" ><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;Thêm vào giỏ</a>									
									</div>
								</div>								
							</div>									
							<div class="box-product-title"><a href="<?php echo $permalink; ?>"><?php echo $fullname; ?></a></div>
							<div class="box-product-star">								
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star" aria-hidden="true"></i>								
							</div>
							<div class="box-product-general-price margin-top-5">
								<center><?php echo $str_price; ?></center>								                    
							</div>							                     
						</div>           
					</div>				
					<?php
				}
			}		
			?>		
    	</div>
    </div>
</div>
<div class="register-mail-bg margin-top-15">
	<div class="container">            
		<div class="col-lg-12 no-padding">
			<h3 class="subscribe-label">
				<span>Đăng ký nhận</span>&nbsp;<span class="tu-van-mien-phi">tư vấn miễn phí</span>
			</h3>
			<div class="mail-subscribe">Bạn là khách hàng , lớn hay nhỏ, và muốn chúng tôi phục vụ , xin vui lòng gửi cho chúng tôi một</div>
			<div class="mail-subscribe">email để support@megashop.com</div>
			<div class="box-register-email margin-top-5">              
				<div class="subscribe-email">
					<form action="#" method="post" name="mc-embedded-subscribe-form" target="_blank">
						<input type="email" value="" placeholder="Email của bạn" name="EMAIL" id="mail" aria-label="general.newsletter_form.newsletter_email">
						<button name="subscribe" id="subscribe">Gửi ngay</button>
					</form>
				</div>                                                                  
			</div>
		</div>
		<div class="clr"></div>
	</div>
</div>
<div class="cleverhouse padding-bottom-15">
	<div class="container">
		<div class="header-title">
			<h4><span><font color="#3AB54A">Nhà</font></span> thông minh</h4>                          
		</div>
		<div class="margin-top-15">
			<script type="text/javascript" language="javascript">
				jQuery(document).ready(function(){
					jQuery(".owl-carousel-clever-house").owlCarousel({
						autoplay:false,                    
						loop:true,
						margin:10,                        
						nav:true,                                            
						responsiveClass:true,
						responsive:{
							0:{
								items:1,
								nav:true
							},
							600:{
								items:1,
								nav:false
							},
							1000:{
								items:4,
								nav:true,
								loop:false
							}
						}
					})
				});                
			</script>
			<div class="owl-carousel owl-carousel-clever-house owl-theme">
				<?php
				if(count($data_clever_house) > 0){
					$k=1;
					$post_count=count($data_clever_house);				 
					for($i=0;$i<count($data_clever_house);$i++){
						$id=$data_clever_house[$i]['id'];			
						$permalink=url('/san-pham/'.$data_clever_house[$i]['alias'].'.html');
						$featureImg=asset('/resources/upload/'.$data_clever_house[$i]['image']);
						$fullname=$data_clever_house[$i]['fullname'];	
						$price=$data_clever_house[$i]['price'];
						$sale_price=$data_clever_house[$i]['sale_price'];
						$str_price='';
						$sale_price_des='';
						$regular_price='';
						if(!empty($price)){						
							$sale_price_des=fnPrice($price);								
						}
						if(!empty($sale_price)){				
							$regular_price ='<span class="price-regular">'.fnPrice($price).' đ</span>';										
							$sale_price_des=fnPrice($sale_price);						
						}
						$sale_price_des='<span class="price-sale">'.$sale_price_des. ' đ'.'</span>' ;					
						$str_price=$regular_price . '&nbsp;&nbsp;' . $sale_price_des ;				
						?>
						<div>
							<div class="box-product">
								<div class="product-img"><center><figure><a href="<?php echo $permalink; ?>"><img src="<?php echo $featureImg; ?>" alt="" /></a></figure></center>
									<div class="box-product-add-to-cart">
										<div class="them-vao-gio-hang">
											<a href="javascript:void(0)" data-toggle="modal" data-target="#modal-alert-add-cart" onclick="addToCart(<?php echo $id; ?>);" ><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;Thêm vào giỏ</a>									
										</div>
									</div>								
								</div>									
								<div class="box-product-title"><a href="<?php echo $permalink; ?>"><?php echo $fullname; ?></a></div>
								<div class="box-product-star">								
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>								
								</div>
								<div class="box-product-general-price margin-top-5">
									<center><?php echo $str_price; ?></center>								                    
								</div>							                     
							</div>           
						</div>				
						<?php
					}
				}		
				?>		
			</div>
		</div>
	</div>
</div>    
@endsection()               