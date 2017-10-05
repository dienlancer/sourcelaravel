<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model {
	protected $table 		=	"product";
	protected $fillable		=	["id","code","fullname","alias","image","status","child_image","price","detail","sort_order","created_at","updated_at"];		
}
