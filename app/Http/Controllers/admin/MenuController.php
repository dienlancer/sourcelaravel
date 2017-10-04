<?php namespace App\Http\Controllers\admin;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MenuRequest;
use App\MenuModel;
use App\ProductModel;
use App\MenuTypeModel;
use App\ModMenuTypeModel;
use DB;
class MenuController extends Controller {
    	var $_controller="menu";	
    	var $_title="Menu";
    	var $_icon="icon-settings font-dark";
    	public function getList(Request $request){		
      		$controller=$this->_controller;	
      		$task="list";
      		$title=$this->_title;
      		$icon=$this->_icon;		
          $menu_type_id=$request->menu_type_id;
      		return view("admin.".$this->_controller.".list",compact("controller","task","title","icon","menu_type_id"));	
    	}	
    	public function loadData(Request $request){
      		$filter_search="";
          $menu_type_id=(int)($request->menu_type_id);
      		$data=DB::select('call pro_getMenu(?,?)',array($filter_search,$menu_type_id));
      		$parent_id=0;
      		$MenuRecursiveData=array();
      		if(count($data) >0)
      			$parent_id=$data[0]->parent_id;	
      		$data=convertToArray($data);    
          $data=menuConverter($data,$this->_controller);   
      		menuRecursive($data,$parent_id,null,$MenuRecursiveData);  
          $data=      	convertToArray($MenuRecursiveData)	;         
          return $data;
    	}
    	public function loadDataApi(Request $request){
      		$filter_search="";
          $data=DB::select('call pro_getMenu(?)',array($filter_search));
          $parent_id=0;
          $MenuRecursiveData=array();
          if(count($data) >0)
              $parent_id=$data[0]->parent_id; 
          $data=convertToArray($data);
          MenuRecursive($data,$parent_id,null,$MenuRecursiveData);        
          $data=MenuConverter($MenuRecursiveData,$this->_controller);                               
          return $data;
      }
      public function getForm($task,$menu_type_id="",$id=""){   
            $controller=$this->_controller;			
            $title="";
            $icon=$this->_icon; 
            $arrRowData=array();
            switch ($task) {
               case 'edit':
                  $title=$this->_title . " : Update";
                  $arrRowData=MenuModel::find($id)->toArray();			 
               break;
               case 'add':
                  $title=$this->_title . " : Add new";
               break;			
           }		
            $arrMenu=MenuModel::select("id","fullname","site_link","alias","parent_id","menu_type_id","level","sort_order","status","created_at","updated_at")->where("menu_type_id","=",(int)@$menu_type_id)->where("id","!=",(int)$id)->orderBy("sort_order","asc")->get()->toArray();
            $arrMenuRecursive=array();
            menuRecursiveForm($arrMenu ,0,"",$arrMenuRecursive)  ;
            $arrMenuType=MenuTypeModel::select("id","fullname","sort_order","created_at","updated_at")->orderBy("sort_order","asc")->get()->toArray();      
            return view("admin.".$this->_controller.".form",compact("arrMenuRecursive","arrMenuType","arrRowData","menu_type_id","controller","task","title","icon"));	        
      }
      public function save(Request $request){
            $id 					       =	  trim($request->id)	;        
            $fullname 				   =	  trim($request->fullname)	;
            $alias 					     = 		trim($request->alias);
            $site_link           =    trim($request->site_link);
            $parent_id	         =		(int)$request->parent_id;
            $menu_type_id        =    (int)$request->menu_type_id;      
            $sort_order 			   =		(int)($request->sort_order);
            $status 				     =		(int)($request->status);          
            $data 		           =    array();
            $info 		           =    array();
            $error 		           =    array();
            $item		             =    null;
            $checked 	           =    1;              
            if(empty($fullname)){
                $checked = 0;
                $error["fullname"]["type_msg"] = "has-error";
                $error["fullname"]["msg"] = "Fullname is required";
            }else{
                $data=array();
                if (empty($id)) {
                  $data=MenuModel::whereRaw("trim(lower(fullname)) = ? and menu_type_id = ?",[trim(mb_strtolower($fullname,'UTF-8')),(int)@$menu_type_id])->get();	        	
                }else{
                  $data=MenuModel::whereRaw("trim(lower(fullname)) = ? and id != ? and menu_type_id = ?",[trim(mb_strtolower($fullname,'UTF-8')),$id,(int)@$menu_type_id])->get();		
                }  
                if (count($data) > 0) {
                  $checked = 0;
                  $error["fullname"]["type_msg"] = "has-error";
                  $error["fullname"]["msg"] = "Fullname is existed in system";
                }      	
            }
            if(empty($alias)){
                 $checked = 0;
                 $error["alias"]["type_msg"] = "has-error";
                 $error["alias"]["msg"] = "Alias is required";
            }else{
                $data=array();
                if (empty($id)) {
                  $data=MenuModel::whereRaw("trim(lower(alias)) = ? and menu_type_id = ?",[trim(mb_strtolower($alias,'UTF-8')),(int)@$menu_type_id])->get();	        	
                }else{
                  $data=MenuModel::whereRaw("trim(lower(alias)) = ? and id != ? and menu_type_id = ?",[trim(mb_strtolower($alias,'UTF-8')),$id,(int)@$menu_type_id])->get();		
                }  
                if (count($data) > 0) {
                  $checked = 0;
                  $error["alias"]["type_msg"] 	= "has-error";
                  $error["alias"]["msg"] 			= "Alias is existed in system";
                }      	
            }
            if(empty($site_link)){
                $checked = 0;
                $error["site_link"]["type_msg"] = "has-error";
                $error["site_link"]["msg"] = "Sitelink is required";
            }else{
                $data=array();
                if (empty($id)) {
                  $data=MenuModel::whereRaw("trim(lower(site_link)) = ? and menu_type_id = ?",[trim(mb_strtolower($site_link,'UTF-8')),@$menu_type_id])->get();            
                }else{
                  $data=MenuModel::whereRaw("trim(lower(site_link)) = ? and id != ? and menu_type_id = ?",[trim(mb_strtolower($site_link,'UTF-8')),$id,@$menu_type_id])->get();    
                }  
                if (count($data) > 0) {
                  $checked = 0;
                  $error["site_link"]["type_msg"] = "has-error";
                  $error["site_link"]["msg"] = "Sitelink is existed in system";
                }       
            }
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
            if ($checked == 1) {    
                if(empty($id)){
                    $item 				= 	new MenuModel;       
                    $item->created_at 	=	date("Y-m-d H:i:s",time());                          
                } else{
                    $item				=	MenuModel::find($id);                     	  		 
                }  
                $item->fullname 		=	$fullname;
                $item->alias 			  =	$alias;
                $item->site_link    = $site_link;               
                $item->parent_id 		=	$parent_id;
                $item->menu_type_id = $menu_type_id;
                $level=0;              
                $parent=MenuModel::find($parent_id); 
                if(count($parent) > 0){
                  $level=(int)$parent->toArray()["level"]+1;                
                }                     
                $item->level=$level;            
                $item->sort_order 		=	$sort_order;
                $item->status 			=	$status;    
                $item->updated_at 		=	date("Y-m-d H:i:s",time());    	        	
                $item->save();  	
                $info = array(
                  'type_msg' 			=> "has-success",
                  'msg' 				=> 'Save data successfully',
                  "checked" 			=> 1,
                  "error" 			=> $error,
                  "id"    			=> $id,
                );
            } else {
                  $info = array(
                    'type_msg' 			=> "has-error",
                    'msg' 				=> 'Input data has some warning',
                    "checked" 			=> 0,
                    "error" 			=> $error,
                    "id"				=> "",
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
          $item           =       MenuModel::find($id);        
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
            $menu_type_id           =   0;                
            $count                  =   MenuModel::where("parent_id",$id)->count();
            $item                   =   MenuModel::find($id);
            $menu_type_id           =   $item->toArray()["menu_type_id"];
            if($count > 0){
                $checked            =   0;
                $type_msg           =   "alert-warning";            
                $msg                =   "Cannot delete this item";            
            }          
            if($checked == 1){
                $item               =   MenuModel::find($id);
                $item->delete();            
                ModMenuTypeModel::whereRaw("menu_id = ?",[(int)$id])->delete();
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
        $str_id                     =   $request->str_id;   
        $status                     =   $request->status;  
        $arrID                      =   explode(",", $str_id)  ;
        $checked                    =   1;
        $type_msg                   =   "alert-success";
        $msg                        =   "Update successfully";   
        if(empty($str_id)){
            $checked                =   0;
            $type_msg               =   "alert-warning";            
            $msg                    =   "Please choose at least one item to delete";
        }
        if($checked==1){
          foreach ($arrID as $key => $value) {
            if(!empty($value)){
              $item=MenuModel::find($value);
              $item->status=$status;
              $item->save();      
            }            
          }
        }         
        $data                       =   $this->loadData($request);
        $info = array(
          'checked'                 => $checked,
          'type_msg'                => $type_msg,                
          'msg'                     => $msg,                
          'data'                    => $data
        );
        return $info;
    }
    public function trash(Request $request){
        $str_id                     =   $request->str_id;           
        $checked                    =   1;
        $type_msg                   =   "alert-success";
        $msg                        =   "Delete successfully";      
        $arrID                      =   explode(",", $str_id)  ;    
        if(empty($str_id)){
            $checked                =   0;
            $type_msg               =   "alert-warning";            
            $msg                    =   "Please choose at least one item to delete";
        }else{          
            foreach ($arrID as $key => $value) {
              if(!empty($value)){
                  $item=MenuModel::find((int)$value);                 
                  $count = MenuModel::where("parent_id",(int)$value)->count();
                  if($count > 0){
                    $checked            =   0;
                    $type_msg           =   "alert-warning";            
                    $msg                =   "Cannot delete this item"; 
                  }
              }                
            }
        }
        if($checked == 1){                
            $strID = implode(',',$arrID);   
            $strID=substr($strID, 0,strlen($strID) - 1);
            $sqlDeleteMenu = "DELETE FROM `menu` WHERE `id` IN ($strID)";       
            $sqlDeleteModMenuType = "DELETE FROM `mod_menu_type` WHERE `menu_id` IN ($strID)";        
            DB::statement($sqlDeleteMenu);
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
    }
    public function sortOrder(Request $request){
        $sort_json              =   $request->sort_json;           
        $data_order             =   json_decode($sort_json);       
        $checked                =   1;
        $type_msg               =   "alert-success";
        $msg                    =   "Update successfully";      
        if(count($data_order) > 0){              
          foreach($data_order as $key => $value){                                        
            $item=MenuModel::find((int)$value->id);                
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
}
?>
