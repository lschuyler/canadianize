<?php
/**
 * PHPUnit test file - test the creation of the post tags.
 *
 * @package lschuyler\Canadianize
 * @author   Lisa Schuyler
 * @license
 */

declare( strict_types = 1 );

//use lschuyler\Canadianize;

class test_tags extends WP_UnitTestCase {

	/**
	 * Test the creation of the tags.
	 */
	public function test_create_tags(): void {

		// Test the generate_title() method.
		$create_posts = new Canadianize\Create_Posts;
		$tags = $create_posts->generate_tags();
		$this->assertIsArray( $tags );
		$this->assertNotEmpty( $tags );

		$this->assertTrue( true );
	}
}
