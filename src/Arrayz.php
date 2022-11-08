<?php

namespace Gturpin\Arrayz;

/**
 * Class Arrayz - A simple array manipulation class
 * @package Gturpin\Arrayz
 */
class Arrayz extends \ArrayObject implements \ArrayAccess, \IteratorAggregate, \Countable, \Serializable {

	/**
	 * Dump the array
	 * 
	 * @param bool $die Whether to die after dumping
	 *
	 * @return void
	 */
	public function dump( bool $die = false ) {
		echo '<pre>' . print_r( $this->getArrayCopy(), true ) . '</pre>';

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
	 * Alias for getArrayCopy()
	 *
	 * @return array
	 */
	public function to_array() {
		return $this->getArrayCopy();
	}

	/**
	 * Get the array key, or the default value if the key does not exist
	 * The key can be a string or an integer (negative or positive) negative integers are used to get the key from the end of the array
	 * 
	 * @param int|string $key The key to get
	 * @param mixed $default The default value to return if the key does not exist
	 * 
	 * @return mixed The value of the key or the default value
	 */
	public function get( $key, $default = null ) {
		if ( ! is_string( $key ) && ! is_int( $key ) ) return $default;

		// Only for negative indexes
		if ( is_int( $key ) && $key < 0 ) {
			$key   = abs( $key ) - 1;
			$array = array_reverse( $this->getArrayCopy() );
			$array = array_values( $array );

			return $array[ $key ] ?? $default;
		}

		return $this->offsetExists( $key ) ? $this->offsetGet( $key ) : $default;
	}

	/**
	 * @return string
	 */
	public function __toString() {
		return '<pre>' . print_r( $this->getArrayCopy(), true ) . '</pre>';
	}

	/**
	 * @see https://www.php.net/manual/en/arrayaccess.offsetget.php
	 */
	public function offsetGet( $offset ) {
		if ( $this->offsetExists( $offset ) ) {
			return $this->getArrayCopy()[ $offset ];
		}
		
		return null;
	}
}