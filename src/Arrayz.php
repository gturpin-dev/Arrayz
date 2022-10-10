<?php

namespace Gturpin\Arrayz;

/**
 * Class Arrayz - A simple array manipulation class
 * @package Gturpin\Arrayz
 */
class Arrayz implements \IteratorAggregate, \Countable {
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
	public function to_array() {
		return $this->array;
	}

	/**
	 * @return string
	 */
	public function __toString() {
		return '<pre>' . print_r( $this->array, true ) . '</pre>';
	}

	/**
	 * @see https://www.php.net/manual/en/countable.count.php
	 */
	public function count(): int {
		return count( $this->array );
	}

	/**
	 * @see https://www.php.net/manual/en/iteratoraggregate.getiterator.php
	 * @see https://www.php.net/manual/en/class.arrayiterator.php
	 */
	public function getIterator(): \ArrayIterator {
		return new \ArrayIterator( $this->array );
	}
}