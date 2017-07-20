<?php $time_num = (string)$times; ?>
<legend><?php echo __("第".$time_num."問"); ?></legend>
<div class="sentence_box">
	<?php echo __($problem['PastProblem']['sentence']) ?>
</div>

<div class="option_box">
<?php
echo $this->Form->create('AnswerResult',array(
	'type' => 'post','url' => 'edit')
);
echo $this->Form->input('select_number', array(
	'legend' => false,
	'type' => 'radio',
	'options' => $problem['PastProblem']['option'],
	'before' => '<div class="radio">',
	'after' => '</div>',
	'separator' => '</div><div class="radio">',
	'value' => $answer['AnswerResult']['select_number'],
));
echo $this->Form->hidden('AnswerResult.id',array('value' => $answer['AnswerResult']['id']));	
echo $this->Form->submit('決定',array(
	'div' 	=> false,
	'name' 	=> 'next',
    'class' => 'btn btn-success btn-lg answer_btn',
));
echo $this->Form->end();
?>
</div>