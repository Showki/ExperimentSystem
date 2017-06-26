<div class="pastProblems form">
<?php echo $this->Form->create('PastProblem'); ?>
	<fieldset>
		<legend><?php echo __('Add Past Problem'); ?></legend>
	<?php
		echo $this->Form->input('problem_number');
		echo $this->Form->input('sentence');
		echo $this->Form->input('answer');
		echo $this->Form->input('wrong_answer_1');
		echo $this->Form->input('wrong_answer_2');
		echo $this->Form->input('wrong_answer_3');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Past Problems'), array('action' => 'index')); ?></li>
	</ul>
</div>
