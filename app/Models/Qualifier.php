<?php

namespace App\Models;

/*
Graphview generated model file.
Made from graphview suid : Nq, name : Qualifiers
 */

use Bespired\Graphview\Traits\HasShortUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Qualifier extends Model {
	use HasShortUuid;
	use SoftDeletes;

	public function getKeyName() {
		return 'suid';
	}

	public $prfx = 'Nq';

	public $incrementing = false;

	protected $connection = 'mysql';

	protected $table = 'node_qualifiers';

	protected $dates = ['deleted_at'];

	// protected $casts = [
	//     casts
	// ];

	protected $guarded = [
		'suid'
	];

	// relations



}
