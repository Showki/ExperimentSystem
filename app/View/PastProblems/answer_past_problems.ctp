<fieldset>
	<legend><?php echo __('Add Past Problem'); ?></legend>
<?php
	debug($problem);
	echo $this->Form->create('PastProblem',array(
		'type' => 'post','url' => 'answerPastProblems')
		);
	echo $this->Form->hidden('PastProblem.times',array('value' => $times));

	echo $this->Form->submit('戻る',array(
		'div' => false,
		// 'class' => false,
		'name' => 'back'
	));
	echo $this->Form->submit('進む',array(
		'div' 	=> false,
		// 'class' => false,
		'name' 	=> 'next'
	));

	echo $this->Form->end();
?>
</fieldset>

