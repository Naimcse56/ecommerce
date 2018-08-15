<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subcat extends Model
{
    protected $fillable = [];
		//model relation...
		public function category(){
			return $this->belongsTo('tbl_category');
		}
}
