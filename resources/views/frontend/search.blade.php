<?php 

$strImage= url('/upload') ;

?>

<h3 class="h_1 title-article">{!! $name !!}</h3>

		<?php

		if(!empty($arrArticle)){

			foreach ($arrArticle as $key => $value) {

		 	?>

		 	<div class="article-lst">

				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

					<figure><a href="{!! url('/bai-viet/'.$value['alias'].'.html') !!}"><img src="{!! $strImage . DS . $value['image'] !!}" /></a></figure>

				</div>

				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 category-right">

					<div class="margin-bottom-5"><a href="{!! url('/bai-viet/'.$value['alias'].'.html') !!}" class="a_1">{!! $value["name"] !!}</a></div>

					<div class="category-intro"><?php echo mb_substr($value["intro"], 0, 150) . '...';?></div>					

				</div>

				<div class="clr"></div>

			</div>

		 	<?php 

		 }

		}		 

		?>		