	<h2><?php echo __('Answer Results'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('past_problems_id'); ?></th>
			<th><?php echo $this->Paginator->sort('select_number'); ?></th>
			<th><?php echo $this->Paginator->sort('result'); ?></th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($answerResults as $answerResult): ?>
	<tr>
		<td><?php echo h($answerResult['AnswerResult']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($answerResult['PastProblems']['id'], array('controller' => 'past_problems', 'action' => 'view', $answerResult['PastProblems']['id'])); ?>
		</td>
		<td><?php echo h($answerResult['AnswerResult']['select_number']); ?>&nbsp;</td>
		<td><?php echo h($answerResult['AnswerResult']['result']); ?>&nbsp;</td>
		<td><?php echo h($answerResult['AnswerResult']['type']); ?>&nbsp;</td>
		<td><?php echo h($answerResult['AnswerResult']['created']); ?>&nbsp;</td>
		<td><?php echo h($answerResult['AnswerResult']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $answerResult['AnswerResult']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $answerResult['AnswerResult']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $answerResult['AnswerResult']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $answerResult['AnswerResult']['id']))); ?>
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
