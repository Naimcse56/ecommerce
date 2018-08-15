<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $fillable = [];
		//model realtion
		public function subcategories(){
			return $this->hasMany('tbl_sub_category');
		}
}
