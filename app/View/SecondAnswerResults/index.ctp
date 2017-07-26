<div class="secondAnswerResults index">
	<h2><?php echo __('Second Answer Results'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('users_id'); ?></th>
			<th><?php echo $this->Paginator->sort('problems_id'); ?></th>
			<th><?php echo $this->Paginator->sort('select_number'); ?></th>
			<th><?php echo $this->Paginator->sort('result'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($secondAnswerResults as $secondAnswerResult): ?>
	<tr>
		<td><?php echo h($secondAnswerResult['SecondAnswerResult']['id']); ?>&nbsp;</td>
		<td><?php echo h($secondAnswerResult['SecondAnswerResult']['users_id']); ?>&nbsp;</td>
		<td><?php echo h($secondAnswerResult['SecondAnswerResult']['problems_id']); ?>&nbsp;</td>
		<td><?php echo h($secondAnswerResult['SecondAnswerResult']['select_number']); ?>&nbsp;</td>
		<td><?php echo h($secondAnswerResult['SecondAnswerResult']['result']); ?>&nbsp;</td>
		<td><?php echo h($secondAnswerResult['SecondAnswerResult']['created']); ?>&nbsp;</td>
		<td><?php echo h($secondAnswerResult['SecondAnswerResult']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $secondAnswerResult['SecondAnswerResult']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $secondAnswerResult['SecondAnswerResult']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $secondAnswerResult['SecondAnswerResult']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $secondAnswerResult['SecondAnswerResult']['id']))); ?>
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
		<li><?php echo $this->Html->link(__('New Second Answer Result'), array('action' => 'add')); ?></li>
	</ul>
</div>
