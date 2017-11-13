<?php 
use App\SettingSystemModel;
use App\MenuModel;
use App\MenuTypeModel;
function uploadImage($fileObj,$width,$height){        
  require_once base_path() . DS ."app".DS."scripts".DS."PhpThumb".DS."ThumbLib.inc.php";    
  $uploadDir = base_path() . DS ."resources".DS."upload";                    
  $fileName="";
  if($fileObj['tmp_name'] != null){                
    $fileName   = $fileObj['name'];
    @copy($fileObj['tmp_name'], $uploadDir . DS . $fileName);       
    $thumb = PhpThumbFactory::create($uploadDir . DS . $fileName);        
    $thumb->adaptiveResize($width, $height);
    $prefix = $width . 'x' . $height . '-';
    $veston = $uploadDir . DS . $prefix  . $fileName;       
    $thumb->save($veston);
  }   
}
function getSettingSystem(){        
    $alias='setting-system';
    $dataSettingSystem                   =   SettingSystemModel::whereRaw("trim(lower(alias)) = ?",[trim(mb_strtolower(@$alias))])->get()->toArray(); 
    return $dataSettingSystem[0];     
}
function wp_nav_menu($args){
    $menu_type_alias=$args['theme_location'];
    $data_menu_type=MenuTypeModel::whereRaw("trim(lower(alias)) = ?",[trim(mb_strtolower($menu_type_alias))])->select('id')->get()->toArray()[0];
    $data_menu=MenuModel::whereRaw('menu_type_id = ?',[(int)@$data_menu_type['id']])->orderBy('sort_order','asc')->get()->toArray();    
    $arr_menu=array();  
    if(count($data_menu) > 0){
        for ($i=0;$i<count($data_menu);$i++) {
            $menu=array();
            $menu=$data_menu[$i];
            $site_link='';
            if(!empty( $data_menu[$i]["site_link"] )){
              $site_link=$data_menu[$i]["site_link"].".html";
            }
            $menu["site_link"] =$site_link;            
            $data_child=MenuModel::whereRaw('parent_id = ?',[(int)$data_menu[$i]["id"]])->select('id')->get()->toArray();
            if(count($data_child) > 0){
              $menu["havechild"]=1;
            }else{
              $menu["havechild"]=0;
            }
            $arr_menu[]=$menu;
        }
    }
    $menu_str              =  "";      
    $lanDau                =  0;    
    mooMenuRecursive($arr_menu,0,$menu_str,$lanDau,url('/'),$args['alias'],$args['menu_id'],$args['menu_class'],$args['menu_li_actived'],$args['menu_item_has_children']);
    $menu_str = str_replace('<ul></ul>', '', $menu_str);
    echo $menu_str;
}
function mooMenuRecursive($source,$parent,&$menu_str,&$lanDau,$url,$alias,$menu_id,$menu_class,$menu_li_actived,$menu_item_has_children){
    if(count($source) > 0){          
            $menu_str .='<ul>';
            if($lanDau == 0){
                  $menu_str ='<ul id="'.$menu_id.'" class="'.$menu_class.'"  >';
            }                          
            foreach ($source as $key => $value) 
            {                  
                    if((int)$value["parent_id"]==(int)$parent)
                    {
                          $link=$url.$value["site_link"];
                          $class_activated=0;                          
                          if( strcmp(trim(mb_strtolower($value["alias"])),trim(mb_strtolower($alias)))   ==  0 ){
                              $class_activated=1;                              
                          }
                          $menuName='';
                          if($class_activated==1){
                              $menuName = '<a href="'.$link.'" class="active" >' . $value["fullname"] . '</a>';
                          }else{
                              $menuName = '<a href="'.$link.'"  >' . $value["fullname"] . '</a>';
                          }                                                    
                          if((int)$value["havechild"]==1){
                              $li='';
                              if($class_activated==1){
                                  $li='<li class="'.$menu_item_has_children.' '.$menu_li_actived.'"  >'.$menuName;
                              }else{
                                  $li='<li class="'.$menu_item_has_children.'"  >'.$menuName;
                              }
                              $menu_str .=$li;                                
                          }
                          else{
                              $li='';
                              if($class_activated==1){
                                  $li='<li class="'.$menu_li_actived.'"  >'.$menuName;
                              }else{
                                  $li='<li   >'.$menuName;
                              }
                              $menu_str .=$li;                                
                          }              
                          unset($source[$key]);
                          $newParent=$value["id"];
                          $lanDau =$lanDau+1;
                          mooMenuRecursive($source,$newParent,$menu_str,$lanDau,$url,$alias,$menu_id,$menu_class,$menu_li_actived,$menu_item_has_children);
                          $menu_str .='</li>';
                    }
            }
            $menu_str .='</ul>'; 
    }
}
?>