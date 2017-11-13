<?php 
use App\ArticleCategoryModel;
$strImage= url('/resources/upload'); 

$strThumbnail= url('/resources/upload/'.WIDTH."x".HEIGHT."-") ;

if(!empty($arrRowArticle)){

	?>

	<h1 class="h_1 title-article margin-bottom-15">{!! $name !!}</h1>				

		<?php 
		if(!empty($arrRowArticle["intro"])){
			?>
			<div class="intro-article ">{!! $arrRowArticle["intro"] !!}</div>
			<?php 
		}
		?>
		

		<div class="clr"></div>

		<div class="margin-bottom-15">{!! $arrRowArticle["content"] !!}</div>

		<div>
<form name="frm" action="{!! route('frontend.home.postRegister') !!}" method="post" accept-charset="UTF-8">



                            <input type="hidden" name="_token" value="{!! csrf_token() !!}" />       



                            <table class="tbl-dang-ky-tu-van" cellpadding="0" cellspacing="0">


                            	<tr>
                            		<td colspan="2" class="td-dang-ky">ĐĂNG KÝ</td>

                            	</tr>
                                <tr>



                                    <td><b>Họ tên</b></td>



                                    <td><b>Điện thoại</b></td>



                                </tr>



                                <tr>



                                    <td><input type="text" name="txtName" id="txtName" class="form-control" /></td>



                                    <td><input type="text" name="txtPhone" id="txtPhone" class="form-control" /></td>



                                </tr>   



                                <tr>



                                    <td colspan="2"><b>Nội dung</b></td>



                                </tr>



                                <tr>



                                    <td colspan="2"><textarea cols="50" class="form-control"  rows="5" name="txtContent" id="txtContent"></textarea></td>



                                </tr>                                                          



                                <tr>



                                    <td><button type="submit" class="btn btn-primary" onclick="return checkRegister();">Đăng ký</button></td>



                                    <td></td>



                                </tr>



                            </table>



                        </form>
		</div>

		<?php 
		$urlsite=url('/bai-viet/'.$arrRowArticle['alias'].'.html');
		?>
		<div class="fb-comments" data-href="<?php echo $urlsite; ?>" data-numposts="5"></div>
		<?php
		$id=$arrRowArticle["id"];		
		$arrArticleCategory=ArticleCategoryModel::select("category_article_id")->where("article_id","=",(int)@$id)->get()->toArray();
		$arrCategoryArticleID=array();
		if(!empty($arrArticleCategory)){
			foreach ($arrArticleCategory as $key => $value) {
				$arrCategoryArticleID[]=$value["category_article_id"];
			}
		}		
		$strCategoryArticleID=join(',',$arrCategoryArticleID);	
		$sql="
			select a.name , a.alias
			from 
			article a 
			inner join article_category ac on a.id = ac.article_id
			where
			ac.category_article_id in (".$strCategoryArticleID.")
			and a.id != " . (int)@$id . "
			order by a.name asc
			limit 10
			";
		$arrRelatedArticle =DB::select($sql);						
		if(!empty($arrRelatedArticle)){

			$arrRelatedArticle=convertToArray(@$arrRelatedArticle);

			?>

			<div><b>TIN LIÊN QUAN</b></div>

			<ul>

			<?php			

			foreach ($arrRelatedArticle as $key => $value) {

				?>

				<li class="related-article-cate"><a href="{!! url('/bai-viet/'.$value['alias'].'.html') !!}" class="a_2"><?php echo $value["name"]; ?></a></li>

				<?php

			}

			?></ul><?php 

		}		

}

 
?>



		