<?php

Route::get('_/set/postdata', function () {

	for ($i = 0; $i < 100; $i++) {
		$state = strtoupper(str_random(3));
		$fistname = array_random(config('graph.names.firstname'));
		$lastname = array_random(config('graph.names.lastname'));
		$streetname = array_random(config('graph.names.lastname'));
		$name = array_random(config('graph.names.lastname'));
		$city = ucfirst(array_random(config('graph.names.firstname')));
		$city .= array_random([' Town', ' Place', ' City']);

		$contact = [
			"_auth" => [
				"user" => "your-service",
				"key" => "abc-123",
				"token" => "456-def",
			],
			"big_persons" => [
				[
					'firstname' => $fistname . 'ia',
					'lastname' => $lastname . 'son',
					'email' => str_replace(' ', '', strtolower($lastname)) . '@mailinator.com',
				], [
					'firstname' => $fistname,
					'lastname' => $lastname,
					'gender' => array_random(['male', 'female']),
					'language' => array_random(['dutch', 'english', 'english']),
					'birthday' => \Carbon\Carbon::createFromTimestampUTC(rand(3170040, 918318840))->toDateTimeString(),
					'email' => str_replace(' ', '', strtolower($fistname . '.' . $lastname)) . '@mailinator.com',
					'created_by' => 'demodata',
					"full_addresses" => [
						[
							"tag" => "primary",
							'address' => $streetname . array_random(['street', 'lane', 'path']) . ' ' . rand(4, 400),
							'city' => $city,
							'country' => array_random(['the Netherlands', 'Arkansa', 'Quebeq', 'California']),
							'state' => $state,
							'zipcode' => rand(1100, 9999) . ' ' . strtoupper(str_random(2)),
							'created_by' => 'demodata',
						], [
							"tag" => "primary",
							'address' => $streetname . array_random(['street', 'lane', 'path']) . ' ' . rand(4, 400),
							'city' => $city,
							'country' => array_random(['the Netherlands', 'Arkansa', 'Quebeq', 'California']),
							'state' => $state,
							'zipcode' => rand(1100, 9999) . ' ' . strtoupper(str_random(2)),
							'created_by' => 'demodata',
						],
					],
					"company" => [
						'created_by' => 'demodata',
						'employee_count' => array_random([3, 10, 30, 50, 75, 100, 200, 500]),
						'name' => $name . array_random([' Co.', ' Ltd.', ' B.v.']),
						"full_address" => [
							"tag" => "company",
							'address' => $streetname . array_random(['street', 'lane', 'path']) . ' ' . rand(4, 400),
							'city' => $city,
							'country' => array_random(['the Netherlands', 'Arkansa', 'Quebeq', 'California']),
							'state' => $state,
							'zipcode' => rand(1100, 9999) . ' ' . strtoupper(str_random(2)),
							'created_by' => 'demodata',
						],
					],
				],
			],
		];

		App\Handlers\PostHandler::post(objectify($contact));
	}
});
