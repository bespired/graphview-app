<?php

namespace Bespired\Graphview\Traits;

use Bespired\Graphview\Models\Scafold as ScafoldModel;

trait ScafoldingSuid {

	private function idBySuid($suid) {

		// create table if not exists
		if (!$this->build->scafold) {
			$this->build->scafold = dictionairify(['scafolds' => [
				'ids' => [], 'names' => [], 'incs' => [],
			]]);
		}

		// create index if not exists
		if (!isset($this->build->scafold->scafolds->ids->$suid)) {
			$inc = count((array) $this->build->scafold->scafolds->ids);

			if (!isset($this->schema[$suid])) {
				dd($this);
			}

			$this->build->scafold->scafolds->ids->$suid = 1 + $inc;
			$this->build->scafold->scafolds->incs->$suid = 1;
			$this->build->scafold->scafolds->names->$suid = $this->schema[$suid]->name;
		}

		// return index
		return $this->build->scafold->scafolds->ids->$suid;

	}
	private function incBySuid($suid) {
		// works only if used after idBySuid
		return $this->build->scafold->scafolds->incs->$suid++;
	}

	//

	private function saveScafolding() {

		// create db table if not exists
		if (!$this->scafold) {
			$this->scafold = ScafoldModel::create([
				'belongs_to' => $this->build->suid,
			]);
		}
		// save table
		$this->scafold->scafolds = $this->build->scafold->scafolds;
		$this->scafold->save();

	}

}
