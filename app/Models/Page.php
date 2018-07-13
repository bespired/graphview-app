<?php

namespace App\Models;

/*
	Graphview generated model file.
	Made from graphview suid : H5N5D4D, name : Pages
	You are free to adjust this file, alterations are made in the trait
 */

use App\Traits\HasShortUuid;
use App\Traits\PageTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model {
	use HasShortUuid;
	use SoftDeletes;
	use PageTrait;

	public function getKeyName() {
		return 'suid';
	}

	public $prfx = 'H5N5D4D';

	public $incrementing = false;

	protected $connection = '';

	protected $table = 'node_pages';

	protected $dates = ['deleted_at'];

	// protected $casts = [
	//     casts
	// ];

	protected $guarded = [
		'suid'
	];

}
