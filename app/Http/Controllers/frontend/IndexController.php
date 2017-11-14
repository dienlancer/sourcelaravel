<?php namespace App\Http\Controllers\frontend;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CategoryModel;
use App\CategoryArticleModel;
use App\GroupModel;
use App\MenuModel;
use App\ArticleModel;
use App\PaginationModel;
use App\ProductModel;
use App\ModuleMenuModel;
use App\ModuleCustomModel;
use App\ModuleArticleModel;
use App\ModMenuTypeModel;
use App\User;
use App\UserGroupModel;
use App\CustomerModel;
use App\InvoiceModel;
use App\InvoiceDetailModel;
use App\BannerModel;
use App\ModuleItemModel;
use Session;
use DB;
class IndexController extends Controller {
  var $_totalItemsPerPage=9;         
  var $_pageRange=10;
  public function getHome(){
    $component="trang-chu";               
    $alias="trang-chu";
    $meta_keyword="";
    $meta_description="";  
    // lấy banner    
    $data_banner=BannerModel::whereRaw('status = ?',[1])->orderBy('sort_order','asc')->select('image')->get()->toArray();    
    // lấy sản phẩm nổi bật
    $data_featured_product=$this->getModuleByPosition('product','featured-product');    
    // thiết bị vệ sinh
    $data_toilet_equipment=$this->getModuleByPosition('product','toilet-equipment');
    // thiết bị bếp
    $data_chicken_equipment=$this->getModuleByPosition('product','chicken-equipment');
    // nhà thông minh
    $data_clever_house=$this->getModuleByPosition('product','clever-house');
    return view("frontend.index",compact("component","meta_keyword","meta_description","alias",'data_banner','data_featured_product','data_toilet_equipment','data_chicken_equipment','data_clever_house'));
  }
  function getModuleByPosition($component,$position){
      $module=ModuleItemModel::whereRaw('trim(lower(position)) = ?',[mb_strtolower(trim(@$position))])->select('item_id')->get()->toArray()[0];    
      $item_id=$module['item_id'];
      $arr_id=explode(',', $item_id);
      $data=array();
      for($i=0;$i<count($arr_id);$i++){
          $id=(int)$arr_id[$i];
          $item=array();
          switch ($component) {
            case 'product':
                $item=ProductModel::whereRaw('id = ?',[$id])->get()->toArray()[0];
                break;
            case 'article':
                $item=ArticleModel::whereRaw('id = ?',[$id])->get()->toArray()[0];
                break;            
          }          
          $data[]=$item;
      }      
      return $data;
  }
	public function index($component,$alias)
      {                                 
            $component=$component;               
            $alias=$alias;
            $meta_keyword="";
            $meta_description="";
            $menu_id=0;
            $arrMainMenu=array();
            $arrLstProduct=array();
            $filter_search="";
            $category_id=0;
            $pagination="";
            $currentPage=1;                  
            $name="";                  
            $arrRowProduct=array();     
            $arrRowCategory=array();
            $totalItems=0;
            $totalItemsPerPage=0;
            $pageRange=0;
            $currentPage=1;
            $position=0;
            $arrCountLst=array();
            $action="";
            switch ($component) {
              case "danh-muc":              
                  $arrRowCategory=CategoryModel::whereRaw("trim(lower(alias)) = ?",[trim(mb_strtolower($alias,'UTF-8'))])->get()->toArray()[0];
                  if(!empty($arrRowCategory)){
                            $category_id=$arrRowCategory["id"];
                            $name=$arrRowCategory["name"];
                          }                  
                  if(!empty(@$_POST["filter_search"]))
                                $filter_search=@$_POST["filter_search"];                                 
                  $stdCountLst=DB::select('call pro_getCountProductLst_fe(?,?)',array($filter_search,$category_id)); 
                  if(!empty($stdCountLst)){
                    $arrCountLst=convertToArray(@$stdCountLst);
                    $totalItems=(int)$arrCountLst[0]["countLst"];    
                    $totalItemsPerPage=$this->_totalItemsPerPage;                     
                    $pageRange=$this->_pageRange;
                    if(!empty(@$_POST["filter_page"]))
                      $currentPage=@$_POST["filter_page"];         
                    $arrPagination=array(
                      "totalItems"=>$totalItems,
                      "totalItemsPerPage"=>$totalItemsPerPage,
                      "pageRange"=>$pageRange,
                      "currentPage"=>$currentPage   
                    );                    
                    $pagination=new PaginationModel($arrPagination);
                    $position   = (@$arrPagination['currentPage']-1)*$totalItemsPerPage;
                    $stdLst=array();
                    if($totalItemsPerPage > 0)            
                      $stdLst=DB::select('call pro_getProductLstLimit_fe(?,?,?,?)',array($filter_search,$category_id,$position,$totalItemsPerPage));                   
                    if(!empty(@$stdLst))                       
                      $arrLstProduct=convertToArray(@$stdLst);                              
                  }     
                  break;   
              case "san-pham":  
                  $stdRowProduct=ProductModel::whereRaw("trim(lower(alias)) = ? and status = ?",[trim(mb_strtolower($alias,'UTF-8')),1])->get();                       
                  if(!empty($stdRowProduct)){
                      $arrRowProduct=$stdRowProduct->toArray()[0];                        
                  }
                  if(!empty($arrRowProduct)){
                      $name=$arrRowProduct["name"];                        
                      $category_id=$arrRowProduct["category_id"];                          
                  }                        
                  $arrRowCategory=CategoryModel::findOrFail($category_id)->toArray();
                  if(!empty($arrRowCategory))
                    $alias=$arrRowCategory["alias"];                   
                  break;                        
            }            
            /* begin load module */      
            $arrMainMenuModule=$this->loadMenuModuleByAlias($alias,"main-menu");                    
            /* end load module */
            /* begin com_product */
            if(isset($_POST["action"])){
              $action=$_POST["action"];
              switch ($action) {
                case "add-cart"     :   $this->addCart();return redirect()->route('frontend.index.viewCart'); break;                  
              }
            }
            /* end com_product */                   
            return view("frontend.index",compact("component","meta_keyword","meta_description","pagination","name","arrMainMenuModule","arrLstProduct","arrRowProduct","alias"));
      }
      
