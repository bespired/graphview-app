<?php

namespace App\Models;

/*
	Graphview generated model file.
	Made from graphview suid : H913JJ4, name : New Tag
	You are free to adjust this file, alterations are made in the trait
 */

use App\Traits\HasShortUuid;
use App\Traits\NewTagTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewTag extends Model {
	use HasShortUuid;
	use SoftDeletes;
	use NewTagTrait;

	public function getKeyName() {
		return 'suid';
	}

	public $prfx = 'H913JJ4';

	public $incrementing = false;

	protected $connection = '';

	protected $table = 'node_new_tags';

	protected $dates = ['deleted_at'];

	// protected $casts = [
	//     casts
	// ];

	protected $guarded = [
		'suid'
	];

}
