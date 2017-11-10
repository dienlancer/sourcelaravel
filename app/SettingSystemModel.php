<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingSystemModel extends Model {

	protected $table="setting_system";
	protected $fillable=["fullname","alias","content","sort_order","status","created_at","updated_at"];		
}
