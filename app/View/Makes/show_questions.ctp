<h3>『<?php echo $tk_word ?>』に関する過去問題一覧</h3>
<br />
<?php foreach($exam_questions as $e_question): ?>
<table class="table table-bordered">
<tbody>
	<tr>
		<th class="col-xs-6 col-sm-1" rowspan="2" scope="row">
			<?php 
				echo "H".$e_question['description']['year']."：";
				echo $e_question['description']['grade']."級<br />";
				echo "第".$e_question['description']['number']."問";
			?>
		</th>
		<td colspan="4"><?php echo $e_question['sentence'] ?></td>
	</tr>
	<tr>
		<td class="col-xs-6 col-sm-3 answer"><?php echo $e_question['answer'] ?></td>
		<td class="col-xs-6 col-sm-2"><?php echo $e_question['wrong_answer_1'] ?></td>
		<td class="col-xs-6 col-sm-2"><?php echo $e_question['wrong_answer_2'] ?></td>
		<td class="col-xs-6 col-sm-2"><?php echo $e_question['wrong_answer_3'] ?></td>
	</tr>
</tbody>
</table>
<?php endforeach; ?>
<br />

<h3>自動生成問題一覧</h3>
<br />
<div class="panel-group" id="accordion">
<?php if($generated_questions !== null): ?>
<?php foreach ($generated_questions as $r_key => $g_questions): ?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title">
			<table class="table table-bordered">
				<tr>
					<td>
						<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $r_key ?>">
						＋
						</a>
					</td>
					<td class="col-md-5"><?php echo $g_questions[0]['sentence']; ?></td>
					<td class="col-md-5"><?php echo $g_questions[0]['answer']; ?></td>
					<td class="col-md-1">
						<?php echo $this->html->link("編集",
							array(
							'controller' => 'makes',
							'action' => 'editQuestion',$g_questions[0]['id']
						),array('class' => 'btn btn-success btn-lg',)); ?>
					</td>
				</tr>
			</table>
		</h4>
	</div>
	<div id="collapse<?php echo $r_key ?>" class="panel-collapse collapse">
		<div class="panel-body">
			<table class="table table-bordered">
			<?php foreach ($g_questions as $g_key => $g_question): ?>
			<?php if($g_key != 0): ?>
				<tr>
					<td class="col-md-6"><?php echo $g_question['sentence'] ?></td>
					<td class="col-md-5"><?php echo $g_question['answer'] ?></td>
					<td class="col-md-1">
						<?php echo $this->html->link("編集",
							array(
							'controller' => 'makes',
							'action' => 'editQuestion',$g_question['id']),array('class' => 'btn btn-success btn-lg',)
						);
						?>
					</td>
				</tr>
			<?php endif; ?>
			<?php endforeach; ?>
			</table>
		</div>
	</div>
</div>
<?php endforeach; ?>
<?php else: ?>
<h4 style="color:red">生成問題はありません。べつのキーワードやテンプレートでお試しください。</h4>
<?php endif; ?>
</div>