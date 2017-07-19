<div class="themes_box">
    <p class=theme_message>
        以下のテーマを入力し，検索してください！
    </p>
    <p class="themes">
        <?php echo "①：".$themes['theme_1']."，②：".$themes['theme_2']."，③：".$themes['theme_3']; ?>
    </p>
</div>

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