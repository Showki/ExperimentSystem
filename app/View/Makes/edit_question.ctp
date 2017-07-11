<div class="text-center">

<?php echo $this->Form->create('makes',array(
    'type' => 'post',
    'action' => 'storeQuestion',
    'onsubmit' => 'return confirm("以下の内容で登録してもよろしいですか？");'
));?>


<?php echo $this->Form->input('Edit.sentence', array(
    'label' => array('text'  =>  '問題文','class' =>  'col-xs-12 textarea_label',),
    'div'   => array('class' =>  'col-xs-7 text-center form-group'),
    'class' => 'form-control',
    'type'  => 'textarea',
    'value' => $question['GeneratedQuestion']['sentence'],
  )); ?>

<?php echo $this->Form->input('Edit.answer', array(  
    'label' => array('text'  =>  '正答','class' =>  'col-xs-12 textarea_label',),
    'div'   => array('class' =>  'col-xs-5 text-center form-group'),
    'class' => 'form-control',
    'type'  => 'textarea',
    'value' => $question['GeneratedQuestion']['answer'],
  )); ?>


<div class="form-group">
<?php echo $this->Form->input('Edit.wrong_answer_1', array(
    'label' => array('text'  =>  '誤答１','class' =>  'col-xs-12 textarea_label',),
    'div'   => array('class' =>  'col-xs-4 text-center form-group'),
    'class' => 'form-control',
    'type'  => 'textarea',
    'placeholder'   => '誤答選択肢１を入力してください…',
  )); ?>
<?php echo $this->Form->input('Edit.wrong_answer_2', array(
    'label' => array('text'  =>  '誤答２','class' =>  'col-xs-12 textarea_label',),
    'div'   => array('class' =>  'col-xs-4 text-center form-group'),
    'class' => 'form-control',
    'type'  => 'textarea',
    'placeholder'   => '誤答選択肢２を入力してください…',
  )); ?>
<?php echo $this->Form->input('Edit.wrong_answer_3', array(
    'label' => array('text'  =>  '誤答３','class' =>  'col-xs-12 textarea_label',),
    'div'   => array('class' =>  'col-xs-4 text-center form-group'),
    'class' => 'form-control',
    'type'  => 'textarea',
    'placeholder'   => '誤答選択肢３を入力してください…',
  )); ?>
</div>
<?php echo $this->Form->hidden('Edit.generated_questions_id',array(
    'value' => $question_id
)); ?>


<br /><br />
<?php echo $this->Form->submit('確定',array(
    'name' => "edit_confirm",
    'class' => 'btn btn-success btn-lg',
    ));?>

</div>
</div>