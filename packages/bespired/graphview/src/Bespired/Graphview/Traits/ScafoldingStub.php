<?php

namespace Bespired\Graphview\Traits;

trait ScafoldingStub {

	private function getStub($type, $filename) {

		if (isset($this->stubs[$type])) {
			return $this->stubs[$type];
		}

		$this->stubs[$type] = file_get_contents($filename);
		return $this->stubs[$type];
	}

	private function migrationNodeFile($data) {

		$replacers = [
			'connection' => $this->build->connection,
			'suid' => $data->suid,
			'name' => $data->name,
			'migratename' => $this->migrateNodeName($data, 'class'),
			'tablename' => $this->migrateNodeName($data, 'table'),
			'properties' => $this->properties($data),
		];

		return $this->tableFiller('create_node', $replacers);

	}

	private function migrationEdgeFile($edge, $props) {

		$replacers = [
			'connection' => $this->build->connection,
			'suid' => $edge->suid,
			'name' => $edge->name,
			'migratename' => $this->migrateEdgeName($edge, 'class'),
			'tablename' => $this->migrateEdgeName($edge, 'table'),
			'properties' => join("\n", $props),
		];

		return $this->tableFiller('create_edge', $replacers);

	}

	private function scafoldConfigFile() {
		$config['nodes'] = [];
		$config['keys'] = [];

		foreach ($this->build->schema->nodes as $node) {
			$name = str_name($node->name);
			$config['nodes'][str_singular($name)] = str_plural($name);
			$config['nodes'][str_plural($name)] = str_singular($name);

			if (isset($node->props) && isset($node->props->keys)) {
				foreach ($node->props->keys as $key => $dummy) {
					$config['keys'][str_singular($name) . '*' . $key] = $key;
				}
			}
		}

		$fnd = ["  '", "array (", "  ),"];
		$rep = ["\t'", "[", "\t],"];

		$arr = str_replace("\n", "\n\t", var_export($config, true));
		$arr = str_replace($fnd, $rep, $arr);
		$arr = rtrim($arr, ')') . '];';

		$re = '/(\t\t\'([\S]+)\' \=\>)/m';
		$subst = "\t'$2' =>";
		$arr = preg_replace($re, $subst, $arr);

		$re = '/(\t  \t\'([\S]+)\' \=\> \'([\S]+)\',)/m';
		$subst = "\t\t'$2' => '$3',";

		$arr = preg_replace($re, $subst, $arr);

		return "<?php\nreturn " . $arr;

	}

	private function scafoldModelFile($node) {

		$singular_name = str_name(str_singular($node->name));
		$plural_name = str_name(str_plural($node->name));
		$className = ucFirst(camel_case($singular_name));

		$relations = [];
		if (isset($this->scafold[$node->suid])) {
			foreach ($this->scafold[$node->suid]['props'] as $relation => $dummy) {
				$relations[] = $this->model_prop($singular_name, $relation);
			}
		}

		$replacers = [
			'suid' => $node->suid,
			'name' => $node->name,
			'connection' => $this->build->connection,
			'modelname' => $className,
			'tablename' => 'node_' . $plural_name,
			'relations' => join("\n", $relations),
			'casts' => 'casts',
		];

		return $this->modelFiller('app_model', $replacers);
	}

	private function scafoldTraitFile($node) {

		$singular_name = str_name(str_singular($node->name));
		$plural_name = str_name(str_plural($node->name));
		$className = ucFirst(camel_case($singular_name));

		$relations = [];
		if (isset($this->scafold[$node->suid])) {
			foreach ($this->scafold[$node->suid]['props'] as $relation => $dummy) {
				$relations[] = $this->model_prop($singular_name, $relation);
			}
		}

		$replacers = [
			'suid' => $node->suid,
			'name' => $node->name,
			'connection' => $this->build->connection,
			'modelname' => $className,
			'tablename' => 'node_' . $plural_name,
			'relations' => join("\n", $relations),
			'casts' => 'casts',
		];

		return $this->modelFiller('app_trait', $replacers);
	}

	private function tableFiller($type, $replacers = []) {

		$defaults = ['suid', 'name', 'migratename', 'tablename', 'connection', 'properties'];

		$migrate_table = $this->migrationStub($type);
		foreach ($defaults as $key) {
			$value = array_get($replacers, $key, '');
			$migrate_table = str_replace('{{ ' . $key . ' }}', $value, $migrate_table);
		}

		return $migrate_table;

	}

	private function modelFiller($type, $replacers = []) {

		$defaults = ['suid', 'name', 'modelname', 'tablename', 'connection', 'casts', 'relations'];

		$model_file = $this->modelStub($type);
		foreach ($defaults as $key) {
			$value = array_get($replacers, $key, '');
			$model_file = str_replace('{{ ' . $key . ' }}', $value, $model_file);
		}

		return $model_file;

	}

	private function routeFiller($routes) {
		return str_replace('{{ routes }}', join("\n", $routes), $this->routeStub());
	}

	private function prop_key($name) {
		return "\t\t\t\t\t" . "\$table->string('$name')->index()->default('');";
	}

	private function prop_string($name) {
		return "\t\t\t\t\t" . "\$table->string('$name')->nullable();";
	}

	private function prop_suid($name) {
		return "\t\t\t\t\t" . "\$table->char('$name', 40)->nullable();";
	}

	private function model_prop($current, $relation) {
		$stub = [];
		$belong = sprintf("->belongsToMany(%s::class, 'edge_%s', '%s_id', '%s_id')",
			ucFirst(camel_case(str_name($relation))), $current, $current, $relation);

		$stub[] = sprintf("\tpublic function %s() {", str_plural($relation));
		$stub[] = "\t\treturn \$this";
		$stub[] = "\t\t\t" . $belong;
		$stub[] = "\t\t\t->withPivot('suid', 'domain', 'tag', 'name');";
		$stub[] = "\t}";

		return join("\n", $stub);
	}

	private function properties($node) {
		$props = [];
		if (isset($node->props->keys)) {
			foreach ($node->props->keys as $key => $type) {
				$props[] = $this->prop_key($key);
			}
		}
		if (isset($node->props->strings)) {
			foreach ($node->props->strings as $string => $type) {
				$props[] = $this->prop_string($string);
			}
		}
		return join("\n", $props);
	}
}
