<?php

use Carbon_Fields\Carbon_Fields;
use Carbon_Field_Switch\Switch_Field;

define( 'Carbon_Field_Switch\\DIR', __DIR__ );

Carbon_Fields::extend( Switch_Field::class, function( $container ) {
	return new Switch_Field(
		$container['arguments']['type'],
		$container['arguments']['name'],
		$container['arguments']['label']
	);
} );
