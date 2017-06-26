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
		<dt><?php echo __('Answer'); ?></dt>
		<dd>
			<?php echo h($pastProblem['PastProblem']['answer']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Wrong Answer 1'); ?></dt>
		<dd>
			<?php echo h($pastProblem['PastProblem']['wrong_answer_1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Wrong Answer 2'); ?></dt>
		<dd>
			<?php echo h($pastProblem['PastProblem']['wrong_answer_2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Wrong Answer 3'); ?></dt>
		<dd>
			<?php echo h($pastProblem['PastProblem']['wrong_answer_3']); ?>
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