      public function viewCart(){        
            $component="gio-hang";
            $alias="dang-nhap";
            $meta_keyword="";
            $meta_description="";
            $menu_id=0;
            $arrMainMenu=array();
            $arrLstProduct=array();
            $filter_search="";
            $category_id=0;
            $pagination="";
            $currentPage=1;                  
            $name="Giỏ hàng";                  
            $arrRowProduct=array();     
            $arrRowCategory=array();
            $totalItems=0;
            $totalItemsPerPage=0;
            $pageRange=0;
            $currentPage=1;
            $position=0;
            $arrCountLst=array();
            $action="";
            /* begin load module */      
            $arrMainMenuModule=$this->loadMenuModuleByAlias($alias,"main-menu");              
            /* end load module */
            if(isset($_POST["action"])){
              $action=$_POST["action"];
              switch ($action) {
                case "update-cart"     :  $this->updateCart();
                                          break;                  
              }
            }
            
            return view("frontend.index",compact("component","meta_keyword","meta_description","pagination","name","arrMainMenuModule","alias"));
      }
      public function deleteAll(){
          $ssName="vmart";                   
          if(Session::has($ssName)){
            Session::forget($ssName);
          }                   
          return redirect()->route('frontend.index.viewCart'); 
      }
      public function delete($id){
          $ssName="vmart";          
          $ssCart=array();
          $arrCart=array();
          if(Session::has($ssName)){
                $ssCart=Session::get($ssName);
          }         
          $arrCart = @$ssCart["cart"];      
          unset($arrCart[$id]);    
          $cart["cart"]=$arrCart;                    
          Session::put($ssName,$cart);             
          return redirect()->route('frontend.index.viewCart'); 
      }
      public function register(){
            $component="dang-ky";
            $alias="dang-nhap";
            $meta_keyword="";
            $meta_description="";
            $menu_id=0;
            $arrMainMenu=array();
            $arrLstProduct=array();
            $filter_search="";
            $category_id=0;
            $pagination="";
            $currentPage=1;                  
            $name="Giỏ hàng";                  
            $arrRowProduct=array();     
            $arrRowCategory=array();
            $totalItems=0;
            $totalItemsPerPage=0;
            $pageRange=0;
            $currentPage=1;
            $position=0;
            $arrCountLst=array();
            $action="";
            $arrError=array();
            $arrData =array();   
            $flag = true;   
            /* begin load module */      
            $arrMainMenuModule=$this->loadMenuModuleByAlias($alias,"main-menu");                        
            /* end load module */            
            if(isset($_POST["action"])){                          
              $arrData =$_POST;                    
              $email=strtolower(trim($_POST["email"])) ;
              $username=strtolower(trim($_POST["username"])) ;
              $password=strtolower(trim($_POST["password"])) ;
              $password_confirm=strtolower(trim($_POST["password_confirm"])) ;
              if(!preg_match("#^[a-z][a-z0-9_\.]{4,31}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$#",$email )){
                $arrError["email"] = 'Email is invalid';
                $arrData["email"] = '';
                $flag=false;
              }
              if(!preg_match("#^[a-z_][a-z0-9_\.\s]{4,31}$#", $username)){
                $arrError["username"] = 'Username is invalid';
                $arrData["username"] = ""; 
                $flag=false;
              }
              if(mb_strlen($password) < 6){
                $arrError["password"] = 'Password is invalid';
                $arrData["password"] = "";
                $arrData["password_confirm"] = ""; 
                $flag=false;
              }
              if(strcmp($password, $password_confirm)!=0){
                $arrError["password_confirm"] = 'PasswordConfirm is not matched Password';
                $arrData["password_confirm"] = "";   
                $flag=false;
              }    
              $arrCustomer=CustomerModel::whereRaw("trim(lower(username)) = ?",[trim(mb_strtolower($username,'UTF-8'))])->get()->toArray();
              if(!empty($arrCustomer)){
                $arrError["username"] = 'Username đã tồn tại';
                $arrData["username"] = ""; 
                $flag=false;
              }  
              $arrCustomer=CustomerModel::whereRaw("trim(lower(email)) = ?",[trim(mb_strtolower($email,'UTF-8'))])->get()->toArray();
              if(!empty($arrCustomer)){
                $arrError["email"] = 'Email đã tồn tại';
                $arrData["email"] = ""; 
                $flag=false;
              }  
              if($flag){
                  $item = new CustomerModel;
                  $item->username=$_POST["username"];
                  $item->password=md5($_POST["password"]) ;
                  $item->email=$_POST["email"];
                  $item->name=$_POST["name"];
                  $item->address=$_POST["address"];
                  $item->phone=$_POST["phone"];
                  $item->mobilephone=$_POST["mobilephone"];
                  $item->fax=$_POST["fax"]; 
                  $item->status=1;  
                  $item->created_at=date("Y-m-d H:i:s",time());
                  $item->updated_at=date("Y-m-d H:i:s",time());
                  $item->save(); 
                  $arrCustomer=CustomerModel::whereRaw("trim(lower(username)) = ?",[trim(mb_strtolower($username,'UTF-8'))])->get()->toArray()[0];
                  $arrUser["userInfo"]=array("username" => $arrCustomer["username"],"id"=>$arrCustomer["id"]);
                  $ssName="vmuser";                                             
                  Session::put($ssName,$arrUser);    
                  return redirect()->route('frontend.index.viewAccount');                                  
              }              
            }
            return view("frontend.index",compact("component","meta_keyword","meta_description","pagination","name","arrMainMenuModule","alias","arrError","arrData","alias"));
      }
      public function login(){   

            $component="dang-nhap";
            $alias="dang-nhap";
            $meta_keyword="";
            $meta_description="";
            $menu_id=0;
            $arrMainMenu=array();
            $arrLstProduct=array();
            $filter_search="";
            $category_id=0;
            $pagination="";
            $currentPage=1;                  
            $name="Giỏ hàng";                  
            $arrRowProduct=array();     
            $arrRowCategory=array();
            $totalItems=0;
            $totalItemsPerPage=0;
            $pageRange=0;
            $currentPage=1;
            $position=0;
            $arrCountLst=array();
            $action="";
            $arrError=array();
            $arrData =array();   
            $flag = true;   
            $ssName="vmuser";
            $arrUser=array();
            $arrCustomer=array();
            $id=0;    
            /* begin load module */      
            $arrMainMenuModule=$this->loadMenuModuleByAlias($alias,"main-menu");                        
            /* end load module */ 
            if(isset($_POST["action"])){              
              $username=trim(@$_POST["username"]);   
              $password=md5(@$_POST["password"]);

              $arrCustomer=CustomerModel::whereRaw("trim(lower(username)) = ? and password = ?",[trim(mb_strtolower($username,'UTF-8')),$password])->get()->toArray()  ;

                    
              if(!empty($arrCustomer)){
                $arrUser["userInfo"]=array("username" => $arrCustomer[0]["username"],"id"=>$arrCustomer[0]["id"]);
                $ssName="vmuser";                                             
                Session::put($ssName,$arrUser);  
                return redirect()->route('frontend.index.viewAccount'); 
              }else{
                $arrError["dang-nhap"]="Đăng nhập sai username và password";
              }
            }
            $ssName="vmuser";
            if(Session::has($ssName)){                
                $arrUser = Session::get($ssName)["userInfo"];    
            }   
            if(!empty($arrUser)){
              return redirect()->route("frontend.index.viewAccount"); 
            }else{
              return view("frontend.index",compact("component","meta_keyword","meta_description","pagination","name","arrMainMenuModule","alias","arrError","arrCustomer","alias"));  
            }              
      }
      public function viewSecurity(){
            $component="bao-mat";
            $alias="dang-nhap";
            $meta_keyword="";
            $meta_description="";
            $menu_id=0;
            $arrMainMenu=array();
            $arrLstProduct=array();
            $filter_search="";
            $category_id=0;
            $pagination="";
            $currentPage=1;                  
            $name="Bảo mật";                  
            $arrRowProduct=array();     
            $arrRowCategory=array();
            $totalItems=0;
            $totalItemsPerPage=0;
            $pageRange=0;
            $currentPage=1;
            $position=0;
            $arrCountLst=array();
            $action="";
            $arrError=array();
            $arrData =array();   
            $flag = true;   
            $ssName="vmuser";
            $arrUser=array();
            $arrData=array();
            $id=0;
            /* begin load module */      
              $arrMainMenuModule=$this->loadMenuModuleByAlias($alias,"main-menu");                        
              /* end load module */  
            $ssName="vmuser";   
            if(Session::has($ssName)){                
                $arrUser = Session::get($ssName)["userInfo"];    
            }   
            if(empty($arrUser)){
              return redirect()->route("frontend.index.login"); 
            }
              $arrData=CustomerModel::find((int)$arrUser["id"])->toArray();    
              $id=(int)$arrData["id"];
              if(isset($_POST["action"])){              
                $arrData =$_POST;                     
                $password=strtolower(trim($_POST["password"])) ;
                $password_confirm=strtolower(trim($_POST["password_confirm"])) ;                
                if(mb_strlen($password) < 6){
                  $arrError["password"] = 'Password is invalid';
                  $arrData["password"] = "";
                  $arrData["password_confirm"] = ""; 
                  $flag=false;
                }
                if(strcmp($password, $password_confirm)!=0){
                  $arrError["password_confirm"] = 'PasswordConfirm is not matched Password';
                  $arrData["password_confirm"] = "";   
                  $flag=false;
                }    
                if($flag){
                    $item=CustomerModel::find($id);                         
                    $item->password=md5($_POST["password"]) ;
                    $item->save();                                                             
                }              
              }             
              return view("frontend.index",compact("component","meta_keyword","meta_description","pagination","name","arrMainMenuModule","alias","arrError","arrData","alias"));                           
      }
      public function getLgout(){
        $ssName="vmuser";
        $arrUser=array();            
        if(Session::has($ssName)){
          $arrUser=Session::get($ssName)["userInfo"]; 
          Session::forget($ssName);      
        }    
        return redirect()->route('frontend.index.login'); 
      }
      public function viewAccount(){
            $component="tai-khoan";
            $alias="dang-nhap";
            $meta_keyword="";
            $meta_description="";
            $menu_id=0;
            $arrMainMenu=array();
            $arrLstProduct=array();
            $filter_search="";
            $category_id=0;
            $pagination="";
            $currentPage=1;                  
            $name="Giỏ hàng";                  
            $arrRowProduct=array();     
            $arrRowCategory=array();
            $totalItems=0;
            $totalItemsPerPage=0;
            $pageRange=0;
            $currentPage=1;
            $position=0;
            $arrCountLst=array();
            $action="";
            $arrError=array();
            $arrData =array();   
            $flag = true;   
            $ssName="vmuser";
            $arrUser=array();
            $arrData=array();
            $id=0;
            /* begin load module */      
                $arrMainMenuModule=$this->loadMenuModuleByAlias($alias,"main-menu");                        
                /* end load module */
            $ssName="vmuser";    
            if(Session::has($ssName)){                
                $arrUser = Session::get($ssName)["userInfo"];    
            }   
            if(empty($arrUser)){
                return redirect()->route("frontend.index.login"); 
            }
            $arrData=CustomerModel::find((int)$arrUser["id"])->toArray();    
            $id=(int)$arrData["id"];                
            if(isset($_POST["action"])){              
              $arrData =$_POST;                       
              $email=strtolower(trim($_POST["email"])) ;                     
              if(!preg_match("#^[a-z][a-z0-9_\.]{4,31}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$#",$email )){
                $arrError["email"] = 'Email is invalid';
                $arrData["email"] = '';
                $flag=false;
              }              
              $arrRow=CustomerModel::whereRaw("trim(lower(email)) = ? and id != ? ",[trim(mb_strtolower($email,'UTF-8')),(int)$id])->get()->toArray();
              if(!empty($arrRow)){
                $arrError["email"] = 'Email đã tồn tại';
                $arrData["email"] = ""; 
                $flag=false;
              }  
              if($flag){
                $item=CustomerModel::find($id);                         
                $item->email=$_POST["email"];
                $item->name=$_POST["name"];
                $item->address=$_POST["address"];
                $item->phone=$_POST["phone"];
                $item->mobilephone=$_POST["mobilephone"];
                $item->fax=$_POST["fax"];                    
                $item->updated_at=date("Y-m-d H:i:s",time());
                $item->save();                                                             
              }              
            }                
            return view("frontend.index",compact("component","meta_keyword","meta_description","pagination","name","arrMainMenuModule","alias","arrError","arrData","alias"));                                    
      }
      public function checkout(){
        $ssName="vmuser";
        $arrUser=array(); 
        $link="";       
        if(Session::has($ssName)){                
          $arrUser = Session::get($ssName)["userInfo"];    
        }   
        if(!empty($arrUser)){
          $link="frontend.index.confirmCheckout";
        }else{
          $link="frontend.index.loginCheckout";
        }
        return redirect()->route($link); 
      }
      public function confirmCheckout(){
        $component="xac-nhan-thanh-toan";
            $alias="dang-nhap";
            $meta_keyword="";
            $meta_description="";
            $menu_id=0;
            $arrMainMenu=array();
            $arrLstProduct=array();
            $filter_search="";
            $category_id=0;
            $pagination="";
            $currentPage=1;                  
            $name="Giỏ hàng";                  
            $arrRowProduct=array();     
            $arrRowCategory=array();
            $totalItems=0;
            $totalItemsPerPage=0;
            $pageRange=0;
            $currentPage=1;
            $position=0;
            $arrCountLst=array();
            $action="";
            $arrError=array();
            $arrData =array();   
            $flag = true;   
            $ssName="vmuser";
            $arrUser=array();
            $arrData=array();
            $id=0;
            /* begin load module */      
              $arrMainMenuModule=$this->loadMenuModuleByAlias($alias,"main-menu");                        
              /* end load module */  
            $ssName="vmuser";  
            if(Session::has($ssName)){                
                $arrUser = Session::get($ssName)["userInfo"];    
            }   
            if(empty($arrUser)){
              return redirect()->route("frontend.index.loginCheckout");               
            }
            $ssName="vmart";                                
            $arrCart=array();
            if(Session::has($ssName)){
              $arrCart=Session::get($ssName)["cart"];
            } 
            if(empty($arrCart)){
              return redirect()->route("frontend.index.viewCart");   
            }      
              $arrData=CustomerModel::find((int)$arrUser["id"])->toArray();    
              $id=(int)$arrData["id"];
              if(isset($_POST["action"])){              
                  $arrData =$_POST;                   
                  $email=strtolower(trim($_POST["email"])) ;                  
                  if(!preg_match("#^[a-z][a-z0-9_\.]{4,31}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$#",$email )){
                    $arrError["email"] = 'Email is invalid';
                    $arrData["email"] = '';
                    $flag=false;
                  }                  
                  $arrRowData=CustomerModel::whereRaw("trim(lower(email)) = ? and id != ? ",[trim(mb_strtolower($email,'UTF-8')),(int)$id])->get()->toArray();
                  if(!empty($arrRowData)){
                    $arrError["email"] = 'Email đã tồn tại';
                    $arrData["email"] = ""; 
                    $flag=false;
                  }  
                  if($flag){                    
                      $item = new InvoiceModel;
                      $item->code=randomString(20);
                      $item->customer_id  =$id;
                      $item->username  =$arrData["username"];
                      $item->email=$_POST["email"];
                      $item->name=$_POST["name"];
                      $item->address=$_POST["address"];
                      $item->phone=$_POST["phone"];
                      $item->mobilephone=$_POST["mobilephone"];
                      $item->fax=$_POST["fax"];  
                      $item->quantity=$_POST["quantity"];
                      $item->total_price=$_POST["total_price"];
                      $item->status=0;  
                      $item->created_at=date("Y-m-d H:i:s",time());
                      $item->updated_at=date("Y-m-d H:i:s",time());
                      $item->save(); 
                      $ssName="vmart";                                
                      $arrCart=array();
                      if(Session::has($ssName)){
                        $arrCart=Session::get($ssName)["cart"];
                      }         
                      if(!empty($arrCart)){
                        foreach ($arrCart as $key => $value) {
                          $invoice_id=$item->id;
                          $product_id=$value["product_id"];    
                          $product_code=$value["product_code"];  
                          $product_name=$value["product_name"];                                                    
                          $product_image=   $value["product_image"] ;        
                          $product_price=$value["product_price"];                                  
                          $product_quantity=$value["product_quantity"];                         
                          $product_total_price=$value["product_total_price"];
                          $itemInvoiceDetail=new InvoiceDetailModel;                          
                          $itemInvoiceDetail->invoice_id=$invoice_id;
                          $itemInvoiceDetail->product_id=$product_id;
                          $itemInvoiceDetail->product_code=$product_code;
                          $itemInvoiceDetail->product_name=$product_name;
                          $itemInvoiceDetail->product_image=$product_image;
                          $itemInvoiceDetail->product_price=$product_price;
                          $itemInvoiceDetail->product_quantity=$product_quantity;
                          $itemInvoiceDetail->product_total_price=$product_total_price;
                          $itemInvoiceDetail->created_at=date("Y-m-d H:i:s",time());
                          $itemInvoiceDetail->updated_at=date("Y-m-d H:i:s",time());
                          $itemInvoiceDetail->save();
                        }
                      }     
                      $ssName="vmart";                   
                      if(Session::has($ssName)){
                        Session::forget($ssName);
                      }                   
                      $component="hoan-tat-thanh-toan";
                      /* begin load module */      
                      $arrMainMenuModule=$this->loadMenuModuleByAlias($alias,"main-menu");                        
                      /* end load module */                                                                      
                  }                         
              }
              return view("frontend.index",compact("component","meta_keyword","meta_description","pagination","name","arrMainMenuModule","alias","arrError","arrData","alias"));                 
      }      
      public function loginCheckout(){
        $component="dang-nhap-thanh-toan";
            $alias="dang-nhap";
            $meta_keyword="";
            $meta_description="";
            $menu_id=0;
            $arrMainMenu=array();
            $arrLstProduct=array();
            $filter_search="";
            $category_id=0;
            $pagination="";
            $currentPage=1;                  
            $name="Giỏ hàng";                  
            $arrRowProduct=array();     
            $arrRowCategory=array();
            $totalItems=0;
            $totalItemsPerPage=0;
            $pageRange=0;
            $currentPage=1;
            $position=0;
            $arrCountLst=array();
            $action="";
            $arrError=array();
            $arrData =array();   
            $flag = true;   
            $ssName="vmuser";
            $arrUser=array();
            $arrCustomer=array();
            $id=0;
            /* begin load module */      
            $arrMainMenuModule=$this->loadMenuModuleByAlias($alias,"main-menu");                        
            /* end load module */   
            $ssName="vmart";                                
            $arrCart=array();
            if(Session::has($ssName)){
              $arrCart=Session::get($ssName)["cart"];
            } 
            if(empty($arrCart)){
              return redirect()->route("frontend.index.viewCart");   
            }       
            if(isset($_POST["action"])){
              $action=$_POST["action"];
              switch ($action) {
                case "register-checkout": 
                  $arrData =$_POST;      
                  $email=strtolower(trim($_POST["email"])) ;
                  $username=strtolower(trim($_POST["username"])) ;
                  $password=strtolower(trim($_POST["password"])) ;
                  $password_confirm=strtolower(trim($_POST["password_confirm"])) ;
                  if(!preg_match("#^[a-z][a-z0-9_\.]{4,31}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$#",$email )){
                    $arrError["email"] = 'Email is invalid';
                    $arrData["email"] = '';
                    $flag=false;
                  }
                  if(!preg_match("#^[a-z_][a-z0-9_\.\s]{4,31}$#", $username)){
                    $arrError["username"] = 'Username is invalid';
                    $arrData["username"] = ""; 
                    $flag=false;
                  }
                  if(mb_strlen($password) < 6){
                    $arrError["password"] = 'Password is invalid';
                    $arrData["password"] = "";
                    $arrData["password_confirm"] = ""; 
                    $flag=false;
                  }
                  if(strcmp($password, $password_confirm)!=0){
                    $arrError["password_confirm"] = 'PasswordConfirm is not matched Password';
                    $arrData["password_confirm"] = "";   
                    $flag=false;
                  }    
                  $arrCustomer=CustomerModel::whereRaw("trim(lower(username)) = ?",[trim(mb_strtolower($username,'UTF-8'))])->get()->toArray();
                  if(!empty($arrCustomer)){
                    $arrError["username"] = 'Username đã tồn tại';
                    $arrData["username"] = ""; 
                    $flag=false;
                  }  
                  $arrCustomer=CustomerModel::whereRaw("trim(lower(email)) = ?",[trim(mb_strtolower($email,'UTF-8'))])->get()->toArray();
                  if(!empty($arrCustomer)){
                    $arrError["email"] = 'Email đã tồn tại';
                    $arrData["email"] = ""; 
                    $flag=false;
                  }  
                  if($flag){
                      $item = new CustomerModel;
                      $item->username=$_POST["username"];
                      $item->password=md5($_POST["password"]) ;
                      $item->email=$_POST["email"];
                      $item->name=$_POST["name"];
                      $item->address=$_POST["address"];
                      $item->phone=$_POST["phone"];
                      $item->mobilephone=$_POST["mobilephone"];
                      $item->fax=$_POST["fax"];  
                      $item->created_at=date("Y-m-d H:i:s",time());
                      $item->updated_at=date("Y-m-d H:i:s",time());
                      $item->save(); 
                      $arrCustomer=CustomerModel::whereRaw("trim(lower(username)) = ?",[trim(mb_strtolower($username,'UTF-8'))])->get()->toArray()[0];
                      $arrUser["userInfo"]=array("username" => $arrCustomer["username"],"id"=>$arrCustomer["id"]);
                      $ssName="vmuser";                                             
                      Session::put($ssName,$arrUser);    
                      return redirect()->route('frontend.index.confirmCheckout');                        
                  }                               
                  break;
                case "login-checkout":
                  $username=trim(@$_POST["username"]);   
                  $password=md5(@$_POST["password"]);              
                  $arrCustomer=CustomerModel::whereRaw("trim(lower(username)) = ? and password = ?",[trim(mb_strtolower($username,'UTF-8')),$password])->get()->toArray()  ;                  
                  if(!empty($arrCustomer)){
                    $arrUser["userInfo"]=array("username" => $arrCustomer[0]["username"],"id"=>$arrCustomer[0]["id"]);
                    $ssName="vmuser";                                             
                    Session::put($ssName,$arrUser);  
                    return redirect()->route('frontend.index.confirmCheckout'); 
                  }else{
                    $arrError["dang-nhap"]="Đăng nhập sai username và password";
                  }                   
                  break;                
              }
            }
            
            return view("frontend.index",compact("component","meta_keyword","meta_description","pagination","name","arrMainMenuModule","alias","arrError","arrData","alias"));  
      }
      public function getInvoice(){
        $component="hoa-don";
        $alias="dang-nhap";
        $meta_keyword="";
        $meta_description="";
        $menu_id=0;
        $arrMainMenu=array();
        $arrLstProduct=array();
        $filter_search="";
        $category_id=0;
        $pagination="";
        $currentPage=1;                  
        $name="Giỏ hàng";                  
        $arrRowProduct=array();     
        $arrRowCategory=array();
        $totalItems=0;
        $totalItemsPerPage=0;
        $pageRange=0;
        $currentPage=1;
        $position=0;
        $arrCountLst=array();
        $action="";
        $arrError=array();
        $arrData =array();   
        $flag = true;   
        $ssName="vmuser";
        $arrUser=array();
        $arrCustomer=array();
        $id=0;
        /* begin load module */      
        $arrMainMenuModule=$this->loadMenuModuleByAlias($alias,"main-menu");                        
        /* end load module */ 
        $ssName="vmuser";  
        if(Session::has($ssName)){                
                $arrUser = Session::get($ssName)["userInfo"];    
        }   
        if(empty($arrUser)){
              return redirect()->route("frontend.index.login");               
        }else{
          $id=$arrUser["id"];
        }  
        $arrInvoice=InvoiceModel::select()->where("customer_id","=",(int)@$id)->get()->toArray();
        return view("frontend.index",compact("component","meta_keyword","meta_description","pagination","name","arrMainMenuModule","alias","arrError","arrData","arrInvoice","alias"));
      }
      public function updateCart(){   
              $arrQTY=$_POST["quantity"];   
              $ssName="vmart";          
              $ssCart=array();
              $arrCart=array();
              if(Session::has($ssName)){
                $ssCart=Session::get($ssName);
              }         
              $arrCart = @$ssCart["cart"];   
              if(!empty($arrCart)){
                foreach ($arrCart as $key => $value) {    
                    $product_quantity=(int)$arrQTY[$key];
                    $product_price = (float)$arrCart[$key]["product_price"];
                    $product_total_price=$product_quantity * $product_price;
                    $arrCart[$key]["product_quantity"]=$product_quantity;
                    $arrCart[$key]["product_total_price"]=$product_total_price;
                }
                foreach ($arrCart as $key => $value) {
                  $product_quantity=(int)$arrCart[$key]["product_quantity"];
                  if($product_quantity==0)
                    unset($arrCart[$key]);
                }
              }              
              $cart["cart"]=$arrCart;                    
              Session::put($ssName,$cart);                   
              if(empty($arrCart))
                  Session::forget($ssName);              
      } 
      function addCart(){          
          $product_id=(int)($_POST["product_id"]);
          $product_code=$_POST["product_code"];
          $product_name=$_POST["product_name"];
          $product_alias=$_POST["product_alias"];
          $product_image=$_POST["product_image"];
          $product_price=(float)($_POST["product_price"]);
          $product_quantity=(int)($_POST["product_quantity"]);
          $ssName="vmart";          
          $ssCart=array();
          $arrCart=array();
          if(Session::has($ssName)){
            $ssCart=Session::get($ssName);
          }         
          $arrCart = @$ssCart["cart"];                   
          if($product_id > 0){            
              if(count($arrCart) == 0){
                $arrCart[$product_id]["product_quantity"] = $product_quantity;
              }
              else{
                    if(!isset($arrCart[$product_id]))
                        $arrCart[$product_id]["product_quantity"] = $product_quantity;                 
                    else         
                      $arrCart[$product_id]["product_quantity"] = $arrCart[$product_id]["product_quantity"] + $product_quantity;                  
              }
              $arrCart[$product_id]["product_id"]=$product_id;  
              $arrCart[$product_id]["product_code"]=$product_code;
              $arrCart[$product_id]["product_name"]=$product_name;
              $arrCart[$product_id]["product_alias"]=$product_alias;      
              $arrCart[$product_id]["product_image"]=$product_image;          
              $arrCart[$product_id]["product_price"]=$product_price;                      
              $product_quantity=(float)$arrCart[$product_id]["product_quantity"];
              $product_total_price=$product_price * $product_quantity;
              $arrCart[$product_id]["product_total_price"]=($product_total_price);
              $cart["cart"]=$arrCart;                    
              Session::put($ssName,$cart);                                     
          }    

      }
      function loadMenuModuleByAlias($alias,$position){          
            $menu_id=0;  
            $arrModule=array();   
            $arrRowMenu=MenuModel::whereRaw("trim(lower(alias)) = ?",[trim(mb_strtolower($alias,'UTF-8'))])->get()->toArray();
            if(!empty($arrRowMenu))
                          $menu_id=$arrRowMenu[0]["id"];     
            $stdModule=DB::table("module_menu")
                                  ->join("mod_menu_type","module_menu.id","=","mod_menu_type.module_id")
                                  ->join("menu","mod_menu_type.menu_id","=","menu.id")
                                  ->where("menu.id",(int)$menu_id)
                                  ->where("mod_menu_type.module_type","module-menu")
                                  ->where("module_menu.position",trim(mb_strtolower($position)))
                                  ->select("module_menu.id","module_menu.name","module_menu.menu_type_id")
                                  ->get();   
            if(!empty($stdModule)){
                    $arrModule=convertToArray(@$stdModule);                                                
            }    
            return $arrModule;
      }
}







