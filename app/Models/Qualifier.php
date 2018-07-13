<?php

namespace App\Models;

/*
	Graphview generated model file.
	Made from graphview suid : Nq, name : Qualifiers
	You are free to adjust this file, alterations are made in the trait
 */

use App\Traits\HasShortUuid;
use App\Traits\QualifierTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Qualifier extends Model {
	use HasShortUuid;
	use SoftDeletes;
	use QualifierTrait;

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

}
