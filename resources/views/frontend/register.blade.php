
    <h3 class="page-title h-title">Đăng ký</h3>
    <?php
    $msg="";
    if(count($arrError) > 0){
        $msg .= '<ul class="comproduct33">';        
        foreach ($arrError as $key => $val){
            $msg .= '<li>' . $val . '</li>';
        }
        $msg .= '</ul>';
        echo $msg;
    }        
    ?>
    <form method="post" name="frm">    
        <table id="com_product30" class="com_product30" border="0" width="90%" cellpadding="0" cellspacing="0">                   
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
                        <input name="btnRegisterMember" type="submit" class="com_product32" />
                        <input type="hidden" name="action" value="register-member" />
                        {{ csrf_field() }}
                    </td>                      
                </tr> 
            </tbody>    
        </table>
    </form>    

