<div class="text-center">
<html>
<?php echo $this->Session->flash(); ?>

<?php echo $this->Form->create('Make',array(
    'type' => 'post',
    'url' => 'showKeywords'
));
?>
<?php echo $this->Form->input('Make.input_word',array(
    'type' => 'text',
    'label' => 'キーワード入力：',
    )); ?>
<?php echo "<br />"; ?>
<?php echo $this->Form->button('<i class="icon-user icon-white"></i> 検索', array(
    'type' => 'submit',
    'class' => 'btn btn-primary btn-large',
    'escape' => false
));
?>

<?php echo $this->Form->end(); ?>
</html>
</div>