<?php namespace App\Http\Controllers\admin;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MenuModel;
use App\ProductModel;
use App\MenuTypeModel;
use App\ModMenuTypeModel;
use App\PaginationModel;
use DB;
class MenuController extends Controller {
    	var $_controller="menu"; 
      var $_title="Menu";
      var $_icon="icon-settings font-dark";
      var $_totalItemsPerPage=9999;    
      var $_pageRange=10;
    	public function getList($menu_type_id=0){   
        $controller=$this->_controller; 
        $task="list";
        $title=$this->_title;
        $icon=$this->_icon; 
        $currentPage=1;   
        $filter_search="";
        if(!empty(@$_POST["filter_search"])){
          $filter_search=@$_POST["filter_search"];        
        }        
        $data=DB::select('call pro_getMenu(?,?)',array(mb_strtolower($filter_search),(int)@$menu_type_id));
        $totalItems=count($data);
        $totalItemsPerPage=$this->_totalItemsPerPage;       
        $pageRange=$this->_pageRange;
        if(!empty(@$_POST["filter_page"])){
          $currentPage=(int)@$_POST["filter_page"];    
        }            
        $arrPagination=array(
          "totalItems"=>$totalItems,
          "totalItemsPerPage"=>$totalItemsPerPage,
          "pageRange"=>$pageRange,
          "currentPage"=>$currentPage 
        );
        $pagination=new PaginationModel($arrPagination);
        $position = (@$arrPagination['currentPage']-1)*$totalItemsPerPage;
        $data=array();
        if($totalItemsPerPage > 0){
            $data=DB::select('call pro_getMenuLimit(?,?,?,?)',array($filter_search,$position,$totalItemsPerPage,(int)@$menu_type_id));
        }        
        $data=convertToArray($data);
        $data=menuConverter($data,$this->_controller);   
        $data_recursive=array();
        menuRecursive($data,0,null,$data_recursive);          
        $data=$data_recursive; 
        return view("admin.".$this->_controller.".list",compact("controller","task","title","icon",'data','pagination','filter_search','menu_type_id')); 
      } 	
      public function getForm($task,$menu_type_id="",$id="",$component,$alias){   
            $controller=$this->_controller;			
            $title="";
            $icon=$this->_icon; 
            $arrRowData=array();
            switch ($task) {
               case 'edit':
                  $title=$this->_title . " : Update";
                  $arrRowData=MenuModel::find((int)@$id)->toArray();			 
               break;
               case 'add':
                  $title=$this->_title . " : Add new";
               break;			
           }		
            $arrMenu=MenuModel::select("id","fullname","site_link","alias","parent_id","menu_type_id","level","sort_order","status","created_at","updated_at")->where("menu_type_id","=",(int)@$menu_type_id)->where("id","!=",(int)$id)->orderBy("sort_order","asc")->get()->toArray();
            $arrMenuRecursive=array();
            menuRecursiveForm($arrMenu ,0,"",$arrMenuRecursive)  ;
            $arrMenuType=MenuTypeModel::select("id","fullname","sort_order","created_at","updated_at")->orderBy("sort_order","asc")->get()->toArray();
            $site_link='/'.$component.'/'.$alias;      
            return view("admin.".$this->_controller.".form",compact("arrMenuRecursive","arrMenuType","arrRowData","menu_type_id","controller","task","title","icon","site_link","alias"));	        
      }
      public function save(Request $request){
            $id 					       =	  trim($request->id)	;        
            $fullname 				   =	  trim($request->fullname)	;
            $alias               =    trim($request->alias);
            $site_link           =    trim($request->site_link);
            $parent_id	         =		trim($request->parent_id);
            $menu_type_id        =    trim($request->menu_type_id);      
            $sort_order 			   =		trim($request->sort_order);
            $status 				     =		trim($request->status);          
            $data 		           =    array();
            $info 		           =    array();
            $error 		           =    array();
            $item		             =    null;
            $checked 	           =    1;                          
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
                    $item 				      = 	new MenuModel;       
                    $item->created_at 	=	date("Y-m-d H:i:s",time());                          
                } else{
                    $item				         =	MenuModel::find((int)@$id);                     	  		 
                }  
                $item->fullname 		     = $fullname;
                $item->alias             = $alias;
                $item->site_link         = $site_link;               
                $item->parent_id 		     = (int)$parent_id;
                $item->menu_type_id      = (int)$menu_type_id;
                $level                   = 0;              
                $parent=MenuModel::find($parent_id); 
                if(count($parent) > 0){
                    $level=(int)$parent->toArray()["level"]+1;                
                }                     
                $item->level             =  (int)$level;            
                $item->sort_order 	     =	(int)$sort_order;
                $item->status 			     =  (int)$status;    
                $item->updated_at 	=	date("Y-m-d H:i:s",time());    	        	
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
            $status         =       (int)$request->status;
            
