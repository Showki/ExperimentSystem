<?php $time_num = (string)$times + 1; ?>
<legend><?php echo __("第".$time_num."問"); ?></legend>
<legend><?php echo __($problem['PastProblem']['sentence']) ?></legend>

<?php
echo $this->Form->create('AnswerResult',array(
	'type' => 'post','url' => 'edit')
);
echo $this->Form->input('select_number', array(
	'legend' => false,
	'type' => 'radio',
	'options' => $problem['PastProblem']['option'],
	// 'before' => '<div class="radio">',
	// 'after' => '</div>',
	'separator' => '</div><div class="radio">',
	'value' => $answer['AnswerResult']['select_number'],
));
echo $this->Form->hidden('AnswerResult.id',array('value' => $answer['AnswerResult']['id']));	
echo $this->Form->submit('決定',array(
	'div' 	=> false,
	'name' 	=> 'next',
	// 'class' => false
));
echo $this->Form->end();