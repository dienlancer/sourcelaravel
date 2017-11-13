<?php     
$strUpload=       url('/resources/upload/'.WIDTH."x".HEIGHT."-");
        if (!empty($arrRowProduct)) {      
            $productID=$arrRowProduct["id"];      
            $productName=$arrRowProduct["name"];
            $productCode=$arrRowProduct["code"];
            $productAlias=$arrRowProduct["alias"];
            $productPrice=$arrRowProduct["price"];  
            $productImage=     $arrRowProduct["image"] ;         
            ?>
            <div class="row">
                <div class="col-md-4">
                                        <figure><a href="#"><img src="<?php echo $strUpload . $productImage; ?>"></a></figure>
                </div>
                <div class="col-md-8">
                    <form name="frm" method="post" >
                        <table cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td>Mã sản phẩm</td>
                                <td><?php echo $productCode; ?></td>
                            </tr>
                            <tr>
                                <td>Tên sản phẩm</td>
                                <td><?php echo $productName; ?></td>
                            </tr>                            
                            <tr>
                                <td>Giá</td>
                                <td><?php echo $productPrice; ?></td>
                            </tr>                            
                            <tr>
                                <td><input type="submit"  value="Mua hàng" /></td>
                                <td><a href="<?php echo url("/gio-hang.html"); ?>">Giỏ hàng</a></td>
                            </tr>
                        </table>
                        <input type="hidden" name="product_id" value="<?php     echo $productID; ?>" />
                        <input type="hidden" name="product_code" value="<?php   echo $productCode; ?>" />
                        <input type="hidden" name="product_name" value="<?php   echo $productName; ?>" />
                        <input type="hidden" name="product_alias" value="<?php  echo $productAlias; ?>" />
                        <input type="hidden" name="product_image" value="<?php  echo $productImage; ?>" />
                        <input type="hidden" name="product_price" value="<?php  echo $productPrice; ?>" />
                        <input type="hidden" name="product_quantity" value="1" />  
                        <input type="hidden" name="action" value="add-cart" />                      
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                    </form>        
                </div>
            </div>
            <?php
        }
  
?>



           