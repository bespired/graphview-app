<?php

namespace App\Traits;

/*
	Graphview generated trait file.
	Made from graphview suid : H5N5D4D, name : Pages
	Don't manual change this file, alterations can be made with scafold.
 */

trait PageTrait {

	public function pages() {
		return $this
			->belongsToMany(\App\Models\Page::class, 'edge_page', 'page_id', 'page_id')
			->withPivot('suid', 'domain', 'tag', 'name');
	}
	public function tutorials() {
		return $this
			->belongsToMany(\App\Models\Tutorial::class, 'edge_page', 'page_id', 'tutorial_id')
			->withPivot('suid', 'domain', 'tag', 'name');
	}

}
