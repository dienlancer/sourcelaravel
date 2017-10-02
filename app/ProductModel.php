<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model {
	protected $table="product";
	protected $fillable=["id","code","fullname","alias","main_price","price" ,"detail","image","image_child","category_id","status","created_at","updated_at"];		
}
