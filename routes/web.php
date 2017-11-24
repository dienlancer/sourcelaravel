<?php
Route::group(["prefix"=>"admin","middleware"=>"TestLogin"],function(){	
	Route::group(["prefix"=>"category-product"],function(){		
		Route::match(["get","post"],"list",["as"=>"admin.category-product.getList","uses"=>"admin\CategoryProductController@getList"]);	
		Route::get("form/{task}/{id?}",["as"=>"admin.category-product.getForm","uses"=>"admin\CategoryProductController@getForm"]);
		Route::post("save",["as"=>"admin.category-product.save","uses"=>"admin\CategoryProductController@save"]);
		Route::get("delete-item/{id}",["as"=>"admin.category-product.deleteItem","uses"=>"admin\CategoryProductController@deleteItem"]);		
		Route::post("sort-order",["as"=>"admin.category-product.sortOrder","uses"=>"admin\CategoryProductController@sortOrder"]);
		Route::post("update-status/{status}",["as"=>"admin.category-product.updateStatus","uses"=>"admin\CategoryProductController@updateStatus"]);
		Route::post("change-status",["as"=>"admin.category-product.changeStatus","uses"=>"admin\CategoryProductController@changeStatus"]);
		Route::post("trash",["as"=>"admin.category-product.trash","uses"=>"admin\CategoryProductController@trash"]);
		Route::post("upload-file",["as"=>"admin.category-product.uploadFile","uses"=>"admin\CategoryProductController@uploadFile"]);
	});	
	Route::group(["prefix"=>"banner"],function(){		
		Route::get("list",["as"=>"admin.banner.getList","uses"=>"admin\BannerController@getList"]);
		Route::post("load-data",["as"=>"admin.banner.loadData","uses"=>"admin\BannerController@loadData"]);		
		Route::get("form/{task}/{id?}",["as"=>"admin.banner.getForm","uses"=>"admin\BannerController@getForm"]);
		Route::post("save",["as"=>"admin.banner.save","uses"=>"admin\BannerController@save"]);
		Route::post("delete-item",["as"=>"admin.banner.deleteItem","uses"=>"admin\BannerController@deleteItem"]);		
		Route::post("sort-order",["as"=>"admin.banner.sortOrder","uses"=>"admin\BannerController@sortOrder"]);
		Route::post("update-status",["as"=>"admin.banner.updateStatus","uses"=>"admin\BannerController@updateStatus"]);
		Route::post("change-status",["as"=>"admin.banner.changeStatus","uses"=>"admin\BannerController@changeStatus"]);
		Route::post("trash",["as"=>"admin.banner.trash","uses"=>"admin\BannerController@trash"]);
		Route::post("upload-file",["as"=>"admin.banner.uploadFile","uses"=>"admin\BannerController@uploadFile"]);
	});
	Route::group(["prefix"=>"payment-method"],function(){		
		Route::get("list",["as"=>"admin.payment-method.getList","uses"=>"admin\PaymentMethodController@getList"]);
		Route::post("load-data",["as"=>"admin.payment-method.loadData","uses"=>"admin\PaymentMethodController@loadData"]);		
		Route::get("form/{task}/{id?}",["as"=>"admin.payment-method.getForm","uses"=>"admin\PaymentMethodController@getForm"]);
		Route::post("save",["as"=>"admin.payment-method.save","uses"=>"admin\PaymentMethodController@save"]);
		Route::post("delete-item",["as"=>"admin.payment-method.deleteItem","uses"=>"admin\PaymentMethodController@deleteItem"]);		
		Route::post("sort-order",["as"=>"admin.payment-method.sortOrder","uses"=>"admin\PaymentMethodController@sortOrder"]);
		Route::post("update-status",["as"=>"admin.payment-method.updateStatus","uses"=>"admin\PaymentMethodController@updateStatus"]);
		Route::post("change-status",["as"=>"admin.payment-method.changeStatus","uses"=>"admin\PaymentMethodController@changeStatus"]);
		Route::post("trash",["as"=>"admin.payment-method.trash","uses"=>"admin\PaymentMethodController@trash"]);		
	});
	Route::group(["prefix"=>"setting-system"],function(){		
		Route::get("list",["as"=>"admin.setting-system.getList","uses"=>"admin\SettingSystemController@getList"]);
		Route::post("load-data",["as"=>"admin.setting-system.loadData","uses"=>"admin\SettingSystemController@loadData"]);		
		Route::get("form/{task}/{id?}",["as"=>"admin.setting-system.getForm","uses"=>"admin\SettingSystemController@getForm"]);
		Route::post("save",["as"=>"admin.setting-system.save","uses"=>"admin\SettingSystemController@save"]);
		Route::post("delete-item",["as"=>"admin.setting-system.deleteItem","uses"=>"admin\SettingSystemController@deleteItem"]);		
		Route::post("sort-order",["as"=>"admin.setting-system.sortOrder","uses"=>"admin\SettingSystemController@sortOrder"]);
		Route::post("update-status",["as"=>"admin.setting-system.updateStatus","uses"=>"admin\SettingSystemController@updateStatus"]);
		Route::post("change-status",["as"=>"admin.setting-system.changeStatus","uses"=>"admin\SettingSystemController@changeStatus"]);
		Route::post("trash",["as"=>"admin.setting-system.trash","uses"=>"admin\SettingSystemController@trash"]);		
	});
	Route::group(["prefix"=>"product"],function(){		
		Route::get("list",["as"=>"admin.product.getList","uses"=>"admin\ProductController@getList"]);
		Route::post("load-data",["as"=>"admin.product.loadData","uses"=>"admin\ProductController@loadData"]);		
		Route::get("form/{task}/{id?}",["as"=>"admin.product.getForm","uses"=>"admin\ProductController@getForm"]);
		Route::post("save",["as"=>"admin.product.save","uses"=>"admin\ProductController@save"]);
		Route::post("delete-item",["as"=>"admin.product.deleteItem","uses"=>"admin\ProductController@deleteItem"]);		
		Route::post("sort-order",["as"=>"admin.product.sortOrder","uses"=>"admin\ProductController@sortOrder"]);
		Route::post("update-status",["as"=>"admin.product.updateStatus","uses"=>"admin\ProductController@updateStatus"]);
		Route::post("change-status",["as"=>"admin.product.changeStatus","uses"=>"admin\ProductController@changeStatus"]);
		Route::post("trash",["as"=>"admin.product.trash","uses"=>"admin\ProductController@trash"]);
		Route::post("upload-file",["as"=>"admin.product.uploadFile","uses"=>"admin\ProductController@uploadFile"]);
	});		
	Route::group(["prefix"=>"privilege"],function(){		
		Route::get("list",["as"=>"admin.privilege.getList","uses"=>"admin\PrivilegeController@getList"]);
		Route::post("load-data",["as"=>"admin.privilege.loadData","uses"=>"admin\PrivilegeController@loadData"]);		
		Route::get("form/{task}/{id?}",["as"=>"admin.privilege.getForm","uses"=>"admin\PrivilegeController@getForm"]);
		Route::post("save",["as"=>"admin.privilege.save","uses"=>"admin\PrivilegeController@save"]);
		Route::post("delete-item",["as"=>"admin.privilege.deleteItem","uses"=>"admin\PrivilegeController@deleteItem"]);		
		Route::post("sort-order",["as"=>"admin.privilege.sortOrder","uses"=>"admin\PrivilegeController@sortOrder"]);		
		Route::post("trash",["as"=>"admin.privilege.trash","uses"=>"admin\PrivilegeController@trash"]);		
	});
	Route::group(["prefix"=>"album"],function(){		
		Route::match(["get","post"],"list",["as"=>"admin.album.getList","uses"=>"admin\AlbumController@getList"]);
		Route::get("form/{task}/{id?}",["as"=>"admin.album.getForm","uses"=>"admin\AlbumController@getForm"]);
		Route::post("form/{task}",["as"=>"admin.album.postForm","uses"=>"admin\AlbumController@postForm"]);
		Route::get("delete/{id}",["as"=>"admin.album.getDelete","uses"=>"admin\AlbumController@getDelete"]);
		Route::post("ordering",["as"=>"admin.album.postOrdering","uses"=>"admin\AlbumController@postOrdering"]);
		Route::post("status/{status}",["as"=>"admin.album.postStatus","uses"=>"admin\AlbumController@postStatus"]);
		Route::get("ajaxStatus/{id}/{status}",["as"=>"admin.album.getAjaxStatus","uses"=>"admin\AlbumController@getAjaxStatus"]);
		Route::post("trash",["as"=>"admin.album.postTrash","uses"=>"admin\AlbumController@postTrash"]);
	});	
	Route::group(["prefix"=>"customer"],function(){		
		Route::get("list",["as"=>"admin.customer.getList","uses"=>"admin\CustomerController@getList"]);
		Route::post("load-data",["as"=>"admin.customer.loadData","uses"=>"admin\CustomerController@loadData"]);		
		Route::get("form/{task}/{id?}",["as"=>"admin.customer.getForm","uses"=>"admin\CustomerController@getForm"]);
		Route::post("save",["as"=>"admin.customer.save","uses"=>"admin\CustomerController@save"]);
		Route::post("delete-item",["as"=>"admin.customer.deleteItem","uses"=>"admin\CustomerController@deleteItem"]);		
		Route::post("sort-order",["as"=>"admin.customer.sortOrder","uses"=>"admin\CustomerController@sortOrder"]);
		Route::post("update-status",["as"=>"admin.customer.updateStatus","uses"=>"admin\CustomerController@updateStatus"]);
		Route::post("change-status",["as"=>"admin.customer.changeStatus","uses"=>"admin\CustomerController@changeStatus"]);
		Route::post("trash",["as"=>"admin.customer.trash","uses"=>"admin\CustomerController@trash"]);		
	});
	Route::group(["prefix"=>"invoice"],function(){		
		Route::get("list",["as"=>"admin.invoice.getList","uses"=>"admin\InvoiceController@getList"]);
		Route::post("load-data",["as"=>"admin.invoice.loadData","uses"=>"admin\InvoiceController@loadData"]);		
		Route::get("form/{task}/{id?}",["as"=>"admin.invoice.getForm","uses"=>"admin\InvoiceController@getForm"]);
		Route::post("save",["as"=>"admin.invoice.save","uses"=>"admin\InvoiceController@save"]);
		Route::post("delete-item",["as"=>"admin.invoice.deleteItem","uses"=>"admin\InvoiceController@deleteItem"]);		
		Route::post("sort-order",["as"=>"admin.invoice.sortOrder","uses"=>"admin\InvoiceController@sortOrder"]);
		Route::post("update-status",["as"=>"admin.invoice.updateStatus","uses"=>"admin\InvoiceController@updateStatus"]);
		Route::post("change-status",["as"=>"admin.invoice.changeStatus","uses"=>"admin\InvoiceController@changeStatus"]);
		Route::post("trash",["as"=>"admin.invoice.trash","uses"=>"admin\InvoiceController@trash"]);
	});
	Route::group(["prefix"=>"user"],function(){		
		Route::get("list",["as"=>"admin.user.getList","uses"=>"admin\UserController@getList"]);
		Route::post("load-data",["as"=>"admin.user.loadData","uses"=>"admin\UserController@loadData"]);		
		Route::get("form/{task}/{id?}",["as"=>"admin.user.getForm","uses"=>"admin\UserController@getForm"]);
		Route::post("save",["as"=>"admin.user.save","uses"=>"admin\UserController@save"]);
		Route::post("delete-item",["as"=>"admin.user.deleteItem","uses"=>"admin\UserController@deleteItem"]);		
		Route::post("sort-order",["as"=>"admin.user.sortOrder","uses"=>"admin\UserController@sortOrder"]);
		Route::post("update-status",["as"=>"admin.user.updateStatus","uses"=>"admin\UserController@updateStatus"]);
		Route::post("change-status",["as"=>"admin.user.changeStatus","uses"=>"admin\UserController@changeStatus"]);
		Route::post("trash",["as"=>"admin.user.trash","uses"=>"admin\UserController@trash"]);		
	});
	Route::group(["prefix"=>"category-article"],function(){		
		Route::match(["get","post"],"list",["as"=>"admin.category-article.getList","uses"=>"admin\CategoryArticleController@getList"]);	
		Route::get("form/{task}/{id?}",["as"=>"admin.category-article.getForm","uses"=>"admin\CategoryArticleController@getForm"]);
		Route::post("save",["as"=>"admin.category-article.save","uses"=>"admin\CategoryArticleController@save"]);
		Route::get("delete-item/{id}",["as"=>"admin.category-article.deleteItem","uses"=>"admin\CategoryArticleController@deleteItem"]);		
		Route::post("sort-order",["as"=>"admin.category-article.sortOrder","uses"=>"admin\CategoryArticleController@sortOrder"]);
		Route::post("update-status/{status}",["as"=>"admin.category-article.updateStatus","uses"=>"admin\CategoryArticleController@updateStatus"]);
		Route::post("change-status",["as"=>"admin.category-article.changeStatus","uses"=>"admin\CategoryArticleController@changeStatus"]);
		Route::post("trash",["as"=>"admin.category-article.trash","uses"=>"admin\CategoryArticleController@trash"]);
		Route::post("upload-file",["as"=>"admin.category-article.uploadFile","uses"=>"admin\CategoryArticleController@uploadFile"]);
	});	
	Route::group(["prefix"=>"photo"],function(){		
		Route::match(["get","post"],"list",["as"=>"admin.photo.getList","uses"=>"admin\PhotoController@getList"]);
		Route::get("form/{task}/{id?}",["as"=>"admin.photo.getForm","uses"=>"admin\PhotoController@getForm"]);
		Route::post("form/{task}",["as"=>"admin.photo.postForm","uses"=>"admin\PhotoController@postForm"]);
		Route::get("delete/{id}",["as"=>"admin.photo.getDelete","uses"=>"admin\PhotoController@getDelete"]);
		Route::post("sort",["as"=>"admin.photo.sort","uses"=>"admin\PhotoController@sort"]);
		Route::post("status/{status}",["as"=>"admin.photo.postStatus","uses"=>"admin\PhotoController@postStatus"]);
		Route::get("ajaxStatus/{id}/{status}",["as"=>"admin.photo.getAjaxStatus","uses"=>"admin\PhotoController@getAjaxStatus"]);
		Route::post("trash",["as"=>"admin.photo.postTrash","uses"=>"admin\PhotoController@postTrash"]);
	});	
	Route::group(["prefix"=>"article"],function(){		
		Route::get("list",["as"=>"admin.article.getList","uses"=>"admin\ArticleController@getList"]);
		Route::post("load-data",["as"=>"admin.article.loadData","uses"=>"admin\ArticleController@loadData"]);		
		Route::get("form/{task}/{id?}",["as"=>"admin.article.getForm","uses"=>"admin\ArticleController@getForm"]);
		Route::post("save",["as"=>"admin.article.save","uses"=>"admin\ArticleController@save"]);
		Route::post("delete-item",["as"=>"admin.article.deleteItem","uses"=>"admin\ArticleController@deleteItem"]);		
		Route::post("sort-order",["as"=>"admin.article.sortOrder","uses"=>"admin\ArticleController@sortOrder"]);
		Route::post("update-status",["as"=>"admin.article.updateStatus","uses"=>"admin\ArticleController@updateStatus"]);
		Route::post("change-status",["as"=>"admin.article.changeStatus","uses"=>"admin\ArticleController@changeStatus"]);
		Route::post("trash",["as"=>"admin.article.trash","uses"=>"admin\ArticleController@trash"]);
		Route::post("upload-file",["as"=>"admin.article.uploadFile","uses"=>"admin\ArticleController@uploadFile"]);
	});	
	Route::group(["prefix"=>"menu"],function(){		
		Route::match(["get","post"],"list/{menu_type_id}",["as"=>"admin.menu.getList","uses"=>"admin\MenuController@getList"]);	
		Route::get("form/{task}/{menu_type_id?}/{id?}/{component?}/{alias?}",["as"=>"admin.menu.getForm","uses"=>"admin\MenuController@getForm"]);
		Route::post("save",["as"=>"admin.menu.save","uses"=>"admin\MenuController@save"]);
		Route::get("delete-item/{id}",["as"=>"admin.menu.deleteItem","uses"=>"admin\MenuController@deleteItem"]);		
		Route::post("sort-order",["as"=>"admin.menu.sortOrder","uses"=>"admin\MenuController@sortOrder"]);
		Route::post("update-status/{status}",["as"=>"admin.menu.updateStatus","uses"=>"admin\MenuController@updateStatus"]);
		Route::post("change-status",["as"=>"admin.menu.changeStatus","uses"=>"admin\MenuController@changeStatus"]);
		Route::post("trash",["as"=>"admin.menu.trash","uses"=>"admin\MenuController@trash"]);
		Route::post("upload-file",["as"=>"admin.menu.uploadFile","uses"=>"admin\MenuController@uploadFile"]);
		Route::get("component/{menu_type_id}",["as"=>"admin.menu.getComponentForm","uses"=>"admin\MenuController@getComponentForm"]);
		Route::get("category-article-component/{menu_type_id}",["as"=>"admin.menu.getCategoryArticleComponent","uses"=>"admin\MenuController@getCategoryArticleComponent"]);
		Route::get("category-product-component/{menu_type_id}",["as"=>"admin.menu.getCategoryProductComponent","uses"=>"admin\MenuController@getCategoryProductComponent"]);
		Route::get("article-component/{menu_type_id}",["as"=>"admin.menu.getArticleComponent","uses"=>"admin\MenuController@getArticleComponent"]);
		Route::post("article-list",["as"=>"admin.menu.getArticleList","uses"=>"admin\MenuController@getArticleList"]);
	});	
	Route::group(["prefix"=>"group"],function(){		
		Route::match(["get","post"],"list",["as"=>"admin.group.getList","uses"=>"admin\GroupController@getList"]);
		Route::get("add",["as"=>"admin.group.getAdd","uses"=>"admin\GroupController@getAdd"]);
		Route::post("add",["as"=>"admin.group.postAdd","uses"=>"admin\GroupController@postAdd"]);
		Route::get("edit/{id}",["as"=>"admin.group.getEdit","uses"=>"admin\GroupController@getEdit"]);
		Route::post("edit",["as"=>"admin.group.postEdit","uses"=>"admin\GroupController@postEdit"]);
		Route::get("delete/{id}",["as"=>"admin.group.getDelete","uses"=>"admin\GroupController@getDelete"]);
	});	
	Route::group(["prefix"=>"menu-type"],function(){		
		Route::get("list",["as"=>"admin.menu-type.getList","uses"=>"admin\MenuTypeController@getList"]);
		Route::post("load-data",["as"=>"admin.menu-type.loadData","uses"=>"admin\MenuTypeController@loadData"]);		
		Route::get("form/{task}/{id?}",["as"=>"admin.menu-type.getForm","uses"=>"admin\MenuTypeController@getForm"]);
		Route::post("save",["as"=>"admin.menu-type.save","uses"=>"admin\MenuTypeController@save"]);
		Route::post("delete-item",["as"=>"admin.menu-type.deleteItem","uses"=>"admin\MenuTypeController@deleteItem"]);		
		Route::post("sort-order",["as"=>"admin.menu-type.sortOrder","uses"=>"admin\MenuTypeController@sortOrder"]);
		Route::post("update-status",["as"=>"admin.menu-type.updateStatus","uses"=>"admin\MenuTypeController@updateStatus"]);
		Route::post("change-status",["as"=>"admin.menu-type.changeStatus","uses"=>"admin\MenuTypeController@changeStatus"]);
		Route::post("trash",["as"=>"admin.menu-type.trash","uses"=>"admin\MenuTypeController@trash"]);		
	});		
	
	Route::group(["prefix"=>"module-item"],function(){		
		Route::get("list",["as"=>"admin.module-item.getList","uses"=>"admin\ModuleItemController@getList"]);
		Route::post("load-data",["as"=>"admin.module-item.loadData","uses"=>"admin\ModuleItemController@loadData"]);		
		Route::get("form/{task}/{id?}",["as"=>"admin.module-item.getForm","uses"=>"admin\ModuleItemController@getForm"]);
		Route::post("save",["as"=>"admin.module-item.save","uses"=>"admin\ModuleItemController@save"]);
		Route::post("delete-item",["as"=>"admin.module-item.deleteItem","uses"=>"admin\ModuleItemController@deleteItem"]);		
		Route::post("sort-order",["as"=>"admin.module-item.sortOrder","uses"=>"admin\ModuleItemController@sortOrder"]);
		Route::post("update-status",["as"=>"admin.module-item.updateStatus","uses"=>"admin\ModuleItemController@updateStatus"]);
		Route::post("change-status",["as"=>"admin.module-item.changeStatus","uses"=>"admin\ModuleItemController@changeStatus"]);
		Route::post("trash",["as"=>"admin.module-item.trash","uses"=>"admin\ModuleItemController@trash"]);		
		Route::post("insert-article",["as"=>"admin.module-item.insertArticle","uses"=>"admin\ModuleItemController@insertArticle"]);	
		Route::post("insert-product",["as"=>"admin.module-item.insertProduct","uses"=>"admin\ModuleItemController@insertProduct"]);	
		Route::post("sort-items",["as"=>"admin.module-item.sortItems","uses"=>"admin\ModuleItemController@sortItems"]);		
		Route::post("get-items",["as"=>"admin.module-item.getItems","uses"=>"admin\ModuleItemController@getItems"]);				
	});
	Route::group(["prefix"=>"media"],function(){		
		Route::get("list",["as"=>"admin.media.getList","uses"=>"admin\MediaController@getList"]);
		Route::post("load-data",["as"=>"admin.media.loadData","uses"=>"admin\MediaController@loadData"]);		
		Route::get("form/{task}/{id?}",["as"=>"admin.media.getForm","uses"=>"admin\MediaController@getForm"]);
		Route::post("save",["as"=>"admin.media.save","uses"=>"admin\MediaController@save"]);
		Route::post("delete-item",["as"=>"admin.media.deleteItem","uses"=>"admin\MediaController@deleteItem"]);
		Route::post("trash",["as"=>"admin.media.trash","uses"=>"admin\MediaController@trash"]);
	});	
	Route::group(["prefix"=>"group-member"],function(){		
		Route::get("list",["as"=>"admin.group-member.getList","uses"=>"admin\GroupMemberController@getList"]);
		Route::post("load-data",["as"=>"admin.group-member.loadData","uses"=>"admin\GroupMemberController@loadData"]);		
		Route::get("form/{task}/{id?}",["as"=>"admin.group-member.getForm","uses"=>"admin\GroupMemberController@getForm"]);
		Route::post("save",["as"=>"admin.group-member.save","uses"=>"admin\GroupMemberController@save"]);
		Route::post("delete-item",["as"=>"admin.group-member.deleteItem","uses"=>"admin\GroupMemberController@deleteItem"]);		
		Route::post("sort-order",["as"=>"admin.group-member.sortOrder","uses"=>"admin\GroupMemberController@sortOrder"]);		
		Route::post("trash",["as"=>"admin.group-member.trash","uses"=>"admin\GroupMemberController@trash"]);		
	});	
});
Route::match(["get","post"],"admin/login",["as"=>"admin.login","uses"=>"admin\LoginController@login"]);
Route::post("admin/logout",["as"=>"admin.logout","uses"=>"admin\LoginController@logout"]);

