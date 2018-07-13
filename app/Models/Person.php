<?php

namespace App\Models;

/*
	Graphview generated model file.
	Made from graphview suid : Np, name : Persons
	You are free to adjust this file, alterations are made in the trait
 */

use App\Traits\HasShortUuid;
use App\Traits\PersonTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model {
	use HasShortUuid;
	use SoftDeletes;
	use PersonTrait;

	public function getKeyName() {
		return 'suid';
	}

	public $prfx = 'Np';

	public $incrementing = false;

	protected $connection = 'mysql';

	protected $table = 'node_persons';

	protected $dates = ['deleted_at'];

	// protected $casts = [
	//     casts
	// ];

	protected $guarded = [
		'suid'
	];

}
