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
		<div></div>
		<div class="clr"></div>
	</div>
</div>
@endsection()               