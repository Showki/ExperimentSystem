<div class="secondMadeProblems form">
<?php echo $this->Form->create('SecondMadeProblem'); ?>
	<fieldset>
		<legend><?php echo __('Add Second Made Problem'); ?></legend>
	<?php
		echo $this->Form->input('made_problems_id');
		echo $this->Form->input('sentence');
		echo $this->Form->input('option_1');
		echo $this->Form->input('option_2');
		echo $this->Form->input('option_3');
		echo $this->Form->input('option_4');
		echo $this->Form->input('correct_number');
		echo $this->Form->input('make_team');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Second Made Problems'), array('action' => 'index')); ?></li>
	</ul>
</div>
