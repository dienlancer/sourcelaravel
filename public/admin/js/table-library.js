var vCategoryArticleTable=null;
var vArticleTable=null;
var vMenuTypeTable=null;
var vMenuTable=null;
var vCategoryProductTable=null;
var vProductTable=null;
var vModuleMenuTable=null;
var vModuleArticleTable=null;
var basicTable = function () {
    var initCategoryArticleTable = function () {
        vCategoryArticleTable = $('#tbl-category-article').DataTable({
            columns: [                
                { data: "checked"            },
                { data: "fullname"      },
                { data: "alias"         },
                { data: "parent_fullname"     },
                { data: "image"         },
                { data: "sort_order"    },
                { data: "status"        },                            
                { data: "edited"    },         
                { data: "deleted"    },                
            ]
        });        
    };
    var initArticleTable = function () {
        vArticleTable = $('#tbl-article').DataTable({
            columns: [                
                { data: "checked"            },
                { data: "fullname"      },
                { data: "alias"      },
                { data: "image"         },
                { data: "sort_order"    },
                { data: "status"        },                                
                { data: "edited"    },         
                { data: "deleted"    },                
            ]
        });        
    };
    var initMenuTypeTable = function () {
        vMenuTypeTable = $('#tbl-menu-type').DataTable({
            columns: [                
                { data: "checked"            },
                { data: "fullname"      },               
                { data: "sort_order"    },                                                
                { data: "edited"    },         
                { data: "deleted"    },                
            ]
        });        
    };
    var initMenuTable = function () {
        vMenuTable = $('#tbl-menu').DataTable({
            columns: [                
                { data: "checked"            },
                { data: "fullname"      },               
                { data: "sort_order"    },   
                { data: "status"        },                                        
                { data: "edited"    },         
                { data: "deleted"    },                
            ]
        });        
    };
    var initCategoryProductTable = function () {
        vCategoryProductTable = $('#tbl-category-product').DataTable({
            columns: [                
                { data: "checked"            },
                { data: "fullname"      },
                { data: "alias"         },
                { data: "parent_fullname"     },
                { data: "image"         },
                { data: "sort_order"    },
                { data: "status"        },                            
                { data: "edited"    },         
                { data: "deleted"    },                
            ]
        });        
    };
    var initProductTable = function () {
        vProductTable = $('#tbl-product').DataTable({
            columns: [                
                { data: "checked"       },
                { data: "fullname"      },
                { data: "alias"         },
                { data: "image"         },
                { data: "sort_order"    },
                { data: "status"        },                                
                { data: "edited"        },         
                { data: "deleted"       },                
            ]
        });        
    };
    var initModuleMenuTable = function () {
        vModuleMenuTable = $('#tbl-module-menu').DataTable({
            columns: [                
                { data: "checked"       },
                { data: "fullname"      },
                { data: "position"      },                
                { data: "sort_order"    },
                { data: "status"        },                                
                { data: "edited"        },         
                { data: "deleted"       },                
            ]
        });        
    };
    var initModuleArticleTable = function () {
        vModuleArticleTable = $('#tbl-module-article').DataTable({
            columns: [                
                { data: "checked"       },
                { data: "fullname"      },
                { data: "position"      },                
                { data: "sort_order"    },
                { data: "status"        },                                
                { data: "edited"        },         
                { data: "deleted"       },                
            ]
        });        
    };
    return {
        init: function () {
            if (!jQuery().dataTable)
                return;        
            initCategoryArticleTable();  
            initCategoryProductTable();  
            initArticleTable();
            initProductTable();
            initMenuTypeTable();
            initMenuTable();
            initModuleMenuTable();
            initModuleArticleTable();
        }
    };
}();
