<div class="users index">
	<h2><?php echo __('Users'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th>ID</th>
			<th>学籍番号</th>
			<th>氏名</th>
			<th>解答数</th>
			<th>点数</th>
			<th>チーム</th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($users as $user): ?>
	<tr>
		<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['student_number']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['name']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['times']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['points']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['team']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $user['User']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>

</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('① チームの振り分け'), array('action' => 'assignTeam')); ?></li>
		<li><?php echo $this->Html->link(__('② テーマの振り分け'), array('action' => 'setTheme')); ?></li>
		<li><?php echo $this->Html->link(__('③ 振り分け結果一覧'), array('action' => 'showTeamMembers')); ?></li>
		<li>***テスト用メソッド（本番消す）***</li>
		<li><?php echo $this->Html->link(__('点数と回答数付加'), array('action' => 'setPoints')); ?></li>
		<li><?php echo $this->Html->link(__('新規追加'), array('action' => 'add')); ?></li>
	</ul>
</div>
