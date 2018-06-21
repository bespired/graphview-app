<?php

namespace Bespired\Graphview\Models;

use Bespired\Graphview\Models\Evolution;
use Bespired\Graphview\Models\Scafold;
use Bespired\Graphview\Traits\HasShortUuid;
use Illuminate\Database\Eloquent\Model;

class Building extends Model {
	use HasShortUuid;

	public function getKeyName() {
		return 'suid';
	}

	protected $connection = 'graphview';

	protected $table = 'buildings';

	protected $casts = [
		'schema' => 'array',
	];

	protected $guarded = [
		'suid',
		'csrfToken',
	];

	public function evolution() {
		return $this->hasMany(Evolution::class, 'belongs_to', 'suid');
	}

	public function scafold() {
		return $this->hasOne(Scafold::class, 'belongs_to', 'suid');
	}

}
