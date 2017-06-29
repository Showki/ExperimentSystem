<div class="pastProblems view">
<h2><?php echo __('Past Problem'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($pastProblem['PastProblem']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Problem Number'); ?></dt>
		<dd>
			<?php echo h($pastProblem['PastProblem']['problem_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sentence'); ?></dt>
		<dd>
			<?php echo h($pastProblem['PastProblem']['sentence']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Option 1'); ?></dt>
		<dd>
			<?php echo h($pastProblem['PastProblem']['option_1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Option 2'); ?></dt>
		<dd>
			<?php echo h($pastProblem['PastProblem']['option_2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Option 3'); ?></dt>
		<dd>
			<?php echo h($pastProblem['PastProblem']['option_3']); ?>
			&nbsp;
		</dd>

		<dt><?php echo __('Option 4'); ?></dt>
		<dd>
			<?php echo h($pastProblem['PastProblem']['option_4']); ?>
			&nbsp;
		</dd>

		<dt><?php echo __('correct_number'); ?></dt>
		<dd>
			<?php echo h($pastProblem['PastProblem']['correct_number']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Past Problem'), array('action' => 'edit', $pastProblem['PastProblem']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Past Problem'), array('action' => 'delete', $pastProblem['PastProblem']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $pastProblem['PastProblem']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Past Problems'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Past Problem'), array('action' => 'add')); ?> </li>
	</ul>
</div>
