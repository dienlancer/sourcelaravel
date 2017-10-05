<?php namespace App\Http\Controllers\admin;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MenuTypeModel;
use App\MenuModel;
use DB;
class MenuTypeController extends Controller {
  	var $_controller="menu-type";	
  	var $_title="Menu Type";
  	var $_icon="icon-settings font-dark";
  	public function getList(){		
    		$controller=$this->_controller;	
    		$task="list";
    		$title=$this->_title;
    		$icon=$this->_icon;		
    		return view("admin.".$this->_controller.".list",compact("controller","task","title","icon"));	
  	}	
  	public function loadData(Request $request){
        $filter_search="";        
        $data=DB::select('call pro_getMenuType(?)',array($filter_search));    
        $data=convertToArray($data);    
        $data=menuTypeConverter($data,$this->_controller);           
        return $data;
    }
    public function getForm($task,$id=""){		 
        $controller=$this->_controller;			
        $title="";
        $icon=$this->_icon; 
        $arrRowData=array();
        switch ($task) {
            case 'edit':
                $title=$this->_title . " : Update";
                $arrRowData=MenuTypeModel::find($id)->toArray();			 
              break;
            case 'add':
                $title=$this->_title . " : Add new";
              break;			
       }		   
       return view("admin.".$this->_controller.".form",compact("arrRowData","controller","task","title","icon"));
    }
    public function save(Request $request){
        $id 					=	trim($request->id)	;        
        $fullname 				=	trim($request->fullname)	;  
        $sort_order 			=		trim($request->sort_order);
        $data 		= array();
        $info 		= array();
        $error 		= array();
        $item		= null;
        $checked 	= 1;              
        if(empty($fullname)){
            $checked = 0;
            $error["fullname"]["type_msg"] = "has-error";
            $error["fullname"]["msg"] = "Fullname is required";
        }else{
            $data=array();
            if (empty($id)) {
                $data=MenuTypeModel::whereRaw("trim(lower(fullname)) = ?",[trim(mb_strtolower($fullname,'UTF-8'))])->get()->toArray();	        	
            }else{
              $data=MenuTypeModel::whereRaw("trim(lower(fullname)) = ? and id != ?",[trim(mb_strtolower($fullname,'UTF-8')),$id])->get()->toArray();		
            }  
            if (count($data) > 0) {
              $checked = 0;
              $error["fullname"]["type_msg"] = "has-error";
              $error["fullname"]["msg"] = "Fullname is existed in system";
            }      	
        }
        if(empty($sort_order)){
             $checked = 0;
             $error["sort_order"]["type_msg"] 	= "has-error";
             $error["sort_order"]["msg"] 		= "Sort order is required";
        }
        if($checked == 1) {    
             if(empty($id)){
                $item 				= 	new MenuTypeModel;       
                $item->created_at 	=	date("Y-m-d H:i:s",time());        
                if(!empty($image)){
                  $item->image    =   trim($image) ;  
                }				
              }else{
                    $item				=	MenuTypeModel::find($id);     	  		 
              }  
              $item->fullname 		=	$fullname;
              $item->sort_order 		=	$sort_order;  
              $item->updated_at 		=	date("Y-m-d H:i:s",time());    	        	
              $item->save();  	
              $info = array(
                'type_msg' 			=> "has-success",
                'msg' 				=> 'Save data successfully',
                "checked" 			=> 1,
                "error" 			=> $error,
                "id"    			=> $id
              );
        } else {
              $info = array(
                'type_msg' 			=> "has-error",
                'msg' 				=> 'Input data has some warning',
                "checked" 			=> 0,
                "error" 			=> $error,
                "id"				=> ""
              );
        }        		 			       
        return $info;       
    }
    public function changeStatus(Request $request){
        $id             =       (int)$request->id;     
        $checked                =   1;
        $type_msg               =   "alert-success";
        $msg                    =   "Update successfully";              
        $status         =       (int)$request->status;
        $item           =       MenuTypeModel::find($id);        
        $item->status   =       $status;
        $item->save();
        $data                   =   $this->loadData($request);
        $info = array(
          'checked'           => $checked,
          'type_msg'          => $type_msg,                
          'msg'               => $msg,                
          'data'              => $data
        );
        return $info;
    }
    public function deleteItem(Request $request){
          $id                     =   (int)$request->id;              
          $checked                =   1;
          $type_msg               =   "alert-success";
          $msg                    =   "Delete successfully";            
          $count = MenuModel::where("menu_type_id",(int)($id))->count();
          if($count > 0){
            $checked     =   0;
            $type_msg           =   "alert-warning";            
            $msg                =   "Cannot delete this item";            
          }  
          if($checked == 1){
            $item               =   MenuTypeModel::find($id);
            $item->delete();            
          }        
          $data                   =   $this->loadData($request);
          $info = array(
            'checked'           => $checked,
            'type_msg'          => $type_msg,                
            'msg'               => $msg,                
            'data'              => $data
          );
          return $info;
    }
    public function updateStatus(Request $request){
          $str_id                 =   $request->str_id;   
          $status                 =   $request->status;  
          $arrID                 =   explode(",", $str_id)  ;
          $checked                =   1;
          $type_msg               =   "alert-success";
          $msg                    =   "Update successfully";     
          if(empty($str_id)){
                    $checked                =   0;
                    $type_msg               =   "alert-warning";            
                    $msg                    =   "Please choose at least one item to delete";
                }
          if($checked==1){
              foreach ($arrID as $key => $value) {
                  if(!empty($value)){
                    $item=MenuTypeModel::find($value);
                    $item->status=$status;
                    $item->save();      
                  }            
              }
          }           
          $data                   =   $this->loadData($request);
          $info = array(
            'checked'           => $checked,
            'type_msg'          => $type_msg,                
            'msg'               => $msg,                
            'data'              => $data
          );
          return $info;
    }
    public function trash(Request $request){
          $str_id                 =   $request->str_id;   
          $checked                =   1;
          $type_msg               =   "alert-success";
          $msg                    =   "Delete successfully";      
          $arrID                  =   explode(",", $str_id)  ;    
          if(empty($str_id)){
            $checked     =   0;
            $type_msg           =   "alert-warning";            
            $msg                =   "Please choose at least one item to delete";
          }else{
            foreach ($arrID as $key => $value) {        
                  $count = MenuModel::where("menu_type_id",$value)->count();
                  if($count > 0){
                      $checked     =   0;
                      $type_msg           =   "alert-warning";            
                      $msg                =   "Cannot delete this item";
                  }
              }    
          }
          if($checked == 1){                
              $strID = implode(',',$arrID);       
              $strID = substr($strID, 0,strlen($strID) - 1);            
              $sql = "DELETE FROM `menu_type` WHERE `id` IN (".$strID.")";                                 
              DB::statement($sql);    
          }
          $data                   =   $this->loadData($request);
          $info = array(
            'checked'           => $checked,
            'type_msg'          => $type_msg,                
            'msg'               => $msg,                
            'data'              => $data
          );
          return $info;
    }
    public function sortOrder(Request $request){
          $sort_json              =   $request->sort_json;           
          $data_order             =   json_decode($sort_json);       
          $checked                =   1;
          $type_msg               =   "alert-success";
          $msg                    =   "Update successfully";      
          if(count($data_order) > 0){              
            foreach($data_order as $key => $value){                                        
              $item=MenuTypeModel::find((int)$value->id);                
              $item->sort_order=(int)$value->sort_order;                         
              $item->save();                      
            }           
          }        
          $data                   =   $this->loadData($request);
          $info = array(
            'checked'           => $checked,
            'type_msg'          => $type_msg,                
            'msg'               => $msg,                
            'data'              => $data
          );
          return $info;
    }
    public function uploadFile(Request $request){           
      uploadImage($_FILES["image"],WIDTH,HEIGHT,1);
    }
}
?>
