<?php
class Property2nd extends AppModel{
	public $useDbConfig = 'make';
	public $name = 'Property2nd';
	public $belongsTo = array(
		'Object1id' => array(
			'className' => 'Objective',
			'foreignKey' => 'object1id'
			),
		'Object2id' => array(
			'className' => 'Objective',
			'foreignKey' => 'object2id'
			)
		);
}
?>