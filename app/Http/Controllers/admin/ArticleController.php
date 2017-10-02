<?php namespace App\Http\Controllers\admin;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use App\CategoryArticleModel;
use App\ArticleModel;
use App\ArticleCategoryModel;
use DB;
class ArticleController extends Controller {
	var $_controller="article";	
	var $_title="Article";
	var $_icon="icon-settings font-dark";
	public function getList(){		
		$controller=$this->_controller;	
		$task="list";
		$title=$this->_title;
		$icon=$this->_icon;		
		return view("admin.".$this->_controller.".list",compact("controller","task","title","icon"));	
	}	
  public function getStringCategoryArticleID($category_article_id,&$arrCategoryArticleID){    
    $arrCategoryArticle=CategoryArticleModel::select("id")->where("parent_id","=",(int)@$category_article_id)->get()->toArray();
    foreach ($arrCategoryArticle as $key => $value) {
      $arrCategoryArticleID[]=$value["id"];
      $this->getStringCategoryArticleID((int)$value["id"],$arrCategoryArticleID);
    }   
  }
	public function loadData(Request $request){
		$filter_search="";    
    $category_article_id=0;  
    $currentPage=1; 
    if(!empty(@$request->filter_search)){      
      $filter_search=@$request->filter_search;    
    }
    if(!empty(@$request->ddlCategoryArticle)){
      $category_article_id=(int)@$request->ddlCategoryArticle;
    }
    /* begin lấy chuỗi ID */
    $arrCategoryArticleID=array();
    $strCategoryArticleID="";
    $arrCategoryArticleID[]=$category_article_id;
    $this->getStringCategoryArticleID($category_article_id,$arrCategoryArticleID);    
    $strCategoryArticleID=implode("#;#", $arrCategoryArticleID);    
    $strCategoryArticleID="#".$strCategoryArticleID."#";    
    /* end lấy chuỗi ID */
		$data=DB::select('call pro_getArticle(?,?)',array($filter_search,$strCategoryArticleID));
		$data=convertToArray($data);		
		$data=articleConverter($data,$this->_controller);		    
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
     $arrRowData=ArticleModel::find($id)->toArray();       
      $arrArticleCategory=ArticleCategoryModel::whereRaw("article_id = ?",[(int)@$id])->get()->toArray();
     break;
     case 'add':
     $title=$this->_title . " : Add new";
     break;     
   }    
   $arrCategoryArticle=CategoryArticleModel::select("id","fullname","alias","parent_id","image","sort_order","status","created_at","updated_at")->orderBy("sort_order","asc")->get()->toArray();  
       
      $arrCategoryArticleRecursive=array();

      categoryArticleRecursiveFormArticle($arrCategoryArticle ,0,"",$arrCategoryArticleRecursive)   ;
      
