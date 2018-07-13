<?php

namespace App\Models;

/*
	Graphview generated model file.
	Made from graphview suid : H5N64UC, name : Tutorials
	You are free to adjust this file, alterations are made in the trait
 */

use App\Traits\HasShortUuid;
use App\Traits\TutorialTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tutorial extends Model {
	use HasShortUuid;
	use SoftDeletes;
	use TutorialTrait;

	public function getKeyName() {
		return 'suid';
	}

	public $prfx = 'H5N64UC';

	public $incrementing = false;

	protected $connection = '';

	protected $table = 'node_tutorials';

	protected $dates = ['deleted_at'];

	// protected $casts = [
	//     casts
	// ];

	protected $guarded = [
		'suid'
	];

}
