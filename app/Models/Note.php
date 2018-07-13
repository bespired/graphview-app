<?php

namespace App\Models;

/*
	Graphview generated model file.
	Made from graphview suid : Nn, name : Notes
	You are free to adjust this file, alterations are made in the trait
 */

use App\Traits\HasShortUuid;
use App\Traits\NoteTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model {
	use HasShortUuid;
	use SoftDeletes;
	use NoteTrait;

	public function getKeyName() {
		return 'suid';
	}

	public $prfx = 'Nn';

	public $incrementing = false;

	protected $connection = 'mysql';

	protected $table = 'node_notes';

	protected $dates = ['deleted_at'];

	// protected $casts = [
	//     casts
	// ];

	protected $guarded = [
		'suid'
	];

}
