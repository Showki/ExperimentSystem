<div class="secondAnswerResults form">
<?php echo $this->Form->create('SecondAnswerResult'); ?>
	<fieldset>
		<legend><?php echo __('Add Second Answer Result'); ?></legend>
	<?php
		echo $this->Form->input('users_id');
		echo $this->Form->input('problems_id');
		echo $this->Form->input('select_number');
		echo $this->Form->input('result');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Second Answer Results'), array('action' => 'index')); ?></li>
	</ul>
</div>
