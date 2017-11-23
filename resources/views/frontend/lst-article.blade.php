<?php 

$strImage= url('/upload/'.WIDTH."x".HEIGHT."-") ;

?>

<form action="" method="post" name="adminForm" id="adminForm" class="frm">

<h3 class="h_1 title-article margin-bottom-15">{!! $name !!}</h3>

		<?php

		if(!empty($arrArticle)){

			foreach ($arrArticle as $key => $value) {

		 	?>

		 	<div class="article-lst">

				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

					<figure><a href="{!! url('/bai-viet/'.$value['alias'].'.html') !!}"><img src=" <?php echo $strImage . $value['image'] ?>" /></a></figure>

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

    <input type="hidden" name="filter_page" value="1">         

    <input type="hidden" name="_token" value="{!! csrf_token() !!}" />

</form>