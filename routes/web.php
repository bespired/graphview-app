<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/suid', function () {
	$dub = [];
	// echo '<pre>';
	$b = new \Bespired\Graphview\Models\Building();
	for ($k = 0; $k < 20; $k++) {
		for ($j = 0; $j < 200; $j++) {
			for ($i = 0; $i < 50; $i++) {

				$u = $b::uuid();

				echo ' ' . $u;
				if (isset($dub[$u])) {
					dd('double!');
				}
				$dub[$u] = $u;

				\DB::table('test')->insert(['code' => $u]);

			}
			echo "<br>";
			usleep($j);
		}
		sleep(1);
	}

});

Route::get('/', function () {
	return view('welcome');
});

@include_once "graph.php";
@include_once "faker.php";