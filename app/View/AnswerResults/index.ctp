<h2><?php echo __('Answer Results'); ?></h2>

<table cellpadding="0" cellspacing="0">
<thead>
	<tr>
		<th>No</th>
		<th>問題文</th>
		<th>解答</th>
		<th></th>
	</tr>
</thead>
	<tbody>
	<?php foreach ($answer_results as $key => $answer_result): ?>
		<tr>
			<td><?php echo h($key+1); ?>&nbsp;</td>
			<td><?php echo h($answer_result['sentence']); ?></td>
			<td><?php echo h("選択肢".$answer_result['selected_number']."：".$answer_result['selected_option']); ?></td>
			<td class="actions">
			<?php echo $this->html->link('修正',array(
				'action' => 'edit',
				'?' => array(
					'times' => $key+1,
					'id' => $answer_result['id'])
				));
			?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>