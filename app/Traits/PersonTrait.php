<?php

namespace App\Traits;

/*
Graphview generated trait file.
Made from graphview suid : Np, name : Persons
 */

trait Person {

	public function people() {
		return $this
			->belongsToMany(Person::class, 'edge_person', 'person_id', 'person_id')
			->withPivot('suid', 'domain', 'tag', 'name');
	}
	public function companies() {
		return $this
			->belongsToMany(Company::class, 'edge_person', 'person_id', 'company_id')
			->withPivot('suid', 'domain', 'tag', 'name');
	}
	public function addresses() {
		return $this
			->belongsToMany(Address::class, 'edge_person', 'person_id', 'address_id')
			->withPivot('suid', 'domain', 'tag', 'name');
	}
	public function qualifiers() {
		return $this
			->belongsToMany(Qualifier::class, 'edge_person', 'person_id', 'qualifier_id')
			->withPivot('suid', 'domain', 'tag', 'name');
	}
	public function tags() {
		return $this
			->belongsToMany(Tag::class, 'edge_person', 'person_id', 'tag_id')
			->withPivot('suid', 'domain', 'tag', 'name');
	}
	public function notes() {
		return $this
			->belongsToMany(Note::class, 'edge_person', 'person_id', 'note_id')
			->withPivot('suid', 'domain', 'tag', 'name');
	}

}
