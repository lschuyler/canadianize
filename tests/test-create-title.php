<?php
/**
 * PHPUnit test file.
 *
 * @package lschuyler\Canadianize
 * @author   Lisa Schuyler
 * @license
 */

declare( strict_types = 1 );

//use lschuyler\Canadianize;

class test extends WP_UnitTestCase {

	/**
	 * A single example test.
	 */
	public function test_createposts() {

		// Test the generate_title() method.
		$create_posts = new Canadianize\Create_Posts;
		$title = $create_posts->generate_title();
		$this->assertIsString( $title );
		$this->assertNotEmpty( $title );
		$this->assertLessThanOrEqual( 150, strlen( $title ) );

		$this->assertTrue( true );
	}
}
