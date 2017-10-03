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
            $sort_order = '<input name="sort_order" id="'.$data[$i]["id"].'" onkeyup="setSortOrder(this)" value="'.$data[$i]["sort_order"].'" size="3" style="text-align:center" />';
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
            $sort_order = '<input name="sort_order" id="'.$data[$i]["id"].'" onkeyup="setSortOrder(this)" value="'.$data[$i]["sort_order"].'" size="3" style="text-align:center" />';
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
            $sort_order = '<input name="sort_order" id="'.$data[$i]["id"].'" onkeyup="setSortOrder(this)" value="'.$data[$i]["sort_order"].'" size="3" style="text-align:center" />';            
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
function convertToArray($stdArray){
    $newArr=array();
    foreach($stdArray as $key => $value)
        $newArr[$key] = (array) $value;    
    return $newArr;
}
?>