      return view("admin.".$this->_controller.".form",compact("arrCategoryArticleRecursive","arrRowData","arrArticleCategory","controller","task","title","icon"));
 }
 public function save(Request $request){
      $id 					        =		trim($request->id);        
      $fullname 				    =		trim($request->fullname);
      $title                =   trim($request->title);
      $alias 					      = 	trim($request->alias);
      $image                =   trim($request->image);
      $image_hidden         =   trim($request->image_hidden);
      $intro                =   trim($request->intro);
      $content              =   trim($request->content);
      $description          =   trim($request->description);
      $meta_keyword         =   trim($request->meta_keyword);
      $meta_description     =   trim($request->meta_description);
      $sort_order           =   trim($request->sort_order);
      $status               =   trim($request->status);
      $category_article_id	=		($request->category_article_id);            
      $data 		            =   array();
      $info 		            =   array();
      $error 		            =   array();
      $item		              =   null;
      $checked 	            =   1;              
      if(empty($fullname)){
         $checked = 0;
         $error["fullname"]["type_msg"] = "has-error";
         $error["fullname"]["msg"] = "Fullname is required";
      }else{
          $data=array();
          if (empty($id)) {
            $data=ArticleModel::whereRaw("trim(lower(fullname)) = ?",[trim(mb_strtolower($fullname,'UTF-8'))])->get()->toArray();	        	
          }else{
            $data=ArticleModel::whereRaw("trim(lower(fullname)) = ? and id != ?",[trim(mb_strtolower($fullname,'UTF-8')),$id])->get()->toArray();		
          }  
          if (count($data) > 0) {
              $checked = 0;
              $error["fullname"]["type_msg"] = "has-error";
              $error["fullname"]["msg"] = "Fullname is existed in system";
          }      	
      }
      if(empty($title)){
         $checked = 0;
         $error["title"]["type_msg"] = "has-error";
         $error["title"]["msg"] = "Title is required";
      }
      if(empty($alias)){
          $checked = 0;
          $error["alias"]["type_msg"] = "has-error";
          $error["alias"]["msg"] = "Alias is required";
      }else{
          $data=array();
          if (empty($id)) {
            $data=ArticleModel::whereRaw("trim(lower(alias)) = ?",[trim(mb_strtolower($alias,'UTF-8'))])->get()->toArray();	        	
          }else{
            $data=ArticleModel::whereRaw("trim(lower(alias)) = ? and id != ?",[trim(mb_strtolower($alias,'UTF-8')),$id])->get()->toArray();		
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
          $item 				= 	new ArticleModel;       
          $item->created_at 	=	date("Y-m-d H:i:s",time());        
          if(!empty($image)){
            $item->image    =   trim($image) ;  
          }				
      } else{
          $item				=	ArticleModel::find($id);   
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
      $item->title = $title;
      $item->alias 			=	$alias;
      $item->intro= $intro;
      $item->content=$content;
      $item->description=$description;
      $item->meta_keyword=$meta_keyword;
      $item->meta_description=$meta_description;           
      $item->sort_order 		=	$sort_order;
      $item->status 			=	$status;    
      $item->updated_at 		=	date("Y-m-d H:i:s",time());    	        	
      $item->save();  	
      if(!empty(@$category_article_id)){                            
        $arrArticleCategory=ArticleCategoryModel::whereRaw("article_id = ?",[@$item->id])->select("category_article_id")->get()->toArray();
        $arrCategoryArticleID=array();
        foreach ($arrArticleCategory as $key => $value) {
          $arrCategoryArticleID[]=$value["category_article_id"];
        }
        $selected=@$category_article_id;
        sort($selected);
        sort($arrCategoryArticleID);         
        $resultCompare=0;
        if($selected == $arrCategoryArticleID){
          $resultCompare=1;       
        }
        if($resultCompare==0){
          ArticleCategoryModel::whereRaw("article_id = ?",[(int)@$item->id])->delete();  
          foreach ($selected as $key => $value) {
            $category_article_id=$value;
            $articleCategory=new ArticleCategoryModel;
            $articleCategory->article_id=@$item->id;
            $articleCategory->category_article_id=$category_article_id;            
            $articleCategory->save();
          }
        }       
       }
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
  $item           =       ArticleModel::find($id);        
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
      $item = ArticleModel::find($id);
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
  
  if($checked == 1){
    $item = ArticleModel::find($id);
      $item->delete();
      ArticleCategoryModel::whereRaw("article_id = ?",[(int)$id])->delete();
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
  foreach ($arrID as $key => $value) {
    if(!empty($value)){
      $item=ArticleModel::find($value);
      $item->status=$status;
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
        $sqlDeleteArticle = "DELETE FROM `article` WHERE `id` IN  (".$strID.")";       
        $sqlDeleteArticleCategory = "DELETE FROM `article_category` WHERE `article_id` IN (".$strID.")";                
        DB::statement($sqlDeleteArticle);
        DB::statement($sqlDeleteArticleCategory);           
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
      $item=ArticleModel::find((int)$value->id);                
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
