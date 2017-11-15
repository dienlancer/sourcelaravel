<?php namespace App\Http\Controllers\frontend;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CategoryModel;
use App\CategoryArticleModel;
use App\CategoryProductModel;
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
  var $_pageRange=4;
  public function getHome(){
    $component="trang-chu";               
    $alias="trang-chu";
    $meta_keyword="";
    $meta_description="";  
    // lấy banner    
    $data_banner=BannerModel::whereRaw('status = ?',[1])->orderBy('sort_order','asc')->select('image')->get()->toArray()    ;
    return view("frontend.home",compact("component","meta_keyword","meta_description","alias",'data_banner'));
  }  
	public function index($component,$alias)
      {                                 
            $title="";
            $meta_keyword="";
            $meta_description="";            
            $filter_search="";            
            $str_pagination="";
            $currentPage=1;                                          
            $totalItems=0;
            $totalItemsPerPage=0;
            $pageRange=0;      
            $currentPage=1;    
            $action="";
            $item=array();
            $items=array();
            $dataSettingSystem= getSettingSystem();     
            $category=array();       
            switch ($component) {
              case 'chu-de':
              $category_id=0;
              $arr_category=CategoryArticleModel::whereRaw("trim(lower(alias)) = ? and status = ?",[trim(mb_strtolower($alias,'UTF-8')),1])->get()->toArray();
              if(count($arr_category) > 0){
                  $category_id=$arr_category[0]['id'];
                  $category=$arr_category[0];
                  if(!empty(@$_POST["filter_search"])){
                      $filter_search=@$_POST["filter_search"];
                  }                                
                  $data=DB::select('call pro_getArticleFrontend(?,?)',array(mb_strtolower($filter_search),$category_id));
                  $data=convertToArray($data);
                  $totalItems=count($data);
                  $totalItemsPerPage=(int)$dataSettingSystem['article_perpage']; 
                  $pageRange=$this->_pageRange;
                  if(!empty(@$_POST["filter_page"])){
                    $currentPage=@$_POST["filter_page"];
                  }       
                  $arrPagination=array(
                    "totalItems"=>$totalItems,
                    "totalItemsPerPage"=>$totalItemsPerPage,
                    "pageRange"=>$pageRange,
                    "currentPage"=>$currentPage   
                  );           
                  $pagination=new PaginationModel($arrPagination);
                  $str_pagination=$pagination->showPagination();
                  $position   = (@$arrPagination['currentPage']-1)*$totalItemsPerPage;
                  $data=DB::select('call pro_getArticleFrontendLimit(?,?,?,?)',array($filter_search,$category_id,$position,$totalItemsPerPage));      
                  $items=convertToArray($data);                  
              }              
              break;
              case 'bai-viet':
              $row=ArticleModel::whereRaw("trim(lower(alias)) = ? and status = ?",[trim(mb_strtolower($alias,'UTF-8')),1])->get()->toArray();              
              if(count($row) > 0){
                $item=$row[0];
              }         
              break;  
              case 'loai-san-pham':
              $category_id=0;
              $arr_category=CategoryProductModel::whereRaw("trim(lower(alias)) = ? and status = ?",[trim(mb_strtolower($alias,'UTF-8')),1])->get()->toArray();
              if(count($arr_category) > 0){
                  $category_id=$arr_category[0]['id'];
                  $category=$arr_category[0];
                  if(!empty(@$_POST["filter_search"])){
                      $filter_search=@$_POST["filter_search"];
                  }                                
                  $data=DB::select('call pro_getProductFrontend(?,?)',array(mb_strtolower($filter_search),$category_id));
                  $data=convertToArray($data);
                  $totalItems=count($data);
                  $totalItemsPerPage=(int)$dataSettingSystem['product_perpage']; 
                  $pageRange=$this->_pageRange;
                  if(!empty(@$_POST["filter_page"])){
                    $currentPage=@$_POST["filter_page"];
                  }       
                  $arrPagination=array(
                    "totalItems"=>$totalItems,
                    "totalItemsPerPage"=>$totalItemsPerPage,
                    "pageRange"=>$pageRange,
                    "currentPage"=>$currentPage   
                  );           
                  $pagination=new PaginationModel($arrPagination);
                  $str_pagination=$pagination->showPagination();
                  $position   = (@$arrPagination['currentPage']-1)*$totalItemsPerPage;
                  $data=DB::select('call pro_getProductFrontendLimit(?,?,?,?)',array($filter_search,$category_id,$position,$totalItemsPerPage));      
                  $items=convertToArray($data);                  
              }              
              break; 
              case 'san-pham':
              $row=ProductModel::whereRaw("trim(lower(alias)) = ? and status = ?",[trim(mb_strtolower($alias,'UTF-8')),1])->get()->toArray();              
              if(count($row) > 0){
                $item=$row[0];
              }         
              break;        
            }         
            if(count($item) > 0){
                $title=$item['title'];
                $meta_keyword=$item['meta_keyword'];
                $meta_description=$item['meta_description'];
            }           
            if(isset($_POST["action"])){
              $action=$_POST["action"];
              switch ($action) {
                case "add-cart"     :   $this->addCart();return redirect()->route('frontend.index.viewCart'); break;                  
              }
            }           
            return view("frontend.index",compact("component","title","meta_keyword","meta_description","alias","item","items","category","str_pagination"));
      }
      function getStringCategoryProductID($category_id,&$arrCategoryProductID){    
        $arrCategoryProduct=CategoryProductModel::select("id")->where("parent_id","=",(int)@$category_id)->get()->toArray();
        if(count($arrCategoryProduct) > 0){
          foreach ($arrCategoryProduct as $key => $value) {
            $arrCategoryProductID[]=$value["id"];
            $this->getStringCategoryProductID((int)$value["id"],$arrCategoryProductID);
          }
        }          
      }
      public function contact(){      
        $alias="lien-he"; 
        if(isset($_POST['btnSend']))     {
          $data_setting_system=getSettingSystem();    
          $fullname   = @$_POST["fullname"];
          $email    = @$_POST['email'];   
          $phone    = @$_POST['phone'];
          $title    = @$_POST['title'];
          $address  = @$_POST['address'];
          $content  = @$_POST["content"];
          /* begin load config contact */
          $smtp_host      = @$data_setting_system['smtp_host'];
          $smtp_port      = @$data_setting_system['smtp_port'];
          $smtp_auth      = @$data_setting_system['smtp_auth'];
          $encription     = @$data_setting_system['encription'];
          $smtp_username  = @$data_setting_system['smtp_username'];
          $smtp_password  = @$data_setting_system['smtp_password'];
          $email_from     = @$data_setting_system['email_from'];
          $email_to       = @$data_setting_system['email_to'];
          $to_name        = @$data_setting_system['to_name'];
          /* end load config contact */
          $filePhpMailer=base_path() . DS ."app".DS."scripts".DS."phpmailer".DS."PHPMailerAutoload.php"  ;

          require_once $filePhpMailer;    
          $strMsg="";
          $mail = new PHPMailer;        
          $mail->CharSet = "UTF-8";   
          $mail->isSMTP();             
          $mail->SMTPDebug = 2;
          $mail->Debugoutput = 'html';
          $mail->Host = @$smtp_host;
          $mail->Port = @$smtp_port;
          $mail->SMTPSecure = @$encription;
          $mail->SMTPAuth = true;
          $mail->Username = @$smtp_username;
          $mail->Password = @$smtp_password;
          $mail->setFrom(@$email_from, $fullname);
          $mail->addAddress(@$email_to, @$to_name);
          $mail->Subject = 'Khách hàng '. @$fullname . " - Số điện thoại : " . @$phone ;       
          $strContent=@$content . "\n\n" . " Điện thoại : " . @$phone; 
          $mail->Body=$strContent;   
          if ($mail->send()) {                
            echo '<script language="javascript" type="text/javascript">alert("Mail gửi thành công");</script>'; 
          }
          else{
            echo '<script language="javascript" type="text/javascript">alert("Mail gửi không thành công");</script>'; 
          }          
        }
        return view("frontend.contact",compact("alias"));          
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







