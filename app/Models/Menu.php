<?php

namespace App\Models;

/*
	Graphview generated model file.
	Made from graphview suid : H5N5PF3, name : Menus
	You are free to adjust this file, alterations are made in the trait
 */

use App\Traits\HasShortUuid;
use App\Traits\MenuTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model {
	use HasShortUuid;
	use SoftDeletes;
	use MenuTrait;

	public function getKeyName() {
		return 'suid';
	}

	public $prfx = 'H5N5PF3';

	public $incrementing = false;

	protected $connection = '';

	protected $table = 'node_menuses';

	protected $dates = ['deleted_at'];

	// protected $casts = [
	//     casts
	// ];

	protected $guarded = [
		'suid'
	];

}
