<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubjectPart extends Model
{
    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }
    public function getRouteKeyName()
	{
		return 'slug';
	}
}
