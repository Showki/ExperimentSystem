<div class="secondMadeProblems view">
<h2><?php echo __('Second Made Problem'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($secondMadeProblem['SecondMadeProblem']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Made Problems Id'); ?></dt>
		<dd>
			<?php echo h($secondMadeProblem['SecondMadeProblem']['made_problems_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sentence'); ?></dt>
		<dd>
			<?php echo h($secondMadeProblem['SecondMadeProblem']['sentence']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Option 1'); ?></dt>
		<dd>
			<?php echo h($secondMadeProblem['SecondMadeProblem']['option_1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Option 2'); ?></dt>
		<dd>
			<?php echo h($secondMadeProblem['SecondMadeProblem']['option_2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Option 3'); ?></dt>
		<dd>
			<?php echo h($secondMadeProblem['SecondMadeProblem']['option_3']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Option 4'); ?></dt>
		<dd>
			<?php echo h($secondMadeProblem['SecondMadeProblem']['option_4']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Correct Number'); ?></dt>
		<dd>
			<?php echo h($secondMadeProblem['SecondMadeProblem']['correct_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Make Team'); ?></dt>
		<dd>
			<?php echo h($secondMadeProblem['SecondMadeProblem']['make_team']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Second Made Problem'), array('action' => 'edit', $secondMadeProblem['SecondMadeProblem']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Second Made Problem'), array('action' => 'delete', $secondMadeProblem['SecondMadeProblem']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $secondMadeProblem['SecondMadeProblem']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Second Made Problems'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Second Made Problem'), array('action' => 'add')); ?> </li>
	</ul>
</div>
