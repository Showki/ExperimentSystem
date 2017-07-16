<div class="top_info_box">
    <h2>ようこそ『<?php echo $user_name?>』さん！</h2><br />
    <?php
        if($team !== '')
            echo "あなたはグループ".$team."です．";
    ?>
    <p>指示に合わせて以下のボタンを押下し，作業を進めてください．</p>
</div>


<div class="top_btn_box">
<?php 
    echo $this->Html->link('①過去問題解答',array(
        'controller' => 'past_problems','action' => 'answer'),array(
            'class' => 'btn btn-default btn-lg top_btn',
        ));
?>
<?php 
    echo $this->Html->link('②問題作成',array(
        'controller' => 'makes','action' => 'showMadeQuestions',),array(
            'class' => 'btn btn-default btn-lg top_btn',
        )); 
?>
<?php 
    echo $this->Html->link('③アンケート',array('controller' => 'histories','action' => 'showPastExam',),array('class' => 'btn btn-default btn-lg top_btn',)); 
?>
<br/>
<?php 
    echo $this->Html->link('④作成問題解答',array(
        'action' => '',),array(
            'class' => 'btn btn-default btn-lg top_btn',
            'disabled' => 'disabled'
        )); 
?>
<?php 
    echo $this->Html->link('⑤アンケート',array(
        'action' => '',),array(
            'class' => 'btn btn-default btn-lg top_btn',
            'disabled' => 'disabled'
        )); 
?>
</div>

