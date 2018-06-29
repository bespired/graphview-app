<?php

namespace App\Handlers;

use Bespired\Graphview\Traits\HasShortUuid;

class PostHandler {
	use HasShortUuid;
	protected static $nodes;

	public static function keyed($data) {

		// remove auth, it's on the todo
		if (isset($data->_auth)) {
			$auth = $data->_auth;
			unset($data->_auth);
		}

		foreach ($data as $key => $arr_or_prop_or_node) {

			if (is_array($arr_or_prop_or_node)) {
				dd($key);
			}

			dd(is_array($arr_or_prop_or_node));

		}

		if (isset($auth)) {
			$data->auth = $auth;
		}

		return $data;
	}

	private static function aopon() {

	}

	public static function post($data) {

		// remove auth, it's on the todo
		if (isset($data->_auth)) {
			unset($data->_auth);
		}

		// remove tree.
		self::flatten($data);

		// save models.
		self::save();

		// write pivots.
		self::sync();

//		dd(self::$nodes);

		// done.
		dump(self::$nodes);
	}

	private static function flatten($data) {
		$nodes = [];

		$dots = array_dot(arrays($data));

		foreach ($dots as $key => $value) {
			$split = explode('.', $key);
			$property = array_pop($split);
			$path = self::traverse($split);

			$traverse = join('.', $split);
			$type = array_pop($split);
			if (is_numeric($type)) {
				$type = array_pop($split);
			}
			$nodes[$traverse]['node'][$property] = $value;
			$nodes[$traverse]['type'] = str_singular($type);
			$nodes[$traverse]['path'] = $path;
			$nodes[$traverse]['depth'] = count($split);
		}

		uasort($nodes, function ($a, $b) {
			return $a['depth'] > $b['depth'];
		});

		self::$nodes = $nodes;
	}

	private static function traverse($split) {
		foreach ($split as $key => $value) {
			if (is_numeric($value)) {
				$split[$key] = sprintf('(%s)=>', $value);
			}
		}
		$traverse = rtrim(str_replace(['=>=>', '=>('], ['=>', '('], join('=>', $split)), '=>');
		return str_replace(['(', ')'], ['.', ''], $traverse);
	}

	private static function keys() {
		$domain = '*';
		$nodes = self::$nodes;
		$keyname = 'suid';
		foreach ($nodes as $key => $node) {
			// if no suid is set
			if (!isset($node['node'][$keyname])) {
				// see if node has keys
				foreach ($node['node'] as $prop => $value) {
					// only if possible key has a value
					if (($value) && ($value != '')) {
						// if the property with value is a key
						if (self::is_key($node['type'] . '*' . $prop)) {
							// if the property with value is a key then find out if already exists
							$Class = '\\App\\Models\\' . ucFirst(camel_case($node['type']));
							$model = $Class::where($prop, $value)
								->where('domain', $domain)
								->first();
							// if the model exists get the id
							if ($model) {
								$nodes[$key]['node'][$keyname] = $model->{$keyname};
								// if ($node['depth'] == 0) {
								// 	dd($nodes);
								// }
							}
						}
					}
				}
			}
		}
		self::$nodes = $nodes;
	}

	private static function save() {
		$nodes = self::$nodes;
		$keyname = 'suid';
		foreach ($nodes as $key => $node) {
			$Class = '\\App\\Models\\' . ucFirst(camel_case($node['type']));
			if (!isset($node['node'][$keyname])) {
				$nodes[$key]['mode'] = 'create';
				$model = $Class::create($nodes[$key]['node']);
				$nodes[$key]['node'][$keyname] = $model[$keyname];
			} else {
				$nodes[$key]['mode'] = 'update';
				$model = $Class::find($nodes[$key]['node'][$keyname]);
				$model->update($nodes[$key]['node']);
			}
		}
		self::$nodes = $nodes;
	}

	private static function edge_uid($from_id, $dest_id) {
		return substr($from_id, 2) . '-' . substr($dest_id, 2);
	}

	private static function is_key($name) {
		return is_config('model.keys.%s', str_singular($name));
	}

	private static function sync() {
		$nodes = self::$nodes;
		$keyname = 'suid';
		foreach ($nodes as $key => $node) {
			if ($node['depth'] > 0) {
				$split = explode('=>', $node['path']);
				$dest = join('.', $split);
				array_pop($split);

				$from_node = $nodes[join('.', $split)];
				$dest_node = $nodes[$dest];

				$from_id = $from_node['node']['suid'];
				$from_type = $from_node['type'];
				$from_key = $from_type . '_id';
				$edge_name = 'edge_' . $from_type;

				$dest_id = $dest_node['node']['suid'];
				$dest_type = $dest_node['type'];
				$dest_key = $dest_type . '_id';

				$edge_uid = self::edge_uid($from_id, $dest_id);

				// todo : connection
				if (!\DB::table($edge_name)->where('suid', $edge_uid)->first()) {
					\DB::table($edge_name)
						->insert([
							'suid' => $edge_uid,
							$from_key => $from_id,
							$dest_key => $dest_id,
							'created_by' => 'create',
							'created_at' => new \DateTime(),
							'updated_at' => new \DateTime(),
						]);
				} else {
					\DB::table($edge_name)
						->update([
							'created_by' => 'update',
							'updated_at' => new \DateTime(),
						]);
				}
			}
		}
		self::$nodes = $nodes;
	}
}
// npso8er0-if614rih

// http://graphview.local/_/set/%7B%22_auth%22:%7B%22user%22:%22your-service%22,%22key%22:%22dummy-key%22,%22token%22:%22fake-token%22%7D,%22person%22:%7B%22firstname%22:%22Janelle%22,%22lastname%22:%22Hartman%22,%22gender%22:%22female%22,%22language%22:%22english%22,%22birthday%22:%221981-07-17%2008:50:04.000000%22,%22email%22:%22janelle.hartman@mailinator.com%22,%22created_by%22:%22demodata%22,%22addresses%22:[%7B%22tag%22:%22primary%22,%22address%22:%22Stevenslane%20351%22,%22city%22:%22Kristen%20City%22,%22country%22:%22the%20Netherlands%22,%22state%22:%22GBW%22,%22zipcode%22:%229404%20GH%22,%22created_by%22:%22demodata%22%7D,%7B%22tag%22:%22secondary%22,%22address%22:%22Stevenslane%20351%22,%22city%22:%22Kristen%20City%22,%22country%22:%22the%20Netherlands%22,%22state%22:%22GBW%22,%22zipcode%22:%229404%20GH%22,%22created_by%22:%22demodata%22%7D],%22company%22:%7B%22created_by%22:%22demodata%22,%22employee_count%22:30,%22name%22:%22Brady%20B.v.%22,%22address%22:%7B%22tag%22:%22company%22,%22address%22:%22Stevensstreet%20281%22,%22city%22:%22Kristen%20City%22,%22country%22:%22Quebeq%22,%22state%22:%22GBW%22,%22zipcode%22:%229190%20ZE%22,%22created_by%22:%22demodata%22%7D%7D%7D%7D