            $item=MenuModel::find($id);
            $trangThai=0;
            if($status==0){
              $trangThai=1;
            }
            else{
              $trangThai=0;
            }
            $item->status=$status;
            $item->save();
            $result = array(
                        'id'      => $id, 
                        'status'  => $status, 
                        'link'    => 'javascript:changeStatus('.$id.','.$trangThai.');'
                    );
            return $result;   
      }
      public function deleteItem($id){
            $checked                =   1;
            $type_msg               =   "alert-success";
            $msg                    =   "Delete successfully";        
            $menu_type_id           =   0;        
            $data                   =   MenuModel::whereRaw("parent_id = ?",[(int)@$id])->get()->toArray();                    
            $item                   =   MenuModel::find((int)@$id);
            $menu_type_id           =   $item->toArray()["menu_type_id"];
            if(count($data) > 0){
                $checked     =   0;
                $type_msg           =   "alert-warning";            
                $msg                =   "Cannot delete this item";      
            }          
            if($checked == 1){
                $item               =   MenuModel::find((int)@$id);
                $item->delete();            
                ModMenuTypeModel::whereRaw("menu_id = ?",[(int)@$id])->delete();
            }        
            return redirect()->route("admin.".$this->_controller.".getList",[(int)@$menu_type_id])->with(["message"=>array("content"=>"Đã lưu")]); 
      }
      public function updateStatus(Request $request,$status){        
        $arrID=$request->cid;
        $menu_type_id=0;
        foreach ($arrID as $key => $value) {
          $item=MenuModel::find($value);
          $menu_type_id=$item->toArray()["menu_type_id"];   
          $item->status=$status;
          $item->save();
        }
        return redirect()->route("admin.".$this->_controller.".getList",[(int)@$menu_type_id])->with(["message"=>array("content"=>"Đã lưu")]); 
      }
      public function trash(Request $request){
        $arrID                 =   $request->cid;             
        $checked                =   1;
        $type_msg               =   "alert-success";
        $msg                    =   "Delete successfully";              
        $menu_type_id=0;
        if(count($arrID)==0){
          $checked     =   0;
              $type_msg           =   "alert-warning";            
              $msg                =   "Please choose at least one item to delete";
        }else{
          foreach ($arrID as $key => $value) {
            $item=MenuModel::find($value);
            $menu_type_id=$item->toArray()["menu_type_id"];   
            $count = MenuModel::where("parent_id",$value)->count();
            if($count > 0){
              $checked     =   0;
              $type_msg           =   "alert-warning";            
              $msg                =   "Cannot delete this item";
            } 
          }
        }
        if($checked == 1){        
          $strID = implode(',',$arrID);   
          $sqlDeleteMenu = 'DELETE FROM `menu` WHERE `id` IN ('.$strID.') ';                 
          DB::statement($sqlDeleteMenu);          
          return redirect()->route("admin.".$this->_controller.".getList",[(int)@$menu_type_id])->with(["message"=>array("content"=>"Đã lưu")]);     
        }
      }
      public function sortOrder(Request $request){
        $arrOrder=array();
        $arrOrder=$request->sort_order;  
        $menu_type_id=0;  
        if(!empty($arrOrder)){        
          foreach($arrOrder as $id => $value){                    
            $item=MenuModel::find($id);
            $menu_type_id=$item->toArray()["menu_type_id"];   
            $item->sort_order=(int)$value;            
            $item->save();                
          }     
        }    
        return redirect()->route("admin.".$this->_controller.".getList",[(int)@$menu_type_id])->with(["message"=>array("content"=>"Đã lưu")]); 
      }
      public function getComponentForm($menu_type_id = 0){  
        $controller=$this->_controller;     
        $title="Component";
        $icon=$this->_icon; 
        return view("admin.".$this->_controller.".component",compact('menu_type_id',"title","icon","controller")); 
      }
      public function getCategoryArticleComponent($menu_type_id = 0){
        $controller=$this->_controller; 
        $task="list";
        $title="Category Article Component";
        $icon=$this->_icon; 
        $currentPage=1;   
        $filter_search="";
        if(!empty(@$_POST["filter_search"])){
          $filter_search=@$_POST["filter_search"];        
        }        
        $data=DB::select('call pro_getCategoryArticle(?)',array(mb_strtolower($filter_search)));
        $totalItems=count($data);
        $totalItemsPerPage=$this->_totalItemsPerPage;       
        $pageRange=$this->_pageRange;
        if(!empty(@$_POST["filter_page"])){
          $currentPage=(int)@$_POST["filter_page"];    
        }            
        $arrPagination=array(
          "totalItems"=>$totalItems,
          "totalItemsPerPage"=>$totalItemsPerPage,
          "pageRange"=>$pageRange,
          "currentPage"=>$currentPage 
        );
        $pagination=new PaginationModel($arrPagination);
        $position = (@$arrPagination['currentPage']-1)*$totalItemsPerPage;
        $data=array();
        if($totalItemsPerPage > 0){
            $data=DB::select('call pro_getCategoryArticleLimit(?,?,?)',array($filter_search,$position,$totalItemsPerPage));
        }        
        $data=convertToArray($data);
        $data=categoryArticleComponentConverter($data,$this->_controller,$menu_type_id);   
        $data_recursive=array();
        categoryArticleRecursive($data,0,null,$data_recursive);          
        $data=$data_recursive; 
        return view("admin.".$this->_controller.".category-component",compact("controller","task","title","icon",'data','pagination','filter_search'));         
      }
      public function getCategoryProductComponent($menu_type_id = 0){
        $controller=$this->_controller; 
        $task="list";
        $title="Category Product Component";
        $icon=$this->_icon; 
        $currentPage=1;   
        $filter_search="";
        if(!empty(@$_POST["filter_search"])){
          $filter_search=@$_POST["filter_search"];        
        }        
        $data=DB::select('call pro_getCategoryProduct(?)',array(mb_strtolower($filter_search)));
        $totalItems=count($data);
        $totalItemsPerPage=$this->_totalItemsPerPage;       
        $pageRange=$this->_pageRange;
        if(!empty(@$_POST["filter_page"])){
          $currentPage=(int)@$_POST["filter_page"];    
        }            
        $arrPagination=array(
          "totalItems"=>$totalItems,
          "totalItemsPerPage"=>$totalItemsPerPage,
          "pageRange"=>$pageRange,
          "currentPage"=>$currentPage 
        );
        $pagination=new PaginationModel($arrPagination);
        $position = (@$arrPagination['currentPage']-1)*$totalItemsPerPage;
        $data=array();
        if($totalItemsPerPage > 0){
            $data=DB::select('call pro_getCategoryProductLimit(?,?,?)',array($filter_search,$position,$totalItemsPerPage));
        }        
        $data=convertToArray($data);
        $data=categoryProductComponentConverter($data,$this->_controller,$menu_type_id);   
        $data_recursive=array();
        CategoryProductRecursive($data,0,null,$data_recursive);          
        $data=$data_recursive; 
        return view("admin.".$this->_controller.".category-component",compact("controller","task","title","icon",'data','pagination','filter_search'));         
      }
      public function getArticleComponent(){
        $controller=$this->_controller;         
        $title=$this->_title;
        $icon=$this->_icon;   
        return view("admin.".$this->_controller.".article-component",compact("controller","title","icon")); 
      }
}
?>
