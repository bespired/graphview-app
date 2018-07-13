<?php

namespace App\Models;

/*
	Graphview generated model file.
	Made from graphview suid : Nt, name : Tags
	You are free to adjust this file, alterations are made in the trait
 */

use App\Traits\HasShortUuid;
use App\Traits\TagTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model {
	use HasShortUuid;
	use SoftDeletes;
	use TagTrait;

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

}
