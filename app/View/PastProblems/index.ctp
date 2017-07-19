<div class="text-center">
<?php echo $this->Form->create('PastProblem',array(
    'type' => 'post',
    // 'url' => '',
));?>
<?php echo $this->Form->input('year', array(
        'type'=>'select', 
        'div'=>false, 
        'label'=>false, 
        'options'=> $year, 'empty'=>'年を選択してください')); 
?>
&nbsp 
<?php echo $this->Form->input('grade', array(
        'type'=>'select', 
        'div'=>false, 
        'label'=>false, 
        'options'=> $grade, 'empty'=>'級を選択してください',
        'selected' => 3)); 
?>
&nbsp 
<?php echo $this->Form->submit('確定',array(
    'div' => false,
    'name' => "select_confirm",
    'class' => 'btn btn-success btn-lg',
    ));?>
</div>

<br /><hr /><br />

<?php if(!empty($questions) && !empty($select_year) && !empty($select_grade)): ?>
<h2>
    <?php echo "平成 ".$select_year." 年度： ".$select_grade." 級<br />"; ?>
</h2>
<hr />
<?php foreach($questions as $key =>$question): ?>
<table class="table table-bordered">
<tbody>


	<tr>
		<th class="col-xs-6 col-sm-1" rowspan="2" scope="row">
			<?php 
                $number = (int)substr($question['PastExam']['id'],5,3);

				echo "第".(string)$number."問";
			?>
		</th>
		<td colspan="4">
            <?php echo $question['PastExam']['sentence'] ?>
            
            <?php if($question['PastExam']['image_flg'] == 1):?>
                <br /><br />
                <p>※画像は非表示となっております</p>
            <?php endif; ?>
        </td>
	</tr>
	<tr>
		<td class="col-xs-6 col-sm-3 answer"><?php echo $question['PastExam']['answer'] ?></td>
		<td class="col-xs-6 col-sm-2"><?php echo $question['PastExam']['wrong_answer_1'] ?></td>
		<td class="col-xs-6 col-sm-2"><?php echo $question['PastExam']['wrong_answer_2'] ?></td>
		<td class="col-xs-6 col-sm-2"><?php echo $question['PastExam']['wrong_answer_3'] ?></td>
	</tr>
</tbody>
</table>
<?php endforeach; ?>
<?php endif; ?>