<?php
$ssName="vmart";
$arrCart=array();
if(Session::has($ssName)){    
    $arrCart = @Session::get($ssName)["cart"];    
}     
$msg="";
if(!empty($arrError)){
        $msg .= '<ul class="comproduct33">';        
        foreach ($arrError as $key => $val){
            $msg .= '<li>' . $val . '</li>';
        }
        $msg .= '</ul>';
    }
if(!empty($arrCart)){
    ?>
    <table id="com_product16" class="com_product16" cellpadding="0" cellspacing="0" width="100%">
    <thead>
    <tr>    
        <th>Sản phẩm</th>
        <th>Giá</th>
        <th>Số lượng</th>
        <th>Tổng giá</th>        
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
        $product_image=    url('/resources/upload/'.WIDTH."x".HEIGHT."-"). $value["product_image"] ;        
        $product_link= url('/san-pham/'.$value['product_alias'].'.html');           
        $product_quantity=$value["product_quantity"];
        $product_price=$value["product_price"];
        $product_total_price=$value["product_total_price"];
        $total_price+=(float)$product_total_price;  
        $total_quantity+=(float)$product_quantity;    
        $delete_cart=url("/xoa-gio-hang");
        $continue_link=url("/nhom-san-pham/".$alias.".html");
        $delete_link=url("/xoa/".$product_id);
        $checkout_link=url("/thanh-toan");
        ?>
        <tr>
            
            <td class="com_product20"><a href="<?php echo $product_link ?>"><?php echo $product_name; ?></a></td>
            <td class="com_product21"><?php echo $product_price; ?></td>
            <td align="center" class="com_product22"><?php echo $product_quantity; ?></td>
            <td class="com_product23"><?php echo $product_total_price; ?></td>            
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
            <td><?php echo $total_quantity; ?></td>
            <td ><?php echo $total_price; ?></td>
            
        </tr>
    </tfoot>
</table>
    <?php
}   
if(!empty($arrError))
    echo $msg;    
?>
<div class="row">
    <div class="col-md-8">
        <form method="post" name="frmRegister">    
            <table id="com_product30" class="com_product30" border="0" width="100%" cellpadding="0" cellspacing="0">  
                <thead><tr><th>Đăng ký tài khoản</th></tr></thead>                 
                <tbody>        
                    <tr>
                        <td align="right">Tài khoản</td>
                        <td><input type="text" name="username" value="<?php echo @$arrData["username"]; ?>" /></td>        
                    </tr>       
                    <tr>
                        <td align="right">Mật khẩu</td>
                        <td><input type="password" name="password" value="<?php echo @$arrData["password"]; ?>" /></td>        
                    </tr>
                    <tr>
                        <td align="right">Xác nhận mật khẩu</td>
                        <td><input type="password" name="password_confirm" value="<?php echo @$arrData["password_confirm"]; ?>" /></td>        
                    </tr>               
                    <tr>
                        <td align="right">Email</td>
                        <td><input type="text" name="email" value="<?php echo @$arrData["email"]; ?>" /></td>                   
                    </tr>                     
                    <tr>
                        <td align="right">Tên</td>
                        <td><input type="text" name="name" value="<?php echo @$arrData["name"]; ?>" /></td>            
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
                            <input name="btnRegisterMember" type="submit" class="com_product32" />
                            <input type="hidden" name="action" value="register-checkout" />
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}" />                     
                        </td>                      
                    </tr> 
                </tbody>    
            </table>
        </form>
    </div>
    <div class="col-md-4">
        <form method="post" name="frmLogin">
            <table id="com_product30" class="com_product30" border="0" width="100%" cellpadding="0" cellspacing="0">
            
            <thead><tr><th>Đăng nhập thanh toán</th></tr></thead>   
            <tbody><tr>
                <td colspan="2"><input type="text" name="username" value=""></td>
            </tr>
            <tr>
                <td colspan="2"><input type="password" name="password" value=""></td>
            </tr>
            <tr>           
                <td></td>
                <td class="com_product31" align="right">
                    <input name="btnLogin" type="submit" class="com_product32" />
                    <input type="hidden" name="action" value="login-checkout" />
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}" />                     
                </td>                      
            </tr>             </tbody>    
                        
            </table>    
        </form>
    </div>
</div>