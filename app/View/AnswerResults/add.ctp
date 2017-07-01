<div class="answerResults form">
<?php echo $this->Form->create('AnswerResult'); ?>
	<fieldset>
		<legend><?php echo __('Add Answer Result'); ?></legend>
	<?php
		echo $this->Form->input('past_problems_id');
		echo $this->Form->input('select_number');
		echo $this->Form->input('result');
		echo $this->Form->input('type');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Answer Results'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Past Problems'), array('controller' => 'past_problems', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Past Problems'), array('controller' => 'past_problems', 'action' => 'add')); ?> </li>
	</ul>
</div>
