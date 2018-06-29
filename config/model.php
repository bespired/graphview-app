<?php
return [
	'with-all' => 
	  [
		'person' => 'companies,addresses,qualifiers,tags,notes',
		'company' => 'addresses',
		'visitor' => 'qualifiers,people',
		],
	'nodes' => 
	  [
		'visitor' => 'visitors',
		'visitors' => 'visitor',
		'person' => 'people',
		'people' => 'person',
		'company' => 'companies',
		'companies' => 'company',
		'tag' => 'tags',
		'tags' => 'tag',
		'qualifier' => 'qualifiers',
		'qualifiers' => 'qualifier',
		'address' => 'addresses',
		'addresses' => 'address',
		'note' => 'notes',
		'notes' => 'note',
		],
	'keys' => 
	  [
		'person*email' => 'email',
		'company*name' => 'name',
		'tag*name' => 'name',
		'qualifier*name' => 'name',
		'address*telephone_land' => 'telephone_land',
		'address*telephone_mobile' => 'telephone_mobile',
		],
	];