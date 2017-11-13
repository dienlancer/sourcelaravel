<?php 

$strImage= url('/resources/upload/'.WIDTH."x".HEIGHT."-") ;

$paginationHTML     = $pagination->showPagination(); 

?>

<form action="" method="post" name="adminForm" id="adminForm" class="frm">

<h3 class="h_1 title-article margin-bottom-15"><?php echo $name; ?></h3>

		<?php

		if(!empty($arrLstProduct)){
			$i=1;
			foreach ($arrLstProduct as $key => $value) {
				$linkProduct= url('/san-pham/'.$value['alias'].'.html');
		 	?>

		 	<div class="col-md-4">
                <div>
                    <figure><a href="<?php echo $linkProduct; ?>"><img src="<?php echo $strImage . $value['image'] ?>"></a></figure>
                </div>                        
                <div class="item-row-title-category-article">
                    <div><a href="<?php echo $linkProduct; ?>" class="a_1"><?php echo $value["alias"]; ?></a></div>
                    <div><?php echo $value["price"]; ?></div>
                </div>                        
            </div>
			

		 	<?php 
		 	if($i%3==0)
                echo '<div class="clr"></div>';
            $i++;  
		 }
		 echo '<div class="clr"></div>';
		 echo '<div class="pagination-category">'.$paginationHTML.'</div>' ;		 

		}		 

		?>

    <input type="hidden" name="filter_page" value="1">         

    <input type="hidden" name="_token" value="{!! csrf_token() !!}" />

</form>