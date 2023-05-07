<?php
/**
 * PHPUnit test file - test the creation of the post title.
 *
 * @package lschuyler\Canadianize
 * @author   Lisa Schuyler
 * @license
 */

declare( strict_types = 1 );

//use lschuyler\Canadianize;

class test extends WP_UnitTestCase {

	/**
	 * Test the title creation.
	 */
	public function test_create_title(): void {

		// Test the generate_title() method.
		$create_posts = new Canadianize\Create_Posts;
		$title = $create_posts->generate_title();
		$this->assertIsString( $title );
		$this->assertNotEmpty( $title );
		$this->assertLessThanOrEqual( 150, strlen( $title ) );

		$this->assertTrue( true );
	}
}
