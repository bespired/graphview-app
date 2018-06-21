<?php

namespace App\Traits;

/*
Graphview generated trait file.
Made from graphview suid : Nv, name : Visitors
 */

trait Visitor {

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
