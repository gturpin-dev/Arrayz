<?php

namespace Gturpin\Arrayz;

/**
 * Class Arrayz - A simple array manipulation class
 * @package Gturpin\Arrayz
 */
class Arrayz {

	/**
	 * The array to be manipulated
	 *
	 * @var array
	 */
	private array $array;
	
	/**
	 * @param mixed|array $array The array to model or the value to wrap
	 */
	public function __construct( array $array = [] ) {
		$this->array = is_array( $array ) ? $array : [ $array ];
	}

	/**
	 * Dump the array
	 * 
	 * @param bool $die Whether to die after dumping
	 *
	 * @return void
	 */
	public function dump( bool $die = false ) {
		echo '<pre>' . print_r( $this->array, true ) . '</pre>';

		if ( $die ) {
			die;
		}
	}
}