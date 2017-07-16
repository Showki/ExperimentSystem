<?php $time_num = (string)$times + 1; ?>
<legend><?php echo __("第".$time_num."問"); ?></legend>

<div class="sentence_box">
	<?php echo __($problem['PastProblem']['sentence']) ?>
</div>

<div class="option_box">
<?php

echo $this->Form->create('PastProblem',array(
	'type' => 'post','url' => 'answer')
);
echo $this->Form->input('select_option', array(
	'legend' => false,
	'type' => 'radio',
	'options' => $problem['PastProblem']['option'],
	'before' => '<div class="radio">',
	'after' => '</div>',
	'separator' => '<div class="radio">',
	'value' => 0,
	'div' => 'radio-icon'
));
echo $this->Form->hidden('PastProblem.times',array('value' => $times));
echo $this->Form->hidden('PastProblem.id',array('value' => $problem['PastProblem']['id']));	
echo $this->Form->submit('決定',array(
	'div' 	=> false,
	'name' 	=> 'next',
    'class' => 'btn btn-success btn-lg answer_btn',
));
echo $this->Form->end();
?>
</div>