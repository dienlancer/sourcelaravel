<?php namespace App\Http\Controllers\admin;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryArticleRequest;
use App\CategoryArticleModel;
use App\ArticleModel;
use App\ArticleCategoryModel;
use DB;
class CategoryArticleController extends Controller {
    	var $_controller="category-article";	
    	var $_title="Category Article";
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
    		$data=DB::select('call pro_getCategoryArticle(?)',array($filter_search));
    		$parent_id=0;
    		$categoryArticleRecursiveData=array();
    		if(count($data) >0)
    			$parent_id=$data[0]->parent_id;	
    		$data=convertToArray($data);    
        $data=categoryArticleConverter($data,$this->_controller);   
    		categoryArticleRecursive($data,$parent_id,null,$categoryArticleRecursiveData);  
        $data=      	convertToArray($categoryArticleRecursiveData)	;         
        return $data;
    	}
    	public function loadDataApi(Request $request){
    		$filter_search="";
        $data=DB::select('call pro_getCategoryArticle(?)',array($filter_search));
        $parent_id=0;
        $categoryArticleRecursiveData=array();
        if(count($data) >0)
          $parent_id=$data[0]->parent_id; 
        $data=convertToArray($data);
        categoryArticleRecursive($data,$parent_id,null,$categoryArticleRecursiveData);        
        $data=categoryArticleConverter($categoryArticleRecursiveData,$this->_controller);                               
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
                $arrRowData=CategoryArticleModel::find($id)->toArray();			 
            break;
            case 'add':
                $title=$this->_title . " : Add new";
            break;			
         }		
         $arrCategoryArticle=DB::select('call pro_getCategoryArticle(?)',array(""));
         $arrCategoryArticle=convertToArray($arrCategoryArticle);
         $arrCategoryArticleRecursive=array();			
         categoryArticleRecursive($arrCategoryArticle ,0,"",$arrCategoryArticleRecursive)	 ;			
         return view("admin.".$this->_controller.".form",compact("arrCategoryArticleRecursive","arrRowData","controller","task","title","icon"));	
     }
    public function save(Request $request){
        $id 					=	trim($request->id)	;        
        $fullname 				=	trim($request->fullname)	;
        $alias 					= 		trim($request->alias);
        $category_article_id	=		($request->category_article_id);
        $image                  =       trim($request->image);
        $image_hidden           =       trim($request->image_hidden);
        $sort_order 			=		trim($request->sort_order);
        $status 				=		trim($request->status);
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
                $data=CategoryArticleModel::whereRaw("trim(lower(fullname)) = ?",[trim(mb_strtolower($fullname,'UTF-8'))])->get()->toArray();	        	
            }else{
              $data=CategoryArticleModel::whereRaw("trim(lower(fullname)) = ? and id != ?",[trim(mb_strtolower($fullname,'UTF-8')),$id])->get()->toArray();		
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
              $data=CategoryArticleModel::whereRaw("trim(lower(alias)) = ?",[trim(mb_strtolower($alias,'UTF-8'))])->get()->toArray();	        	
            }else{
              $data=CategoryArticleModel::whereRaw("trim(lower(alias)) = ? and id != ?",[trim(mb_strtolower($alias,'UTF-8')),$id])->get()->toArray();		
            }  
            if (count($data) > 0) {
              $checked = 0;
              $error["alias"]["type_msg"] 	= "has-error";
              $error["alias"]["msg"] 			= "Alias is existed in system";
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
              $item 				= 	new CategoryArticleModel;       
              $item->created_at 	=	date("Y-m-d H:i:s",time());        
              if(!empty($image)){
                $item->image    =   trim($image) ;  
              }				
        } else{
              $item				=	CategoryArticleModel::find($id);   
              $file_image="";                       
              if(!empty($image_hidden)){
                $file_image =$image_hidden;          
              }
              if(!empty($image))  {
                $file_image=$image;                                                
              }
              $item->image=trim($file_image) ;            		  		 	
        }  
        $item->fullname 		=	$fullname;
        $item->alias 			=	$alias;
        $item->parent_id 		=	$category_article_id;            
        $item->sort_order 		=	$sort_order;
        $item->status 			=	$status;    
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
            $item           =       CategoryArticleModel::find($id);        
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
      public function deleteImage(Request $request){
          $id                     =   (int)$request->id;              
          $checked                =   1;
          $type_msg               =   "alert-success";
          $msg                    =   "Delete successfully";            
        
          if($checked == 1){
              $item = CategoryArticleModel::find($id);
              $item->image     = null;      
              $item->save();  
          }          
          $info = array(
            'checked'           => $checked,
            'type_msg'          => $type_msg,                
            'msg'               => $msg,                    
          );
          return $info;
      }
      public function deleteItem(Request $request){
            $id                     =   (int)$request->id;              
            $checked                =   1;
            $type_msg               =   "alert-success";
            $msg                    =   "Delete successfully";            
            $count                  =   CategoryArticleModel::where("parent_id",$id)->count();
            if($count > 0){
                $checked     =   0;
                $type_msg           =   "alert-warning";            
                $msg                =   "Cannot delete this item";            
            }
            $count                  =   ArticleCategoryModel::where("category_article_id",$id)->count();
            if($count > 0){
                $checked     =   0;
                $type_msg           =   "alert-warning";            
                $msg                =   "Cannot delete this item";            
            }
            if($checked == 1){
                $item               =   CategoryArticleModel::find($id);
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
                        $item=CategoryArticleModel::find($value);
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
                if(!empty($value)){
                  $count = CategoryArticleModel::where("parent_id",$value)->count();
                  if($count > 0){
                    $checked     =   0;
                    $type_msg           =   "alert-warning";            
                    $msg                =   "Cannot delete this item";
                  }
                  $count = ArticleCategoryModel::where("category_article_id",$value)->count();
                  if($count > 0){
                    $checked     =   0;
                    $type_msg           =   "alert-warning";            
                    $msg                =   "Cannot delete this item"; 
                  }
                }                
              }
            }
            if($checked == 1){                
              $strID = implode(',',$arrID);       
              $strID = substr($strID, 0,strlen($strID) - 1);            
              $sql = "DELETE FROM `category_article` WHERE `id` IN (".$strID.")";                                 
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
              $item=CategoryArticleModel::find((int)$value->id);                
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
