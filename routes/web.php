<?php
Route::group(["prefix"=>"admin"],function(){	
	Route::group(["prefix"=>"category-product"],function(){		
		Route::get("list",["as"=>"admin.category-product.getList","uses"=>"admin\CategoryProductController@getList"]);
		Route::post("load-data",["as"=>"admin.category-product.loadData","uses"=>"admin\CategoryProductController@loadData"]);		
		Route::get("form/{task}/{id?}",["as"=>"admin.category-product.getForm","uses"=>"admin\CategoryProductController@getForm"]);
		Route::post("save",["as"=>"admin.category-product.save","uses"=>"admin\CategoryProductController@save"]);
		Route::post("delete-item",["as"=>"admin.category-product.deleteItem","uses"=>"admin\CategoryProductController@deleteItem"]);
		Route::post("delete-image",["as"=>"admin.category-product.deleteImage","uses"=>"admin\CategoryProductController@deleteImage"]);
		Route::post("sort-order",["as"=>"admin.category-product.sortOrder","uses"=>"admin\CategoryProductController@sortOrder"]);
		Route::post("update-status",["as"=>"admin.category-product.updateStatus","uses"=>"admin\CategoryProductController@updateStatus"]);
		Route::post("change-status",["as"=>"admin.category-product.changeStatus","uses"=>"admin\CategoryProductController@changeStatus"]);
		Route::post("trash",["as"=>"admin.category-product.trash","uses"=>"admin\CategoryProductController@trash"]);
		Route::post("upload-file",["as"=>"admin.category-product.uploadFile","uses"=>"admin\CategoryProductController@uploadFile"]);
	});
	Route::group(["prefix"=>"product"],function(){		
		Route::get("list",["as"=>"admin.product.getList","uses"=>"admin\ProductController@getList"]);
		Route::post("load-data",["as"=>"admin.product.loadData","uses"=>"admin\ProductController@loadData"]);		
		Route::get("form/{task}/{id?}",["as"=>"admin.product.getForm","uses"=>"admin\ProductController@getForm"]);
		Route::post("save",["as"=>"admin.product.save","uses"=>"admin\ProductController@save"]);
		Route::post("delete-item",["as"=>"admin.product.deleteItem","uses"=>"admin\ProductController@deleteItem"]);
		Route::post("delete-image",["as"=>"admin.product.deleteImage","uses"=>"admin\ProductController@deleteImage"]);
		Route::post("sort-order",["as"=>"admin.product.sortOrder","uses"=>"admin\ProductController@sortOrder"]);
		Route::post("update-status",["as"=>"admin.product.updateStatus","uses"=>"admin\ProductController@updateStatus"]);
		Route::post("change-status",["as"=>"admin.product.changeStatus","uses"=>"admin\ProductController@changeStatus"]);
		Route::post("trash",["as"=>"admin.product.trash","uses"=>"admin\ProductController@trash"]);
		Route::post("upload-file",["as"=>"admin.product.uploadFile","uses"=>"admin\ProductController@uploadFile"]);
	});		
	Route::group(["prefix"=>"privilege"],function(){		
		Route::match(["get","post"],"list",["as"=>"admin.privilege.getList","uses"=>"admin\PrivilegeController@getList"]);
		Route::get("form/{task}/{id?}",["as"=>"admin.privilege.getForm","uses"=>"admin\PrivilegeController@getForm"]);
		Route::post("form/{task}",["as"=>"admin.privilege.postForm","uses"=>"admin\PrivilegeController@postForm"]);
		Route::get("delete/{id}",["as"=>"admin.privilege.getDelete","uses"=>"admin\PrivilegeController@getDelete"]);
		Route::post("ordering",["as"=>"admin.privilege.postOrdering","uses"=>"admin\PrivilegeController@postOrdering"]);
		Route::post("status/{status}",["as"=>"admin.privilege.postStatus","uses"=>"admin\PrivilegeController@postStatus"]);
		Route::get("ajaxStatus/{id}/{status}",["as"=>"admin.privilege.getAjaxStatus","uses"=>"admin\PrivilegeController@getAjaxStatus"]);
		Route::post("trash",["as"=>"admin.privilege.postTrash","uses"=>"admin\PrivilegeController@postTrash"]);
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
		Route::match(["get","post"],"list",["as"=>"admin.customer.getList","uses"=>"admin\CustomerController@getList"]);
		Route::get("form/{task}/{id?}",["as"=>"admin.customer.getForm","uses"=>"admin\CustomerController@getForm"]);
		Route::post("form/{task}",["as"=>"admin.customer.postForm","uses"=>"admin\CustomerController@postForm"]);
		Route::get("delete/{id}",["as"=>"admin.customer.getDelete","uses"=>"admin\CustomerController@getDelete"]);
		Route::post("ordering",["as"=>"admin.customer.postOrdering","uses"=>"admin\CustomerController@postOrdering"]);
		Route::post("status/{status}",["as"=>"admin.customer.postStatus","uses"=>"admin\CustomerController@postStatus"]);
		Route::get("ajaxStatus/{id}/{status}",["as"=>"admin.customer.getAjaxStatus","uses"=>"admin\CustomerController@getAjaxStatus"]);
		Route::post("trash",["as"=>"admin.customer.postTrash","uses"=>"admin\CustomerController@postTrash"]);
	});	
	Route::group(["prefix"=>"invoice"],function(){		
		Route::match(["get","post"],"list",["as"=>"admin.invoice.getList","uses"=>"admin\InvoiceController@getList"]);
		Route::get("form/{task}/{id?}",["as"=>"admin.invoice.getForm","uses"=>"admin\InvoiceController@getForm"]);
		Route::post("form/{task}",["as"=>"admin.invoice.postForm","uses"=>"admin\InvoiceController@postForm"]);
		Route::get("delete/{id}",["as"=>"admin.invoice.getDelete","uses"=>"admin\InvoiceController@getDelete"]);
		Route::post("ordering",["as"=>"admin.invoice.postOrdering","uses"=>"admin\InvoiceController@postOrdering"]);
		Route::post("status/{status}",["as"=>"admin.invoice.postStatus","uses"=>"admin\InvoiceController@postStatus"]);
		Route::get("ajaxStatus/{id}/{status}",["as"=>"admin.invoice.getAjaxStatus","uses"=>"admin\InvoiceController@getAjaxStatus"]);
		Route::post("trash",["as"=>"admin.invoice.postTrash","uses"=>"admin\InvoiceController@postTrash"]);
	});
	Route::group(["prefix"=>"user"],function(){		
		
		Route::match(["get","post"],"list",["as"=>"admin.user.getList","uses"=>"admin\UserController@getList"]);
		Route::get("form/{task}/{id?}",["as"=>"admin.user.getForm","uses"=>"admin\UserController@getForm"]);
		Route::post("form/{task}",["as"=>"admin.user.postForm","uses"=>"admin\UserController@postForm"]);
		Route::get("delete/{id}",["as"=>"admin.user.getDelete","uses"=>"admin\UserController@getDelete"]);
		Route::post("ordering",["as"=>"admin.user.postOrdering","uses"=>"admin\UserController@postOrdering"]);
		Route::post("status/{status}",["as"=>"admin.user.postStatus","uses"=>"admin\UserController@postStatus"]);
		Route::get("ajaxStatus/{id}/{status}",["as"=>"admin.user.getAjaxStatus","uses"=>"admin\UserController@getAjaxStatus"]);
		Route::post("trash",["as"=>"admin.user.postTrash","uses"=>"admin\UserController@postTrash"]);
	});	
	Route::group(["prefix"=>"category-article"],function(){		
		Route::get("list",["as"=>"admin.category-article.getList","uses"=>"admin\CategoryArticleController@getList"]);
		Route::post("load-data",["as"=>"admin.category-article.loadData","uses"=>"admin\CategoryArticleController@loadData"]);		
		Route::get("form/{task}/{id?}",["as"=>"admin.category-article.getForm","uses"=>"admin\CategoryArticleController@getForm"]);
		Route::post("save",["as"=>"admin.category-article.save","uses"=>"admin\CategoryArticleController@save"]);
		Route::post("delete-item",["as"=>"admin.category-article.deleteItem","uses"=>"admin\CategoryArticleController@deleteItem"]);
		Route::post("delete-image",["as"=>"admin.category-article.deleteImage","uses"=>"admin\CategoryArticleController@deleteImage"]);
		Route::post("sort-order",["as"=>"admin.category-article.sortOrder","uses"=>"admin\CategoryArticleController@sortOrder"]);
		Route::post("update-status",["as"=>"admin.category-article.updateStatus","uses"=>"admin\CategoryArticleController@updateStatus"]);
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
		Route::post("delete-image",["as"=>"admin.article.deleteImage","uses"=>"admin\ArticleController@deleteImage"]);
		Route::post("sort-order",["as"=>"admin.article.sortOrder","uses"=>"admin\ArticleController@sortOrder"]);
		Route::post("update-status",["as"=>"admin.article.updateStatus","uses"=>"admin\ArticleController@updateStatus"]);
		Route::post("change-status",["as"=>"admin.article.changeStatus","uses"=>"admin\ArticleController@changeStatus"]);
		Route::post("trash",["as"=>"admin.article.trash","uses"=>"admin\ArticleController@trash"]);
		Route::post("upload-file",["as"=>"admin.article.uploadFile","uses"=>"admin\ArticleController@uploadFile"]);
	});	
	Route::group(["prefix"=>"menu"],function(){		
		Route::get("list/{menu_type_id?}",["as"=>"admin.menu.getList","uses"=>"admin\MenuController@getList"]);
		Route::post("load-data",["as"=>"admin.menu.loadData","uses"=>"admin\MenuController@loadData"]);		
		Route::get("form/{task}/{menu_type_id?}/{id?}",["as"=>"admin.menu.getForm","uses"=>"admin\MenuController@getForm"]);
		Route::post("save",["as"=>"admin.menu.save","uses"=>"admin\MenuController@save"]);
		Route::post("delete-item",["as"=>"admin.menu.deleteItem","uses"=>"admin\MenuController@deleteItem"]);		
		Route::post("sort-order",["as"=>"admin.menu.sortOrder","uses"=>"admin\MenuController@sortOrder"]);
		Route::post("update-status",["as"=>"admin.menu.updateStatus","uses"=>"admin\MenuController@updateStatus"]);
		Route::post("change-status",["as"=>"admin.menu.changeStatus","uses"=>"admin\MenuController@changeStatus"]);
		Route::post("trash",["as"=>"admin.menu.trash","uses"=>"admin\MenuController@trash"]);		
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
	Route::group(["prefix"=>"module-menu"],function(){		
		Route::get("list",["as"=>"admin.module-menu.getList","uses"=>"admin\ModuleMenuController@getList"]);
		Route::post("load-data",["as"=>"admin.module-menu.loadData","uses"=>"admin\ModuleMenuController@loadData"]);		
		Route::get("form/{task}/{id?}",["as"=>"admin.module-menu.getForm","uses"=>"admin\ModuleMenuController@getForm"]);
		Route::post("save",["as"=>"admin.module-menu.save","uses"=>"admin\ModuleMenuController@save"]);
		Route::post("delete-item",["as"=>"admin.module-menu.deleteItem","uses"=>"admin\ModuleMenuController@deleteItem"]);		
		Route::post("sort-order",["as"=>"admin.module-menu.sortOrder","uses"=>"admin\ModuleMenuController@sortOrder"]);
		Route::post("update-status",["as"=>"admin.module-menu.updateStatus","uses"=>"admin\ModuleMenuController@updateStatus"]);
		Route::post("change-status",["as"=>"admin.module-menu.changeStatus","uses"=>"admin\ModuleMenuController@changeStatus"]);
		Route::post("trash",["as"=>"admin.module-menu.trash","uses"=>"admin\ModuleMenuController@trash"]);		
	});
	Route::group(["prefix"=>"module-article"],function(){		
		Route::get("list",["as"=>"admin.module-article.getList","uses"=>"admin\ModuleArticleController@getList"]);
		Route::post("load-data",["as"=>"admin.module-article.loadData","uses"=>"admin\ModuleArticleController@loadData"]);		
		Route::get("form/{task}/{id?}",["as"=>"admin.module-article.getForm","uses"=>"admin\ModuleArticleController@getForm"]);
		Route::post("save",["as"=>"admin.module-article.save","uses"=>"admin\ModuleArticleController@save"]);
		Route::post("delete-item",["as"=>"admin.module-article.deleteItem","uses"=>"admin\ModuleArticleController@deleteItem"]);		
		Route::post("sort-order",["as"=>"admin.module-article.sortOrder","uses"=>"admin\ModuleArticleController@sortOrder"]);
		Route::post("update-status",["as"=>"admin.module-article.updateStatus","uses"=>"admin\ModuleArticleController@updateStatus"]);
		Route::post("change-status",["as"=>"admin.module-article.changeStatus","uses"=>"admin\ModuleArticleController@changeStatus"]);
		Route::post("trash",["as"=>"admin.module-article.trash","uses"=>"admin\ModuleArticleController@trash"]);		
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
		Route::match(["get","post"],"list",["as"=>"admin.group-member.getList","uses"=>"admin\GroupMemberController@getList"]);
		Route::get("form/{task}/{id?}",["as"=>"admin.group-member.getForm","uses"=>"admin\GroupMemberController@getForm"]);
		Route::post("form/{task}",["as"=>"admin.group-member.postForm","uses"=>"admin\GroupMemberController@postForm"]);
		Route::get("delete/{id}",["as"=>"admin.group-member.getDelete","uses"=>"admin\GroupMemberController@getDelete"]);
		Route::post("ordering",["as"=>"admin.group-member.postOrdering","uses"=>"admin\GroupMemberController@postOrdering"]);
		Route::post("status/{status}",["as"=>"admin.group-member.postStatus","uses"=>"admin\GroupMemberController@postStatus"]);
		Route::get("ajaxStatus/{id}/{status}",["as"=>"admin.group-member.getAjaxStatus","uses"=>"admin\GroupMemberController@getAjaxStatus"]);
		Route::post("trash",["as"=>"admin.group-member.postTrash","uses"=>"admin\GroupMemberController@postTrash"]);
	});		
});
?>