<?php

namespace Gturpin\Arrayz;

/**
 * Class Arrayz - A simple array manipulation class
 * @package Gturpin\Arrayz
 */
class Arrayz implements \ArrayAccess, \IteratorAggregate, \Countable {
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
			$key   = absint( $key ) - 1;
			$array = array_reverse( $this->array );
			$array = array_values( $array );

			return $array[ $key ] ?? $default;
		}

		return $this->offsetExists( $key ) ? $this->offsetGet( $key ) : $default;
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

	/**
	 * @see https://www.php.net/manual/en/arrayaccess.offsetexists.php
	 */
	public function offsetExists( $offset ): bool {
		return isset( $this->array[ $offset ] );
	}

	/**
	 * @see https://www.php.net/manual/en/arrayaccess.offsetget.php
	 */
	public function offsetGet( $offset ) {
		if ( $this->offsetExists( $offset ) ) {
			return $this->array[ $offset ];
		}
		
		return null;
	}

	/**
	 * @see https://www.php.net/manual/en/arrayaccess.offsetset.php
	 */
	public function offsetSet( $offset, $value ): void {
		if ( is_null( $offset ) ) {
			$this->array[] = $value;
		} else {
			$this->array[ $offset ] = $value;
		}
	}

	/**
	 * @see https://www.php.net/manual/en/arrayaccess.offsetunset.php
	 */
	public function offsetUnset( $offset ): void {
		unset( $this->array[ $offset ] );
	}
}