<?php 
function categoryArticleConverter($data=array(),$controller){        
    $result = array();
    if( count($data) > 0){
        for($i = 0 ;$i < count($data);$i++){
            $edited='<center><a href="'.route('admin.'.$controller.'.getForm',['edit',$data[$i]['id']]).'"><img src="'.url("/public/admin/images/edit-icon.png").'" /></a></center>';
            $deleted='<center><a href="javascript:void(0)" onclick="deleteItem('.$data[$i]["id"].')"><img src="'.url("/public/admin/images/delete-icon.png").'" /></a></center>';
            $kicked=0;
            if((int)$data[$i]["status"]==1)
                $kicked=0;
            else
                $kicked=1;
            $status     = '<center>'.cmsStatus((int)$data[$i]["id"],(int)$data[$i]["status"],$kicked).'</center>';
            $sort_order = '<center><input name="sort_order" id="sort-order-'.$data[$i]["id"].'" sort_order_id="'.$data[$i]["id"].'" onkeyup="setSortOrder(this)" value="'.$data[$i]["sort_order"].'" size="3" style="text-align:center" /></center>';
            $link_image="";
            $image="";
            if(!empty($data[$i]["image"])){
                $link_image=url("/resources/upload/" . WIDTH . "x" . HEIGHT . "-".$data[$i]["image"]);            
                $image = '<center><img src="'.$link_image.'" width="'.((int)(WIDTH/20)).'" height="'.((int)(HEIGHT/20)).'" /></center>';
            }            
            $result[$i] = array(
                'checked'                  =>   '<input type="checkbox" onclick="checkWithList(this)" name="cid" value="'.$data[$i]["is_checked"].'" />',
                'is_checked'               =>   0,
                "id"                       =>   $data[$i]["id"],
                "fullname"                 =>   $data[$i]["fullname"],
                "parent_fullname"          =>   $data[$i]["parent_fullname"],
                "alias"                    =>   $data[$i]["alias"],
                "parent_id"                =>   $data[$i]["parent_id"],
                "image"                    =>   $image,
                "sort_order"               =>   $sort_order,
                "status"                   =>   $status,
                "created_at"               =>   datetimeConverterVn($data[$i]["created_at"]),
                "updated_at"               =>   datetimeConverterVn($data[$i]["updated_at"]),
                "edited"                   =>   $edited,
                "deleted"                  =>   $deleted
            );
        }
    }
    return $result;
}
function articleConverter($data=array(),$controller){        
    $result = array();
    if( count($data) > 0){
        for($i = 0 ;$i < count($data);$i++){
            $edited='<center><a href="'.route('admin.'.$controller.'.getForm',['edit',$data[$i]['id']]).'"><img src="'.url("/public/admin/images/edit-icon.png").'" /></a></center>';
            $deleted='<center><a href="javascript:void(0)" onclick="deleteItem('.$data[$i]["id"].')"><img src="'.url("/public/admin/images/delete-icon.png").'" /></a></center>';
            $kicked=0;
            if((int)$data[$i]["status"]==1)
                $kicked=0;
            else
                $kicked=1;
            $status     = '<center>'.cmsStatus((int)$data[$i]["id"],(int)$data[$i]["status"],$kicked).'</center>';
            $sort_order = '<center><input name="sort_order" id="sort-order-'.$data[$i]["id"].'" sort_order_id="'.$data[$i]["id"].'" onkeyup="setSortOrder(this)" value="'.$data[$i]["sort_order"].'" size="3" style="text-align:center" /></center>';
            $link_image="";
            $image="";
            if(!empty($data[$i]["image"])){
                $link_image=url("/resources/upload/" . WIDTH . "x" . HEIGHT . "-".$data[$i]["image"]);            
                $image = '<center><img src="'.$link_image.'" width="'.((int)(WIDTH/20)).'" height="'.((int)(HEIGHT/20)).'" /></center>';
            }            
            $result[$i] = array(
                'checked'                  =>   '<input type="checkbox" onclick="checkWithList(this)" name="cid" value="'.$data[$i]["is_checked"].'" />',
                'is_checked'               =>   0,
                "id"                       =>   $data[$i]["id"],
                "fullname"                 =>   $data[$i]["fullname"],                
                "alias"                    =>   $data[$i]["alias"],                
                "image"                    =>   $image,
                "sort_order"               =>   $sort_order,
                "status"                   =>   $status,
                "created_at"               =>   datetimeConverterVn($data[$i]["created_at"]),
                "updated_at"               =>   datetimeConverterVn($data[$i]["updated_at"]),
                "edited"                   =>   $edited,
                "deleted"                  =>   $deleted
            );
        }
    }
    return $result;
}
function menuTypeConverter($data=array(),$controller){        
    $result = array();
    if( count($data) > 0){
        for($i = 0 ;$i < count($data);$i++){
            $edited='<center><a href="'.route('admin.'.$controller.'.getForm',['edit',$data[$i]['id']]).'"><img src="'.url("/public/admin/images/edit-icon.png").'" /></a></center>';
            $deleted='<center><a href="javascript:void(0)" onclick="deleteItem('.$data[$i]["id"].')"><img src="'.url("/public/admin/images/delete-icon.png").'" /></a></center>';            
            $sort_order = '<center><input name="sort_order" id="sort-order-'.$data[$i]["id"].'" sort_order_id="'.$data[$i]["id"].'" onkeyup="setSortOrder(this)" value="'.$data[$i]["sort_order"].'" size="3" style="text-align:center" /></center>';        
            $fullname = '<a href="'.route('admin.menu.getList',[$data[$i]['id']]).'">'.$data[$i]["fullname"].'</a>';
            $result[$i] = array(
                'checked'                  =>   '<input type="checkbox" onclick="checkWithList(this)" name="cid" value="'.$data[$i]["is_checked"].'" />',
                'is_checked'               =>   0,
                "id"                       =>   $data[$i]["id"],
                "fullname"                 =>   $fullname,                                
                "sort_order"               =>   $sort_order,                
                "created_at"               =>   datetimeConverterVn($data[$i]["created_at"]),
                "updated_at"               =>   datetimeConverterVn($data[$i]["updated_at"]),
                "edited"                   =>   $edited,
                "deleted"                  =>   $deleted
            );
        }
    }
    return $result;
}
function menuConverter($data=array(),$controller){        
    $result = array();
    if( count($data) > 0){
        for($i = 0 ;$i < count($data);$i++){
            $edited='<center><a href="'.route('admin.'.$controller.'.getForm',['edit',$data[$i]['menu_type_id'],$data[$i]['id']]).'"><img src="'.url("/public/admin/images/edit-icon.png").'" /></a></center>';
            $deleted='<center><a href="javascript:void(0)" onclick="deleteItem('.$data[$i]["id"].')"><img src="'.url("/public/admin/images/delete-icon.png").'" /></a></center>';
            $kicked=0;
            if((int)$data[$i]["status"]==1)
                $kicked=0;
            else
                $kicked=1;
            $status     = '<center>'.cmsStatus((int)$data[$i]["id"],(int)$data[$i]["status"],$kicked).'</center>';
            $sort_order = '<center><input name="sort_order" id="sort-order-'.$data[$i]["id"].'" sort_order_id="'.$data[$i]["id"].'" onkeyup="setSortOrder(this)" value="'.$data[$i]["sort_order"].'" size="3" style="text-align:center" /></center>';           
            $result[$i] = array(
                'checked'                  =>   '<input type="checkbox" onclick="checkWithList(this)" name="cid" value="'.$data[$i]["is_checked"].'" />',
                'is_checked'               =>   0,
                "id"                       =>   $data[$i]["id"],
                "fullname"                 =>   $data[$i]["fullname"],
                "level"                    =>   $data[$i]["level"],
                "alias"                    =>   $data[$i]["alias"],
                "site_link"                =>   $data[$i]["site_link"],
                "parent_id"                =>   $data[$i]["parent_id"],
                "parent_fullname"          =>   $data[$i]["parent_fullname"],                
                "menu_type_id"             =>   $data[$i]["menu_type_id"],                
                "level"                    =>   $data[$i]["level"],                
                "sort_order"               =>   $sort_order,
                "status"                   =>   $status,
                "created_at"               =>   datetimeConverterVn($data[$i]["created_at"]),
                "updated_at"               =>   datetimeConverterVn($data[$i]["updated_at"]),
                "edited"                   =>   $edited,
                "deleted"                  =>   $deleted
            );
        }
    }
    return $result;
}
function categoryProductConverter($data=array(),$controller){        
    $result = array();
    if( count($data) > 0){
        for($i = 0 ;$i < count($data);$i++){
            $edited='<center><a href="'.route('admin.'.$controller.'.getForm',['edit',$data[$i]['id']]).'"><img src="'.url("/public/admin/images/edit-icon.png").'" /></a></center>';
            $deleted='<center><a href="javascript:void(0)" onclick="deleteItem('.$data[$i]["id"].')"><img src="'.url("/public/admin/images/delete-icon.png").'" /></a></center>';
            $kicked=0;
            if((int)$data[$i]["status"]==1)
                $kicked=0;
            else
                $kicked=1;
            $status     = '<center>'.cmsStatus((int)$data[$i]["id"],(int)$data[$i]["status"],$kicked).'</center>';
            $sort_order = '<center><input name="sort_order" id="sort-order-'.$data[$i]["id"].'" sort_order_id="'.$data[$i]["id"].'" onkeyup="setSortOrder(this)" value="'.$data[$i]["sort_order"].'" size="3" style="text-align:center" /></center>';
            $link_image="";
            $image="";
            if(!empty($data[$i]["image"])){
                $link_image=url("/resources/upload/" . WIDTH . "x" . HEIGHT . "-".$data[$i]["image"]);            
                $image = '<center><img src="'.$link_image.'" width="'.((int)(WIDTH/20)).'" height="'.((int)(HEIGHT/20)).'" /></center>';
            }            
            $result[$i] = array(
                'checked'                  =>   '<input type="checkbox" onclick="checkWithList(this)" name="cid" value="'.$data[$i]["is_checked"].'" />',
                'is_checked'               =>   0,
                "id"                       =>   $data[$i]["id"],
                "fullname"                 =>   $data[$i]["fullname"],
                "parent_fullname"          =>   $data[$i]["parent_fullname"],
                "alias"                    =>   $data[$i]["alias"],
                "parent_id"                =>   $data[$i]["parent_id"],
                "image"                    =>   $image,
                "sort_order"               =>   $sort_order,
                "status"                   =>   $status,
                "created_at"               =>   datetimeConverterVn($data[$i]["created_at"]),
                "updated_at"               =>   datetimeConverterVn($data[$i]["updated_at"]),
                "edited"                   =>   $edited,
                "deleted"                  =>   $deleted
            );
        }
    }
    return $result;
}
function productConverter($data=array(),$controller){        
    $result = array();
    if( count($data) > 0){
        for($i = 0 ;$i < count($data);$i++){
            $edited='<center><a href="'.route('admin.'.$controller.'.getForm',['edit',$data[$i]['id']]).'"><img src="'.url("/public/admin/images/edit-icon.png").'" /></a></center>';
            $deleted='<center><a href="javascript:void(0)" onclick="deleteItem('.$data[$i]["id"].')"><img src="'.url("/public/admin/images/delete-icon.png").'" /></a></center>';
            $kicked=0;
            if((int)$data[$i]["status"]==1)
                $kicked=0;
            else
                $kicked=1;
            $status     = '<center>'.cmsStatus((int)$data[$i]["id"],(int)$data[$i]["status"],$kicked).'</center>';
            $sort_order = '<center><input name="sort_order" id="sort-order-'.$data[$i]["id"].'" sort_order_id="'.$data[$i]["id"].'" onkeyup="setSortOrder(this)" value="'.$data[$i]["sort_order"].'" size="3" style="text-align:center" /></center>';
            $link_image="";
            $image="";
            if(!empty($data[$i]["image"])){
                $link_image=url("/resources/upload/" . WIDTH . "x" . HEIGHT . "-".$data[$i]["image"]);            
                $image = '<center><img src="'.$link_image.'" width="'.((int)(WIDTH/20)).'" height="'.((int)(HEIGHT/20)).'" /></center>';
            }            
            $result[$i] = array(
                'checked'                  =>   '<input type="checkbox" onclick="checkWithList(this)" name="cid" value="'.$data[$i]["is_checked"].'" />',
                'is_checked'               =>   0,
                "id"                       =>   $data[$i]["id"],
                "code"                     =>   $data[$i]["code"],
                "fullname"                 =>   $data[$i]["fullname"],                
                "alias"                    =>   $data[$i]["alias"],                
                "image"                    =>   $image,
                "price"                    =>   number_format($data[$i]["price"],0,".",","),
                "sort_order"               =>   $sort_order,
                "status"                   =>   $status,
                "created_at"               =>   datetimeConverterVn($data[$i]["created_at"]),
                "updated_at"               =>   datetimeConverterVn($data[$i]["updated_at"]),
                "edited"                   =>   $edited,
                "deleted"                  =>   $deleted
            );
        }
    }
    return $result;
}
function moduleMenuConverter($data=array(),$controller){        
    $result = array();
    if( count($data) > 0){
        for($i = 0 ;$i < count($data);$i++){
            $edited='<center><a href="'.route('admin.'.$controller.'.getForm',['edit',$data[$i]['id']]).'"><img src="'.url("/public/admin/images/edit-icon.png").'" /></a></center>';
            $deleted='<center><a href="javascript:void(0)" onclick="deleteItem('.$data[$i]["id"].')"><img src="'.url("/public/admin/images/delete-icon.png").'" /></a></center>';
            $kicked=0;
            if((int)$data[$i]["status"]==1)
                $kicked=0;
            else
                $kicked=1;
            $status     = '<center>'.cmsStatus((int)$data[$i]["id"],(int)$data[$i]["status"],$kicked).'</center>';
            $sort_order = '<center><input name="sort_order" id="sort-order-'.$data[$i]["id"].'" sort_order_id="'.$data[$i]["id"].'" onkeyup="setSortOrder(this)" value="'.$data[$i]["sort_order"].'" size="3" style="text-align:center" /></center>';                
            $result[$i] = array(
                'checked'                  =>   '<input type="checkbox" onclick="checkWithList(this)" name="cid" value="'.$data[$i]["is_checked"].'" />',
                'is_checked'               =>   0,
                "id"                       =>   $data[$i]["id"],
                "fullname"                 =>   $data[$i]["fullname"],         
                "position"                 =>   $data[$i]["position"],                                                    
                "sort_order"               =>   $sort_order,
                "status"                   =>   $status,
                "created_at"               =>   datetimeConverterVn($data[$i]["created_at"]),
                "updated_at"               =>   datetimeConverterVn($data[$i]["updated_at"]),
                "edited"                   =>   $edited,
                "deleted"                  =>   $deleted
            );
        }
    }
    return $result;
}
function moduleArticleConverter($data=array(),$controller){        
    $result = array();
    if( count($data) > 0){
        for($i = 0 ;$i < count($data);$i++){
            $edited='<center><a href="'.route('admin.'.$controller.'.getForm',['edit',$data[$i]['id']]).'"><img src="'.url("/public/admin/images/edit-icon.png").'" /></a></center>';
            $deleted='<center><a href="javascript:void(0)" onclick="deleteItem('.$data[$i]["id"].')"><img src="'.url("/public/admin/images/delete-icon.png").'" /></a></center>';
            $kicked=0;
            if((int)$data[$i]["status"]==1)
                $kicked=0;
            else
                $kicked=1;
            $status     = '<center>'.cmsStatus((int)$data[$i]["id"],(int)$data[$i]["status"],$kicked).'</center>';
            $sort_order = '<center><input name="sort_order" id="sort-order-'.$data[$i]["id"].'" sort_order_id="'.$data[$i]["id"].'" onkeyup="setSortOrder(this)" value="'.$data[$i]["sort_order"].'" size="3" style="text-align:center" /></center>';                
            $result[$i] = array(
                'checked'                  =>   '<input type="checkbox" onclick="checkWithList(this)" name="cid" value="'.$data[$i]["is_checked"].'" />',
                'is_checked'               =>   0,
                "id"                       =>   $data[$i]["id"],
                "fullname"                 =>   $data[$i]["fullname"],         
                "position"                 =>   $data[$i]["position"],                                                    
                "sort_order"               =>   $sort_order,
                "status"                   =>   $status,
                "created_at"               =>   datetimeConverterVn($data[$i]["created_at"]),
                "updated_at"               =>   datetimeConverterVn($data[$i]["updated_at"]),
                "edited"                   =>   $edited,
                "deleted"                  =>   $deleted
            );
        }
    }
    return $result;
}
function moduleItemConverter($data=array(),$controller){        
    $result = array();
    if( count($data) > 0){
        for($i = 0 ;$i < count($data);$i++){
            $edited='<center><a href="'.route('admin.'.$controller.'.getForm',['edit',$data[$i]['id']]).'"><img src="'.url("/public/admin/images/edit-icon.png").'" /></a></center>';
            $deleted='<center><a href="javascript:void(0)" onclick="deleteItem('.$data[$i]["id"].')"><img src="'.url("/public/admin/images/delete-icon.png").'" /></a></center>';
            $kicked=0;
            if((int)$data[$i]["status"]==1)
                $kicked=0;
            else
                $kicked=1;
            $status     = '<center>'.cmsStatus((int)$data[$i]["id"],(int)$data[$i]["status"],$kicked).'</center>';
            $sort_order = '<center><input name="sort_order" id="sort-order-'.$data[$i]["id"].'" sort_order_id="'.$data[$i]["id"].'" onkeyup="setSortOrder(this)" value="'.$data[$i]["sort_order"].'" size="3" style="text-align:center" /></center>';                
            $result[$i] = array(
                'checked'                  =>   '<input type="checkbox" onclick="checkWithList(this)" name="cid" value="'.$data[$i]["is_checked"].'" />',
                'is_checked'               =>   0,
                "id"                       =>   $data[$i]["id"],
                "fullname"                 =>   $data[$i]["fullname"],         
                "position"                 =>   $data[$i]["position"],                                                    
                "sort_order"               =>   $sort_order,
                "status"                   =>   $status,
                "created_at"               =>   datetimeConverterVn($data[$i]["created_at"]),
                "updated_at"               =>   datetimeConverterVn($data[$i]["updated_at"]),
                "edited"                   =>   $edited,
                "deleted"                  =>   $deleted
            );
        }
    }
    return $result;
}
function groupMemberConverter($data=array(),$controller){        
    $result = array();
    if( count($data) > 0){
        for($i = 0 ;$i < count($data);$i++){
            $edited='<center><a href="'.route('admin.'.$controller.'.getForm',['edit',$data[$i]['id']]).'"><img src="'.url("/public/admin/images/edit-icon.png").'" /></a></center>';
            $deleted='<center><a href="javascript:void(0)" onclick="deleteItem('.$data[$i]["id"].')"><img src="'.url("/public/admin/images/delete-icon.png").'" /></a></center>';            
            $sort_order = '<center><input name="sort_order" id="sort-order-'.$data[$i]["id"].'" sort_order_id="'.$data[$i]["id"].'" onkeyup="setSortOrder(this)" value="'.$data[$i]["sort_order"].'" size="3" style="text-align:center" /></center>';                        
            $result[$i] = array(
                'checked'                  =>   '<input type="checkbox" onclick="checkWithList(this)" name="cid" value="'.$data[$i]["is_checked"].'" />',
                'is_checked'               =>   0,
                "id"                       =>   $data[$i]["id"],
                "fullname"                 =>   $data[$i]["fullname"],                                                                
                "sort_order"               =>   $sort_order,                
                "created_at"               =>   datetimeConverterVn($data[$i]["created_at"]),
                "updated_at"               =>   datetimeConverterVn($data[$i]["updated_at"]),
                "edited"                   =>   $edited,
                "deleted"                  =>   $deleted
            );
        }
    }
    return $result;
}
function userConverter($data=array(),$controller){        
    $result = array();
    if( count($data) > 0){
        for($i = 0 ;$i < count($data);$i++){
            $edited='<center><a href="'.route('admin.'.$controller.'.getForm',['edit',$data[$i]['id']]).'"><img src="'.url("/public/admin/images/edit-icon.png").'" /></a></center>';
            $deleted='<center><a href="javascript:void(0)" onclick="deleteItem('.$data[$i]["id"].')"><img src="'.url("/public/admin/images/delete-icon.png").'" /></a></center>';            
            $sort_order = '<center><input name="sort_order" id="sort-order-'.$data[$i]["id"].'" sort_order_id="'.$data[$i]["id"].'" onkeyup="setSortOrder(this)" value="'.$data[$i]["sort_order"].'" size="3" style="text-align:center" /></center>';         
            $kicked=0;
            if((int)$data[$i]["level"]==1)
                $kicked=0;
            else
                $kicked=1;
            $status     = '<center>'.cmsStatus((int)$data[$i]["id"],(int)$data[$i]["level"],$kicked).'</center>';   
            $result[$i] = array(
                'checked'                  =>   '<input type="checkbox" onclick="checkWithList(this)" name="cid" value="'.$data[$i]["is_checked"].'" />',
                'is_checked'               =>   0,
                "id"                       =>   $data[$i]["id"],
                "username"                 =>   $data[$i]["username"],                
                "email"                    =>   $data[$i]["email"],                
                "fullname"                 =>   $data[$i]["fullname"],      
                "group_member_name"        =>   $data[$i]["group_member_name"],          
                "status"                   =>   $status,
                "sort_order"               =>   $sort_order,                
                "created_at"               =>   datetimeConverterVn($data[$i]["created_at"]),
                "updated_at"               =>   datetimeConverterVn($data[$i]["updated_at"]),
                "edited"                   =>   $edited,
                "deleted"                  =>   $deleted
            );
        }
    }
    return $result;
}
function privilegeConverter($data=array(),$controller){        
    $result = array();
    if( count($data) > 0){
        for($i = 0 ;$i < count($data);$i++){
            $edited='<center><a href="'.route('admin.'.$controller.'.getForm',['edit',$data[$i]['id']]).'"><img src="'.url("/public/admin/images/edit-icon.png").'" /></a></center>';
            $deleted='<center><a href="javascript:void(0)" onclick="deleteItem('.$data[$i]["id"].')"><img src="'.url("/public/admin/images/delete-icon.png").'" /></a></center>';
            
            $sort_order = '<center><input name="sort_order" id="sort-order-'.$data[$i]["id"].'" sort_order_id="'.$data[$i]["id"].'" onkeyup="setSortOrder(this)" value="'.$data[$i]["sort_order"].'" size="3" style="text-align:center" /></center>';
            
            $result[$i] = array(
                'checked'                  =>   '<input type="checkbox" onclick="checkWithList(this)" name="cid" value="'.$data[$i]["is_checked"].'" />',
                'is_checked'               =>   0,
                "id"                       =>   $data[$i]["id"],
                "fullname"                 =>   $data[$i]["fullname"],
                "controller"               =>   $data[$i]["controller"],
                "action"                   =>   $data[$i]["action"]   ,                                   
                "sort_order"               =>   $sort_order,
                "created_at"               =>   datetimeConverterVn($data[$i]["created_at"]),
                "updated_at"               =>   datetimeConverterVn($data[$i]["updated_at"]),
                "edited"                   =>   $edited,
                "deleted"                  =>   $deleted
            );
        }
    }
    return $result;
}
function customerConverter($data=array(),$controller){        
    $result = array();
    if( count($data) > 0){
        for($i = 0 ;$i < count($data);$i++){
            $edited='<center><a href="'.route('admin.'.$controller.'.getForm',['edit',$data[$i]['id']]).'"><img src="'.url("/public/admin/images/edit-icon.png").'" /></a></center>';
            $deleted='<center><a href="javascript:void(0)" onclick="deleteItem('.$data[$i]["id"].')"><img src="'.url("/public/admin/images/delete-icon.png").'" /></a></center>';
            $kicked=0;
            if((int)$data[$i]["status"]==1)
                $kicked=0;
            else
                $kicked=1;
            $status     = '<center>'.cmsStatus((int)$data[$i]["id"],(int)$data[$i]["status"],$kicked).'</center>';
            $sort_order = '<center><input name="sort_order" id="sort-order-'.$data[$i]["id"].'" sort_order_id="'.$data[$i]["id"].'" onkeyup="setSortOrder(this)" value="'.$data[$i]["sort_order"].'" size="3" style="text-align:center" /></center>';
                    
            $result[$i] = array(
                'checked'                  =>   '<input type="checkbox" onclick="checkWithList(this)" name="cid" value="'.$data[$i]["is_checked"].'" />',
                'is_checked'               =>   0,
                "id"                       =>   $data[$i]["id"],
                "username"                 =>   $data[$i]["username"],
                "email"                    =>   $data[$i]["email"],
                "fullname"                 =>   $data[$i]["fullname"],
                "address"                  =>   $data[$i]["address"],
                "phone"                    =>   $data[$i]["phone"],
                "mobilephone"              =>   $data[$i]["mobilephone"],
                "sort_order"               =>   $sort_order,
                "status"                   =>   $status,
                "created_at"               =>   datetimeConverterVn($data[$i]["created_at"]),
                "updated_at"               =>   datetimeConverterVn($data[$i]["updated_at"]),
                "edited"                   =>   $edited,
                "deleted"                  =>   $deleted
            );
        }
    }
    return $result;
}
function invoiceConverter($data=array(),$controller){        
    $result = array();
    if( count($data) > 0){
        for($i = 0 ;$i < count($data);$i++){
            $edited='<center><a href="'.route('admin.'.$controller.'.getForm',['edit',$data[$i]['id']]).'"><img src="'.url("/public/admin/images/edit-icon.png").'" /></a></center>';
            $deleted='<center><a href="javascript:void(0)" onclick="deleteItem('.$data[$i]["id"].')"><img src="'.url("/public/admin/images/delete-icon.png").'" /></a></center>';
            $kicked=0;
            if((int)$data[$i]["status"]==1)
                $kicked=0;
            else
                $kicked=1;
            $status     = '<center>'.cmsStatus((int)$data[$i]["id"],(int)$data[$i]["status"],$kicked).'</center>';
            $sort_order = '<center><input name="sort_order" id="sort-order-'.$data[$i]["id"].'" sort_order_id="'.$data[$i]["id"].'" onkeyup="setSortOrder(this)" value="'.$data[$i]["sort_order"].'" size="3" style="text-align:center" /></center>';                
            $result[$i] = array(
                'checked'                  =>   '<input type="checkbox" onclick="checkWithList(this)" name="cid" value="'.$data[$i]["is_checked"].'" />',
                'is_checked'               =>   0,
                "id"                       =>   $data[$i]["id"],
                "code"                     =>   $data[$i]["code"],
                "username"                 =>   $data[$i]["username"],
                "email"                    =>   $data[$i]["email"],
                "fullname"                 =>   $data[$i]["fullname"],
                "address"                  =>   $data[$i]["address"],
                "phone"                    =>   $data[$i]["phone"],
                "mobilephone"              =>   $data[$i]["mobilephone"],
                "fax"                      =>   $data[$i]["fax"],
                "quantity"                 =>   $data[$i]["quantity"],
                "total_price"              =>   $data[$i]["total_price"],                
                "sort_order"               =>   $sort_order,
                "status"                   =>   $status,
                "created_at"               =>   datetimeConverterVn($data[$i]["created_at"]),
                "updated_at"               =>   datetimeConverterVn($data[$i]["updated_at"]),
                "edited"                   =>   $edited,
                "deleted"                  =>   $deleted
            );
        }
    }
    return $result;
}
function convertToArray($stdArray){
    $newArr=array();
    foreach($stdArray as $key => $value)
        $newArr[$key] = (array) $value;    
    return $newArr;
}
?>