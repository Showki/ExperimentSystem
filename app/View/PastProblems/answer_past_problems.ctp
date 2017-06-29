<fieldset>
	<?php $time_num = (string)$times + 1; ?>
	<legend><?php echo __("第".$time_num."問"); ?></legend>
	<legend><?php echo __($problem['PastProblem']['sentence']) ?></legend>

	<?php
		echo $this->Form->create('PastProblem',array(
			'type' => 'post','url' => 'answerPastProblems')
		);

		echo $this->Form->input('title', array(
			'legend' => false,
			'type' => 'radio',
			'options' => $problem['PastProblem']['option'],
			// 'before' => '<div class="radio">',
			// 'after' => '</div>',
			'separator' => '</div><div class="radio">',
			'value' => 0,
		));

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

	debug($problem);
?>
</fieldset>

