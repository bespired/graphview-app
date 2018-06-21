<?php

namespace App\Traits;

/*
Graphview generated trait file.
Made from graphview suid : Nc, name : Companies
 */

trait Company {

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
