<?php

use Faker\Generator as Faker;

$factory->define(App\Leave::class, function (Faker $faker) {
		
		$time = rand(time(), (time() + 86400*15));
        return [
        'from_date' => date( "Y-m-d", $time ),
        'to_date' => date( "Y-m-d", $time + 86400),
        'reason' => "Temp reason",
    ];
});
