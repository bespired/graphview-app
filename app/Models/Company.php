<?php

namespace App\Models;

/*
	Graphview generated model file.
	Made from graphview suid : Nc, name : Companies
	You are free to adjust this file, alterations are made in the trait
 */

use App\Traits\HasShortUuid;
use App\Traits\CompanyTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model {
	use HasShortUuid;
	use SoftDeletes;
	use CompanyTrait;

	public function getKeyName() {
		return 'suid';
	}

	public $prfx = 'Nc';

	public $incrementing = false;

	protected $connection = 'mysql';

	protected $table = 'node_companies';

	protected $dates = ['deleted_at'];

	// protected $casts = [
	//     casts
	// ];

	protected $guarded = [
		'suid'
	];

}
