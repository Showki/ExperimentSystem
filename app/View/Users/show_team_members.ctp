<?php 
    $a_mem_num = count($a_team);
    $b_mem_num = count($b_team);
    $a_sum = 0;
    $b_sum = 0;

	debug($a_team);
	debug($b_team);
?>

<div class="users index">
	<h2><?php echo __('チームA'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
        <th>学籍番号</th>
        <th>名前</th>
        <th>得点</th>
        <th>テーマ①</th>
        <th>テーマ②</th>
        <th>テーマ③</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($a_team as $a_member): ?>
	<tr>
		<td><?php echo h($a_member['User']['student_number']); ?>&nbsp;</td>
		<td><?php echo h($a_member['User']['name']); ?>&nbsp;</td>
		<td><?php echo h($a_member['User']['points']); ?>&nbsp;</td>
		<td><?php echo h($a_member['User']['theme_1']); ?>&nbsp;</td>
		<td><?php echo h($a_member['User']['theme_2']); ?>&nbsp;</td>
		<td><?php echo h($a_member['User']['theme_3']); ?>&nbsp;</td>
        <?php $a_sum += $a_member['User']['points']; ?>
	</tr>
    <?php endforeach; ?>
    <tr>
        <td><?php echo h("合計：".$a_sum); ?></td>
        <td><?php echo h("人数：".$a_mem_num); ?></td>
        <td><?php echo h("平均：".$a_sum/$a_mem_num); ?></td>
        <?php $a_sum += $a_member['User']['points']; ?>
    </tr>
	</tbody>
	</table>
</div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('新規追加'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('チームを振り分け直す'), array('action' => 'assignTeam')); ?></li>
	</ul>
</div>

<div class="users index">
	<h2><?php echo __('チームB'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
        <th>学籍番号</th>
        <th>名前</th>
        <th>得点</th>
        <th>テーマ①</th>
        <th>テーマ②</th>
        <th>テーマ③</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($b_team as $b_member): ?>
	<tr>
		<td><?php echo h($b_member['User']['student_number']); ?>&nbsp;</td>
		<td><?php echo h($b_member['User']['name']); ?>&nbsp;</td>
		<td><?php echo h($b_member['User']['points']); ?>&nbsp;</td>
		<td><?php echo h($a_member['User']['theme_1']); ?>&nbsp;</td>
		<td><?php echo h($a_member['User']['theme_2']); ?>&nbsp;</td>
		<td><?php echo h($a_member['User']['theme_3']); ?>&nbsp;</td>
        <?php $b_sum += $b_member['User']['points']; ?>

	</tr>
    <?php endforeach; ?>
    <tr>
        <td><?php echo h("合計：".$b_sum); ?></td>
        <td><?php echo h("人数：".$b_mem_num); ?></td>
        <td><?php echo h("平均：".$b_sum/$b_mem_num); ?></td>
    </tr>
	</tbody>
	</table>
</div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('新規追加'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('戻る'), array('action' => 'index')); ?></li>
	</ul>
</div>