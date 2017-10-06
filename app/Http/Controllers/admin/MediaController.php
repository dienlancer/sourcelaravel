<?php namespace App\Http\Controllers\admin;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class MediaController extends Controller {	
	var $_controller="media";	
  	var $_title="Media";
  	var $_icon="icon-settings font-dark";
	public function getList(){			
		$strDirUpload=base_path()."/resources/upload";
		$arrData = scandir($strDirUpload);		
		$controller=$this->_controller;	
		$task="list";
		$title=$this->_title;
		$icon=$this->_icon;		
		return view("admin.".$this->_controller.".list",compact("arrData","controller","task","title","icon"));
	}	

	public function getForm($task){		 
		$controller=$this->_controller;	
		$title=$this->_title . " : Thêm mới";
		$icon=$this->_icon; 				
		return view("admin.".$this->_controller.".form",compact("controller","task","title","icon"));
	}

	public function save(Request $request){		
		$data 		            =   array();
        $info 		            =   array();
        $error 		            =   array();
        $item		              =   null;
        $checked 	            =   1;  
		$strDirUpload=base_path()."/resources/upload";
		$lstFile=$_FILES["media_file"];		
		$arrName = $lstFile["name"];    
		$arrTmpName=$lstFile["tmp_name"];       
		$uploadDir    =$strDirUpload  ;		
		foreach ($arrName as $key => $value) {      
         	if(!empty($value)){
	          	$fileName   = $value;
	          	@copy($arrTmpName[$key], $uploadDir . DS . $fileName);  
        	}       
      	}
      	$info = array(
                  'type_msg' 			=> "has-success",
                  'msg' 				=> 'Save data successfully',
                  "checked" 			=> 1,
                  "error" 			=> $error,
                  "id"    			=> $id
                );
      	return $info;      	
	}
	
	public function trash(){			
		$arrPrivilege=getArrPrivilege();
		$requestControllerAction=$this->_controller."-trash";					
		if(in_array($requestControllerAction,$arrPrivilege)){
			$enabledThaoTac=true;
			$strMessage="";
			$strDirUpload=base_path()."/resources/upload"; 
			$arrID=@$_POST["cid"];
			if(empty($arrID)){
				$enabledThaoTac=false;		 	
			 	$strMessage="Xin chọn một phần tử để xóa";		 	
			}
			if($enabledThaoTac){				
				foreach ($arrID as $key => $value) {
				 	$pathFile=$strDirUpload.DS.$value;
				 	if(file_exists($pathFile)){
						unlink($pathFile);
					}	
		 		}
				return redirect()->route("admin.".$this->_controller.".getList")->with(["flash_message"=>array("class"=>"success","content"=>"Đã xóa")]);		 
			}
			else{
				$strMessage= "<script type='text/javascript' language='javascript'>
					alert('".$strMessage."');			
					window.location='".route("admin.".$this->_controller.".getList")."'
					</script>";
				echo $strMessage;
			}
		}	 				
	}
	/*public function trash(Request $request){
            $str_id                 =   $request->str_id;   
            $checked                =   1;
            $type_msg               =   "alert-success";
            $msg                    =   "Delete successfully";      
            $arrID                  =   explode(",", $str_id)  ;        
            if(empty($str_id)){
              $checked     =   0;
              $type_msg           =   "alert-warning";            
              $msg                =   "Please choose at least one item to delete";
            }
            if($checked == 1){                
                  $strID = implode(',',$arrID);   
                  $strID=substr($strID, 0,strlen($strID) - 1);
                  $sqlDeleteModuleArticle = "DELETE FROM `module_article` WHERE `id` IN  (".$strID.")";       
                  $sqlDeleteModMenuType = "DELETE FROM `mod_menu_type` WHERE `module_id` IN (".$strID.") and `module_type` = '".trim(mb_strtolower($this->_controller,'UTF-8'))."' ";                
                  DB::statement($sqlDeleteModuleArticle);
                  DB::statement($sqlDeleteModMenuType);           
            }
            $data                   =   $this->loadData($request);
            $info = array(
              'checked'           => $checked,
              'type_msg'          => $type_msg,                
              'msg'               => $msg,                
              'data'              => $data
            );
            return $info;
      }*/
	public function deleteItem(Request $request){
		/* begin phân quyền */
		$arrPrivilege=getArrPrivilege();
		$requestControllerAction=$this->_controller."-delete";			
		/* end phân quyền */			
		if(in_array($requestControllerAction,$arrPrivilege)){
			$strDirUpload=base_path()."/resources/upload";
			$pathFile=$strDirUpload.DS.$name;
			$co_file=false; 
			if(file_exists($pathFile)){
				unlink($pathFile);
			}		
			return redirect()->route("admin.".$this->_controller.".getList")->with(["flash_message"=>array("class"=>"success","content"=>"Đã xóa file ".$name)]);	
		}
		else{
			return view("admin.".$this->_pageAccessDenied);
		}				
	}
}

