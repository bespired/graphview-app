<?php

namespace Bespired\Graphview\Models;

use Bespired\Graphview\Traits\HasShortUuid;
use Illuminate\Database\Eloquent\Model;

class Evolution extends Model {
	use HasShortUuid;

	public function getKeyName() {
		return 'suid';
	}

	protected $connection = 'graphview';

	protected $table = 'evolutions';

	protected $casts = [
		'evolutions' => 'array',
	];

	protected $guarded = [
		'suid',
		'csrfToken',
	];
}
