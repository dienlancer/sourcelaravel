<?php 
function uploadImage($fileObj,$width,$height,$statusResize){        
    require_once base_path()."/app/scripts/PhpThumb/ThumbLib.inc.php";    
    $uploadDir = base_path()."/resources/upload";         
    $fileName="";
    if($fileObj['tmp_name'] != null){                
        $fileName   = $fileObj['name'];
        @copy($fileObj['tmp_name'], $uploadDir . "/" . $fileName);       
        if($statusResize == 1){
          $thumb = PhpThumbFactory::create($uploadDir . "/" . $fileName);        
          $thumb->adaptiveResize($width, $height);
          $prefix = $width . 'x' . $height . '-';
          $veston = $uploadDir . "/" . $prefix  . $fileName;       
          $thumb->save($veston);
        } 
    }   
}
?>