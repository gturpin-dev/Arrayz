<?php

namespace Gturpin\Arrayz;

/**
 * Class Arrayz - A simple array manipulation class
 * @package Gturpin\Arrayz
 */
class Arrayz implements \Countable {
// class Arrayz implements \Stringable {
// class Arrayz implements \ArrayAccess, \IteratorAggregate, \Countable, \JsonSerializable, \Serializable, \ArrayAccess, \Stringable {

	/**
	 * The array to be manipulated
	 *
	 * @var array
	 */
	protected array $array;
	
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

	/**
	 * A shortcut to dump the array and die
	 *
	 * @return void
	 */
	public function dd() {
		$this->dump( true );
	}

	/**
	 * Get the array
	 *
	 * @return array
	 */
	public function get_array() {
		return $this->array;
	}

	public function __toString() {
		return '<pre>' . print_r( $this->array, true ) . '</pre>';
	}

	/**
	 * Count the number of elements in the array
	 *
	 * @return int
	 */
	public function count(): int {
		return count( $this->array );
	}
}