<?php
$msg="";
if(!empty($arrError)){
        $msg .= '<ul class="comproduct33">';        
        foreach ($arrError as $key => $val){
            $msg .= '<li>' . $val . '</li>';
        }
        $msg .= '</ul>';
    }    
    if(!empty($arrError))
        echo $msg;   
?>
<form method="post" name="frm">    
    <table id="com_product30" class="com_product30" border="0" width="40%" cellpadding="0" cellspacing="0">                   
        <tbody>        
            <tr>
                <td align="right">Tài khoản</td>
                <td><input type="text" name="username" /></td>        
            </tr>       
            <tr>
                <td align="right">Mật khẩu</td>
                <td><input type="password" name="password" /></td>        
            </tr>            
            <tr>           
                <td></td>
                <td class="com_product31" align="right">
                    <input name="btnRegisterMember" type="submit" class="com_product32" />
                    <input type="hidden" name="action" value="login" />
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}" />                     
                </td>                      
            </tr> 
        </tbody>    
    </table>
</form>