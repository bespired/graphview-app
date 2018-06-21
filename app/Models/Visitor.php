<?php

namespace App\Models;

/*
Graphview generated model file.
Made from graphview suid : Nv, name : Visitors
 */

use Bespired\Graphview\Traits\HasShortUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visitor extends Model {
	use HasShortUuid;
	use SoftDeletes;

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

	// relations
	public function visitors() {
		return $this
			->belongsToMany(Visitor::class, 'edge_visitor', 'visitor_id', 'visitor_id')
			->withPivot('suid', 'domain', 'tag', 'name');
	}
	public function qualifiers() {
		return $this
			->belongsToMany(Qualifier::class, 'edge_visitor', 'visitor_id', 'qualifier_id')
			->withPivot('suid', 'domain', 'tag', 'name');
	}
	public function people() {
		return $this
			->belongsToMany(Person::class, 'edge_visitor', 'visitor_id', 'person_id')
			->withPivot('suid', 'domain', 'tag', 'name');
	}


}
