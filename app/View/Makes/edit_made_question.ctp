<div class="text-center">
<div class="form-group">
<?php echo $this->Form->create('MadeProblem',array(
    'type' => 'post',
    'onsubmit' => 'return confirm("以下の内容で登録してもよろしいですか？");'
));?>

<?php echo $this->Form->input('sentence', array(
    'label' => array('text'  =>  '問題文','class' =>  'col-xs-12 textarea_label',),
    'div'   => array('class' =>  'col-xs-7 text-center form-group'),
    'class' => 'form-control',
    'type'  => 'textarea',
    'value' => $problem['MadeProblem']['sentence'],
  )); ?>
<?php echo $this->Form->input('answer', array(  
    'label' => array('text'  =>  '正答','class' =>  'col-xs-12 textarea_label',),
    'div'   => array('class' =>  'col-xs-5 text-center form-group'),
    'class' => 'form-control',
    'value' => $problem['MadeProblem']['answer'],
    'type'  => 'textarea', 
  )); ?>  
</div>

<div class="form-group">
<?php echo $this->Form->input('wrong_answer_1', array(
    'label' => array('text'  =>  '誤答１','class' =>  'col-xs-12 textarea_label',),
    'div'   => array('class' =>  'col-xs-4 text-center form-group'),
    'class' => 'form-control',
    'value' => $problem['MadeProblem']['wrong_answer_1'],
    'type'  => 'textarea', 
  )); ?>  
<?php echo $this->Form->input('wrong_answer_2', array(
    'label' => array('text'  =>  '誤答２','class' =>  'col-xs-12 textarea_label',),
    'div'   => array('class' =>  'col-xs-4 text-center form-group'),
    'class' => 'form-control',
    'value' => $problem['MadeProblem']['wrong_answer_2'],
    'type'  => 'textarea', 
  )); ?>  
<?php echo $this->Form->input('wrong_answer_3', array(  
    'label' => array('text'  =>  '誤答３','class' =>  'col-xs-12 textarea_label',),
    'div'   => array('class' =>  'col-xs-4 text-center form-group'),
    'class' => 'form-control',
    'value' => $problem['MadeProblem']['wrong_answer_3'],
    'type'  => 'textarea', 
  )); ?>
</div>

<?php echo $this->Form->hidden('id',array(
    'value' => $problem_id
)); ?>

<?php echo $this->Form->input('reference', array(
    'label' => array('text'  =>  '参考文献','class' =>  'col-xs-12 textarea_label',),
    'div'   => array('class' =>  'col-xs-7 text-center form-group'),
    'class' => 'form-control',
    'type'  => 'textarea',
    'value' => $problem['MadeProblem']['reference'],
  )); ?>

<br /><br />
<?php echo $this->Form->submit('確定',array(
    'name' => "update_confirm",
    'class' => 'btn btn-success btn-lg',
    ));?>
</div>