var vCategoryArticleTable=null;
var vArticleTable=null;
var vMenuTypeTable=null;
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
                { data: "created_at"    },
                { data: "updated_at"    },
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
                { data: "image"         },
                { data: "sort_order"    },
                { data: "status"        },
                { data: "created_at"    },
                { data: "updated_at"    },
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
                { data: "created_at"    },
                { data: "updated_at"    },
                { data: "edited"    },         
                { data: "deleted"    },                
            ]
        });        
    };
    return {
        init: function () {
            if (!jQuery().dataTable)
                return;        
            initCategoryArticleTable();  
            initArticleTable();
            initMenuTypeTable();
        }
    };
}();
