<div class="login_box">
<?php echo $this->Form->create('User'); ?>
<?php echo $this->Form->input('User.student_number',array(
    'type' => 'text',
    'label' => '学籍番号　',
    )); ?>
<?php echo "<br />"; ?>
<?php echo $this->Form->input('User.password',array(
    'label' => 'パスワード　',
    )); ?>
<?php echo "<br />"; ?>
<?php echo $this->Form->button('ログイン', array(
    'type' => 'submit',
    'class' => 'btn btn-primary btn-large',
    'escape' => false
));
?>
<?php echo $this->Form->end(); ?>
</div>