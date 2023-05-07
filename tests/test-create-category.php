<?php
/**
 * PHPUnit test file - test the creation of the post category.
 *
 * @package lschuyler\Canadianize
 * @author   Lisa Schuyler
 * @license
 */

declare( strict_types = 1 );

//use lschuyler\Canadianize;

class test_category extends WP_UnitTestCase {

	/**
	 * Test the creation of the tags.
	 */
	public function test_create_category(): void {

		// Test the generate_title() method.
		$create_posts = new Canadianize\Create_Posts;
		$category = $create_posts->generate_category();
		$this->assertNotEmpty( $category );
		$this->assertIsArray( $category );

		$this->assertTrue( true );
	}
}
