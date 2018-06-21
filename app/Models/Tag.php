<?php

namespace App\Models;

/*
Graphview generated model file.
Made from graphview suid : Nt, name : Tags
 */

use Bespired\Graphview\Traits\HasShortUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model {
	use HasShortUuid;
	use SoftDeletes;

	public function getKeyName() {
		return 'suid';
	}

	public $prfx = 'Nt';

	public $incrementing = false;

	protected $connection = 'mysql';

	protected $table = 'node_tags';

	protected $dates = ['deleted_at'];

	// protected $casts = [
	//     casts
	// ];

	protected $guarded = [
		'suid'
	];

	// relations



}
