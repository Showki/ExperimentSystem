<?php
class AddTest extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'addTest';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
			'create_table' => array(
				'categories' => array(
					'id' => array(
						'type'    =>'string',
						'null'    => false,
						'default' => null,
						'length'  => 36,
						'key'     => 'primary'
					),
					'name' => array(
						'type'    =>'string',
						'null'    => false,
						'default' => null
					),
					'indexes' => array(
						'PRIMARY' => array(
							'column' => 'id',
							'unique' => 1
						)
					)
    			)
			)
		),
		'down' => array(
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
