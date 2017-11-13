<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuTypeModel extends Model {

	protected $table="menu_type";
	protected $fillable=["fullname","alias","sort_order","created_at","updated_at"];		
}
