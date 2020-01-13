<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
	public function grade()
	{
		return $this->belongsTo('App\Grade');
	}

	public function subject_parts()
	{
	    return $this->hasMany('App\SubjectPart');
	}

	public function subject_sections()
	{
	    return $this->hasMany('App\SubjectSection');
	}

	public function getRouteKeyName()
	{
		return 'slug';
	}
}
