<h3 class="page-title h-title">Xác nhận thanh toán</h3>
<?php
$data_setting_system=getSettingSystem();
$product_width=$data_setting_system['product_width'];
$product_height=$data_setting_system['product_height'];
     
$ssName="vmart";
$arrCart=array();
if(Session::has($ssName)){    
    $arrCart = @Session::get($ssName)["cart"];    
}     
if(count($arrCart) > 0){
    ?>
    <table id="com_product16" class="com_product16" cellpadding="0" cellspacing="0" width="100%">
    <thead>
    <tr>    
        <th align="center">Sản phẩm</th>
        <th width="20%"><center>Giá</center></th>
        <th  width="10%"><center>Số lượng</center></th>
        <th width="20%"><center>Tổng giá</center></th>        
    </tr>
    </thead>
    <tbody>
    <?php   
    $total_price=0;
    $total_quantity=0;
    foreach ($arrCart as $key => $value) {  
        $product_id=$value["product_id"];      
        $product_name=$value["product_name"];
        $product_code=$value["product_code"];
        $product_price=$value["product_price"];        
        $product_image=    url('/resources/upload/'.$product_width."x".$product_height."-"). $value["product_image"] ;        
        $product_link= url('/san-pham/'.$value['product_alias'].'.html');           
        $product_quantity=$value["product_quantity"];
        $product_price=fnPrice($value["product_price"]) ;
        $product_total_price=fnPrice($value["product_total_price"]) ;
        $total_price+=(float)$value["product_total_price"];  
        $total_quantity+=(float)$product_quantity;    
        ?>
        <tr>
            
            <td class="com_product20"><a href="<?php echo $product_link ?>"><?php echo $product_name; ?></a></td>
            <td class="com_product21" align="right"><?php echo $product_price; ?></td>
            <td align="center" class="com_product22"><?php echo $product_quantity; ?></td>
            <td class="com_product23" align="right"><?php echo $product_total_price; ?></td>            
        </tr>
        <?php
     } 
    ?>                  
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2">
                Tổng cộng
            </td>
            <td align="center"><?php echo $total_quantity; ?></td>
            <td align="right"><?php echo fnPrice($total_price) ; ?></td>
            
        </tr>
    </tfoot>
</table>
    <?php
}       
$msg="";
if(count($arrError) > 0){
        $msg .= '<ul class="comproduct33">';        
        foreach ($arrError as $key => $val){
            $msg .= '<li>' . $val . '</li>';
        }
        $msg .= '</ul>';
    }   
    echo $msg;
?>
<form method="post" name="frm">    
    <table id="com_product30" class="com_product30" border="0" width="40%" cellpadding="0" cellspacing="0">                   
        <tbody>        
            <tr>
                <td align="right">Tài khoản</td>
                <td><?php echo @$arrData["username"]; ?></td>        
            </tr>                           
            <tr>
                <td align="right">Email</td>
                <td><input type="text" name="email" value="<?php echo @$arrData["email"]; ?>" /></td>                   
            </tr>                     
            <tr>
                <td align="right">Tên</td>
                <td><input type="text" name="fullname" value="<?php echo @$arrData["fullname"]; ?>" /></td>            
            </tr>
            <tr>
                <td align="right">Địa chỉ</td>
                <td><input type="text" name="address" value="<?php echo @$arrData["address"]; ?>" /></td>            
            </tr>                
            <tr>
                <td align="right">Phone</td>
                <td><input type="text" name="phone" value="<?php echo @$arrData["phone"]; ?>" /></td>            
            </tr>
            <tr>
                <td align="right">Mobile phone</td>
                <td><input type="text" name="mobilephone" value="<?php echo @$arrData["mobilephone"]; ?>" /></td>            
            </tr>
            <tr>
                <td align="right">Fax</td>
                <td><input type="text" name="fax" value="<?php echo @$arrData["fax"]; ?>" /></td>            
            </tr>   
            <tr>           
                <td></td>
                <td class="com_product31" align="right">
                    <input name="btnChangeInfo" type="submit" class="com_product32" value="Cập nhật" />
                    <input type="hidden" name="id" value="<?php echo @$arrData["id"]; ?>" />
                    <input type="hidden" name="username" value="<?php echo @$arrData["username"]; ?>" />
                    <input type="hidden" name="quantity" value="<?php echo @$total_quantity; ?>" />
                    <input type="hidden" name="total_price" value="<?php echo @$total_price; ?>" />
                    <input type="hidden" name="action" value="finished-checkout" />                    
                    {{ csrf_field() }}                             
                </td>                       
            </tr> 
        </tbody>    
    </table>
</form>