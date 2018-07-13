<?php

namespace App\Models;

/*
	Graphview generated model file.
	Made from graphview suid : H913MD8, name : New Note
	You are free to adjust this file, alterations are made in the trait
 */

use App\Traits\HasShortUuid;
use App\Traits\NewNoteTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewNote extends Model {
	use HasShortUuid;
	use SoftDeletes;
	use NewNoteTrait;

	public function getKeyName() {
		return 'suid';
	}

	public $prfx = 'H913MD8';

	public $incrementing = false;

	protected $connection = '';

	protected $table = 'node_new_notes';

	protected $dates = ['deleted_at'];

	// protected $casts = [
	//     casts
	// ];

	protected $guarded = [
		'suid'
	];

}
