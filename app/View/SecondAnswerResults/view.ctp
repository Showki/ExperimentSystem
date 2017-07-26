<div class="secondAnswerResults view">
<h2><?php echo __('Second Answer Result'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($secondAnswerResult['SecondAnswerResult']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Users Id'); ?></dt>
		<dd>
			<?php echo h($secondAnswerResult['SecondAnswerResult']['users_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Problems Id'); ?></dt>
		<dd>
			<?php echo h($secondAnswerResult['SecondAnswerResult']['problems_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Select Number'); ?></dt>
		<dd>
			<?php echo h($secondAnswerResult['SecondAnswerResult']['select_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Result'); ?></dt>
		<dd>
			<?php echo h($secondAnswerResult['SecondAnswerResult']['result']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($secondAnswerResult['SecondAnswerResult']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($secondAnswerResult['SecondAnswerResult']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Second Answer Result'), array('action' => 'edit', $secondAnswerResult['SecondAnswerResult']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Second Answer Result'), array('action' => 'delete', $secondAnswerResult['SecondAnswerResult']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $secondAnswerResult['SecondAnswerResult']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Second Answer Results'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Second Answer Result'), array('action' => 'add')); ?> </li>
	</ul>
</div>
