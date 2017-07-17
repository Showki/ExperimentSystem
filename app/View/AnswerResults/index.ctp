<h2><?php echo __('回答結果一覧'); ?></h2>
<br />
<table class="table table-bordered">
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
					'id' => $answer_result['id'])),
				array(
                    'class' => 'btn btn-success btn-lg',
				));
			?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
<div class="submit_box">
<?php echo $this->html->link('確定する',array(
	'action' => 'sum_points'),array(
		'class' => 'btn btn-danger btn-lg btn-block'));
?>
</div>