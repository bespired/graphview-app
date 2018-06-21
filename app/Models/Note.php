<?php

namespace App\Models;

/*
Graphview generated model file.
Made from graphview suid : Nn, name : Notes
 */

use Bespired\Graphview\Traits\HasShortUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model {
	use HasShortUuid;
	use SoftDeletes;

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

	// relations



}
