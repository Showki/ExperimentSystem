<?php $time_num = (string)$times + 1; ?>
<legend><?php echo __("第".$time_num."問"); ?></legend>
<legend><?php echo __($problem['PastProblem']['sentence']) ?></legend>

<?php
echo $this->Form->create('PastProblem',array(
	'type' => 'post','url' => 'answerPastProblems')
);
echo $this->Form->input('select_option', array(
	'legend' => false,
	'type' => 'radio',
	'options' => $problem['PastProblem']['option'],
	// 'before' => '<div class="radio">',
	// 'after' => '</div>',
	'separator' => '</div><div class="radio">',
	'value' => 0,
));
echo $this->Form->hidden('PastProblem.times',array('value' => $times));
echo $this->Form->hidden('PastProblem.id',array('value' => $problem['PastProblem']['id']));	
echo $this->Form->submit('決定',array(
	'div' 	=> false,
	'name' 	=> 'next',
	// 'class' => false
));
echo $this->Form->end();
?>