Route::get("/",["as"=>"frontend.index.getHome","uses"=>"frontend\IndexController@getHome"]);
Route::match(["get","post"],"{component}/{alias}.html",["as"=>"frontend.index.index","uses"=>"frontend\IndexController@index"]);
Route::match(["get","post"],"gio-hang.html",["as"=>"frontend.index.viewCart","uses"=>"frontend\IndexController@viewCart"]);
Route::match(["get","post"],"xoa-gio-hang",["as"=>"frontend.index.deleteAll","uses"=>"frontend\IndexController@deleteAll"]);
Route::match(["get","post"],"xoa/{id}",["as"=>"frontend.index.delete","uses"=>"frontend\IndexController@delete"]);
Route::match(["get","post"],"dang-ky.html",["as"=>"frontend.index.register","uses"=>"frontend\IndexController@register"]);
Route::match(["get","post"],"tai-khoan.html",["as"=>"frontend.index.viewAccount","uses"=>"frontend\IndexController@viewAccount"]);
Route::match(["get","post"],"dang-nhap.html",["as"=>"frontend.index.login","uses"=>"frontend\IndexController@login"]);
Route::match(["get","post"],"bao-mat.html",["as"=>"frontend.index.viewSecurity","uses"=>"frontend\IndexController@viewSecurity"]);
Route::match(["get","post"],"lien-he.html",["as"=>"frontend.index.contact","uses"=>"frontend\IndexController@contact"]);
Route::get("thanh-toan",["as"=>"frontend.index.checkout","uses"=>"frontend\IndexController@checkout"]);
Route::match(["get","post"],"xac-nhan-thanh-toan.html",["as"=>"frontend.index.confirmCheckout","uses"=>"frontend\IndexController@confirmCheckout"]);
Route::match(["get","post"],"dang-nhap-thanh-toan.html",["as"=>"frontend.index.loginCheckout","uses"=>"frontend\IndexController@loginCheckout"]);
Route::get("hoa-don.html",["as"=>"frontend.index.getInvoice","uses"=>"frontend\IndexController@getInvoice"]);
Route::get("lgout",["as"=>"frontend.index.getLgout","uses"=>"frontend\IndexController@getLgout"]);
Route::get("add-to-cart",["as"=>"frontend.index.addToCart","uses"=>"frontend\IndexController@addToCart"]);
Route::get("show-invoice-detail",["as"=>"frontend.index.showInvoiceDetail","uses"=>"frontend\IndexController@showInvoiceDetail"]);
Route::post("get-paymentmethod",["as"=>"frontend.index.getPaymentmethod","uses"=>"frontend\IndexController@getPaymentmethod"]);
?>