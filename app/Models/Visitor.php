<?php

namespace App\Models;

/*
	Graphview generated model file.
	Made from graphview suid : Nv, name : Visitors
	You are free to adjust this file, alterations are made in the trait
 */

use App\Traits\HasShortUuid;
use App\Traits\VisitorTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visitor extends Model {
	use HasShortUuid;
	use SoftDeletes;
	use VisitorTrait;

	public function getKeyName() {
		return 'suid';
	}

	public $prfx = 'Nv';

	public $incrementing = false;

	protected $connection = 'mysql';

	protected $table = 'node_visitors';

	protected $dates = ['deleted_at'];

	// protected $casts = [
	//     casts
	// ];

	protected $guarded = [
		'suid'
	];

}
