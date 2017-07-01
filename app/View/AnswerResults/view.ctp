<div class="answerResults view">
<h2><?php echo __('Answer Result'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($answerResult['AnswerResult']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Past Problems'); ?></dt>
		<dd>
			<?php echo $this->Html->link($answerResult['PastProblems']['id'], array('controller' => 'past_problems', 'action' => 'view', $answerResult['PastProblems']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Select Number'); ?></dt>
		<dd>
			<?php echo h($answerResult['AnswerResult']['select_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Result'); ?></dt>
		<dd>
			<?php echo h($answerResult['AnswerResult']['result']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($answerResult['AnswerResult']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($answerResult['AnswerResult']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($answerResult['AnswerResult']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Answer Result'), array('action' => 'edit', $answerResult['AnswerResult']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Answer Result'), array('action' => 'delete', $answerResult['AnswerResult']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $answerResult['AnswerResult']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Answer Results'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Answer Result'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Past Problems'), array('controller' => 'past_problems', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Past Problems'), array('controller' => 'past_problems', 'action' => 'add')); ?> </li>
	</ul>
</div>
