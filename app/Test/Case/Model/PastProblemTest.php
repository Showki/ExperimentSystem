<?php
App::uses('PastProblem', 'Model');

/**
 * PastProblem Test Case
 */
class PastProblemTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.past_problem'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PastProblem = ClassRegistry::init('PastProblem');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PastProblem);

		parent::tearDown();
	}

}
