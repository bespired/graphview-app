<?php

namespace App\Traits;

/*
	Graphview generated trait file.
	Made from graphview suid : H5N64UC, name : Tutorials
	Don't manual change this file, alterations can be made with scafold.
 */

trait TutorialTrait {

	public function tutorials() {
		return $this
			->belongsToMany(\App\Models\Tutorial::class, 'edge_tutorial', 'tutorial_id', 'tutorial_id')
			->withPivot('suid', 'domain', 'tag', 'name');
	}
	public function menus() {
		return $this
			->belongsToMany(\App\Models\Menu::class, 'edge_tutorial', 'tutorial_id', 'menu_id')
			->withPivot('suid', 'domain', 'tag', 'name');
	}

}
