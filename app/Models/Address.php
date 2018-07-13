<?php

namespace App\Models;

/*
	Graphview generated model file.
	Made from graphview suid : Na, name : Addresses
	You are free to adjust this file, alterations are made in the trait
 */

use App\Traits\HasShortUuid;
use App\Traits\AddressTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model {
	use HasShortUuid;
	use SoftDeletes;
	use AddressTrait;

	public function getKeyName() {
		return 'suid';
	}

	public $prfx = 'Na';

	public $incrementing = false;

	protected $connection = 'mysql';

	protected $table = 'node_addresses';

	protected $dates = ['deleted_at'];

	// protected $casts = [
	//     casts
	// ];

	protected $guarded = [
		'suid'
	];

}
