<?php

namespace App\Models;

/*
Graphview generated model file.
Made from graphview suid : Na, name : Addresses
 */

use Bespired\Graphview\Traits\HasShortUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model {
	use HasShortUuid;
	use SoftDeletes;

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

	// relations



}
