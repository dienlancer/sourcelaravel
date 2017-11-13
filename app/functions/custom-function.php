<?php 
use App\SettingSystemModel;
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
function wp_nav_menu($args=array()){

}
function mooMenuRecursive($source, $parent, &$newString, &$lanDau,$url,$alias,$menu_id,$menu_class){    
    if(!count($source) > 0){
          $newString .='<ul>';
          if($lanDau == 0){
                $newString ='<ul id="'.$menu_id.'" class="'.$menu_class.'">';
          }                              
          foreach ($source as $key => $value) 
          {
                  if((int)$value["parent_id"]==(int)$parent)
                  {
                        $link=$url.$value["site_link"];
                        $class_active=0;
                        if(trim(mb_strtolower($value["alias"]))  == trim(mb_strtolower($alias))  ){
                            $class_active=1;
                        }
                        $menuName = '<a href="'.$link.'"   ><span>' . $value["name"] . '</span></a>';              
                        if((int)$value["havechild"]==1){
                            $level=(int)$value["level"];
                            switch ($level) {
                              case 0:  
                                  $newString .='<li class="havechild">'.$menuName;                
                                  break;
                              default:
                                  $newString .='<li class="havesubchild">'.$menuName;                    
                                  break;
                            }  
                        }
                        else{
                              $newString .='<li>'.$menuName;                
                        }              
                        unset($source[$key]);
                        $newParent=$value["id"];
                        $lanDau =$lanDau+1;
                        mooMenuRecursive($source, $newParent, $newString, $lanDau,$url,$alias);
                        $newString .='</li>';
                  }
          }
          $newString .='</ul>'; 
    }
}
?>