<?php

namespace App\Models;

/*
Graphview generated model file.
Made from graphview suid : Nc, name : Companies
 */

use Bespired\Graphview\Traits\HasShortUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model {
	use HasShortUuid;
	use SoftDeletes;

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

	// relations
	public function companies() {
		return $this
			->belongsToMany(Company::class, 'edge_company', 'company_id', 'company_id')
			->withPivot('suid', 'domain', 'tag', 'name');
	}
	public function addresses() {
		return $this
			->belongsToMany(Address::class, 'edge_company', 'company_id', 'address_id')
			->withPivot('suid', 'domain', 'tag', 'name');
	}


}
