<?php

use Gturpin\Arrayz\Arrayz;
use PHPUnit\Framework\TestCase;

class ArrayzTest extends TestCase {

	private function get_test_array() {
		return [
			'foo' => 'bar',
			'bar' => 'foo',
			'baz' => [
				'foo' => 'bar',
				'bar' => 'foo',
			],
			'red',
			'green',
			'blue',
		];
	}

	public function test_it_can_be_instantiated() {
		$array = new Arrayz( [ 'foo' => 'bar' ] );

		$this->assertInstanceOf( Arrayz::class, $array );
		$this->assertEquals( $array->getArrayCopy(), [ 'foo' => 'bar' ] );
	}

	public function test_offset_get() {
		$array = new Arrayz( $this->get_test_array() );

		$this->assertEquals( $array['foo'], 'bar' );
		$this->assertEquals( $array['baz']['bar'], 'foo' );
		$this->assertEquals( $array[0], 'red' );
		$this->assertEquals( $array[1], 'green' );
		$this->assertEquals( $array[2], 'blue' );
		
		$this->assertEquals( $array[3], null );
		$this->assertEquals( $array[-1], null );
	}

	public function test_offset_set() {
		$array = new Arrayz( $this->get_test_array() );

		$array['foo'] = 'baz';
		$array['baz']['bar'] = 'baz';
		$array[0] = 'yellow';
		$array[1] = 'purple';
		$array[2] = 'orange';

		$this->assertEquals( $array['foo'], 'baz' );
		$this->assertEquals( $array['baz']['bar'], 'baz' );
		$this->assertEquals( $array[0], 'yellow' );
		$this->assertEquals( $array[1], 'purple' );
		$this->assertEquals( $array[2], 'orange' );
	}

	public function test_get() {
		$array = new Arrayz( $this->get_test_array() );

		$this->assertEquals( $array->get(3), null );
		$this->assertEquals( $array->get(0), 'red' );
		$this->assertEquals( $array->get('foo'), 'bar' );
		$this->assertEquals( $array->get('baz'), [
			'foo' => 'bar',
			'bar' => 'foo',
		] );
		$this->assertEquals( $array->get(-1), 'blue' );
		$this->assertEquals( $array->get(-2), 'green' );
		$this->assertEquals( $array->get(-3), 'red' );
		$this->assertEquals( $array->get(-6), 'bar' );
		$this->assertEquals( $array->get(-55), null );
		$this->assertEquals( $array->get(-5), 'foo' );
	}
}