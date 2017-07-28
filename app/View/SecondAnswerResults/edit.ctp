<?php $time_num = (string)$times; ?>
<legend><?php echo __("第".$time_num."問"); ?></legend>
<div class="sentence_box">
	<?php echo __($problem['SecondMadeProblem']['sentence']) ?>
</div>

<div class="option_box">
<?php
echo $this->Form->create('SecondAnswerResult',array(
	'type' => 'post','url' => 'edit')
);
echo $this->Form->input('select_number', array(
	'legend' => false,
	'type' => 'radio',
	'options' => $problem['SecondMadeProblem']['option'],
	'before' => '<div class="radio">',
	'after' => '</div>',
	'separator' => '</div><div class="radio">',
	'value' => $answer['SecondAnswerResult']['select_number'],
));
echo $this->Form->hidden('SecondAnswerResult.id',array('value' => $answer['SecondAnswerResult']['id']));	
echo $this->Form->submit('決定',array(
	'div' 	=> false,
	'name' 	=> 'next',
    'class' => 'btn btn-success btn-lg answer_btn',
));
echo $this->Form->end();
?>
</div>