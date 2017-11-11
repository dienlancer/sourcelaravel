<?php namespace App\Http\Controllers\admin;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CustomerModel;
use DB;
use Hash;
class CustomerController extends Controller {
  	var $_controller="customer";	
  	var $_title="Customer";
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
        if(!empty(@$request->filter_search)){      
          $filter_search=trim(@$request->filter_search) ;    
        }
    		$data=DB::select('call pro_getCustomer(?)',array(mb_strtolower($filter_search)));
    		$data=convertToArray($data);		
    		$data=customerConverter($data,$this->_controller);		    
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
              $arrRowData=CustomerModel::find((int)@$id)->toArray();                     
           break;
           case 'add':
              $title=$this->_title . " : Add new";
           break;     
        }    
        return view("admin.".$this->_controller.".form",compact("arrRowData","controller","task","title","icon"));
    }
     public function save(Request $request){
          $id 					        =		trim($request->id);       
          $password             =   trim(@$request->password);
          $confirmed_password   =   trim(@$request->confirmed_password);    

          $sort_order           =   trim($request->sort_order);
          $status               =   trim($request->status);              
          $data 		            =   array();
          $info 		            =   array();
          $error 		            =   array();
          $item		              =   null;
          $checked 	            =   1;                        
          if(empty($sort_order)){
             $checked = 0;
             $error["sort_order"]["type_msg"] 	= "has-error";
             $error["sort_order"]["msg"] 		= "Sort order is required";
          }
          if((int)$status==-1){
             $checked = 0;
             $error["status"]["type_msg"] 		= "has-error";
             $error["status"]["msg"] 			= "Status is required";
          }
          $password         = trim(mb_strtolower($password));
          $confirmed_password = trim(mb_strtolower($confirmed_password));
          if(empty($id)){
              if(mb_strlen($password) < 6 ){
                  $checked = 0;
                  $error["password"]["type_msg"] = "has-error";
                  $error["password"]["msg"] = "Password at least six character";
              }else{
                  if(strcmp($password, $confirmed_password) !=0 ){
                    $checked = 0;
                    $error["password"]["type_msg"] = "has-error";
                    $error["password"]["msg"] = "Password and confirm password do not matched";
                  }
              }     
          }else{
              if(!empty($password) || !empty($confirmed_password)){
                  if(mb_strlen($password) < 6 ){
                    $checked = 0;
                    $error["password"]["type_msg"] = "has-error";
                    $error["password"]["msg"] = "Password at least six character";
                  }else{
                      if(strcmp($password, $confirmed_password) !=0 ){
                        $checked = 0;
                        $error["password"]["type_msg"] = "has-error";
                        $error["password"]["msg"] = "Password and confirm password do not matched";
                      }
                  }        
              }     
          }
          if ($checked == 1) {    
                if(empty($id)){
                    $item 				= 	new CustomerModel;       
                    $item->created_at 	=	date("Y-m-d H:i:s",time());                            	
                } else{
                    $item				=	CustomerModel::find((int)@$id);                               		  		 	
                }        
                if(!empty($password)){
                  $item->password         = md5(trim($password));
                }                      
                $item->sort_order 		  =	(int)@$sort_order;
                $item->status 			    =	(int)@$status;    
                $item->updated_at 		  =	date("Y-m-d H:i:s",time());    	        	
                $item->save();  	                
                $info = array(
                  'type_msg' 			=> "has-success",
                  'msg' 				=> 'Save data successfully',
                  "checked" 			=> 1,
                  "error" 			=> $error,
                  "id"    			=> $id
                );
            }else {
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
                  $item           =       CustomerModel::find((int)@$id);        
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
            $id                     =   (int)@$request->id;              
            $checked                =   1;
            $type_msg               =   "alert-success";
            $msg                    =   "Delete successfully";                    
            if($checked == 1){
                $item = CustomerModel::find((int)@$id);
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
                    $item=CustomerModel::find($value);
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
            }
            if($checked == 1){                
                  $strID = implode(',',$arrID);   
                  $strID=substr($strID, 0,strlen($strID) - 1);
                  $sql = "DELETE FROM `customer` WHERE `id` IN  (".$strID.")";                                 
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
                if(!empty($value)){
                  $item=CustomerModel::find((int)@$value->id);                
                $item->sort_order=(int)$value->sort_order;                         
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
      public function uploadFile(Request $request){           
        uploadImage($_FILES["image"],WIDTH,HEIGHT);
      }
}
?>
