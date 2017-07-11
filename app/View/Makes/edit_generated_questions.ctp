<div class="text-center">
<?php echo $this->Form->create('makes',array(
	'type' => 'post',
	'action' => 'registerGeneratedQuestions'
));?>
<?php echo $this->Form->input('sentence',array(
	'type' => 'textarea',
	'label' => '選択した問題文を編集してください',
     'value' => $selected_question['makes']['sentence'],
     'id' => "custom",
     'cols' => 5,
     ''
 ));
?>
<?php echo $this->Form->input('answer',array(
	'type' => 'textarea',
	'label' => '選択した答を編集してください',
	'value' => $selected_question['makes']['answer']
 ));
?>
<br /><br />
<?php echo $this->Form->submit('確定',array(
	'name' => "decided_question",
	'class' => 'btn btn-success btn-large',
	));?>
<br /><br />
	<p>※ 確定ボタンが押されると登録されます</p>
</div>
