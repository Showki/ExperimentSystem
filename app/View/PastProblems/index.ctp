<div class="pastProblems index">
	<h2><?php echo __('Past Problems'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('problem_number'); ?></th>
			<th><?php echo $this->Paginator->sort('sentence'); ?></th>
			<th><?php echo $this->Paginator->sort('answer'); ?></th>
			<th><?php echo $this->Paginator->sort('wrong_answer_1'); ?></th>
			<th><?php echo $this->Paginator->sort('wrong_answer_2'); ?></th>
			<th><?php echo $this->Paginator->sort('wrong_answer_3'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($pastProblems as $pastProblem): ?>
	<tr>
		<td><?php echo h($pastProblem['PastProblem']['id']); ?>&nbsp;</td>
		<td><?php echo h($pastProblem['PastProblem']['problem_number']); ?>&nbsp;</td>
		<td><?php echo h($pastProblem['PastProblem']['sentence']); ?>&nbsp;</td>
		<td><?php echo h($pastProblem['PastProblem']['answer']); ?>&nbsp;</td>
		<td><?php echo h($pastProblem['PastProblem']['wrong_answer_1']); ?>&nbsp;</td>
		<td><?php echo h($pastProblem['PastProblem']['wrong_answer_2']); ?>&nbsp;</td>
		<td><?php echo h($pastProblem['PastProblem']['wrong_answer_3']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $pastProblem['PastProblem']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $pastProblem['PastProblem']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $pastProblem['PastProblem']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $pastProblem['PastProblem']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Past Problem'), array('action' => 'add')); ?></li>
	</ul>
</div>
