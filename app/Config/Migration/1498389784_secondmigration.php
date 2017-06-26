<?php
class SecondMigration extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'secondMigration';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
			'create_field' => array(
				'users' => array(
					'test' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'utf8_esperanto_ci', 'charset' => 'utf8', 'after' => 'name'),
				),
			),
		),
		'down' => array(
			'drop_field' => array(
				'users' => array('test'),
			),
		),
	);

/**
 * Before migration callback
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
	public function before($direction) {
		return true;
	}

/**
 * After migration callback
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
	public function after($direction) {
		return true;
	}
}
