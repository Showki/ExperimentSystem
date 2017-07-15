<div class="text-center">
<h2>ようこそ『<?php echo $user_name?>』さん！</h2><br />
<?php
    if($team !== ''){
        echo "あなたはグループ".$team."です．";
    }
?>
<p>指示に合わせて以下のボタンを押下し，作業を進めてください．</p>
<?php 
    echo $this->Html->link('過去問題解答',array(
        'controller' => 'past_problems','action' => 'answer'),array(
            'class' => 'btn btn-default btn-lg',
        ));
?>
<br /><br />
<?php 
    echo $this->Html->link('問題作成',array(
        'controller' => 'makes','action' => 'showMadeQuestions',),array(
            'class' => 'btn btn-default btn-lg',
        )); 
?>
<br /><br />
<?php 
    echo $this->Html->link('作成問題解答',array(
        'controller' => 'xxxx_problems','action' => 'answer',),array(
            'class' => 'btn btn-default btn-lg',
        )); 
?>
<br /><br />
<?php 
    echo $this->Html->link('アンケート',array('controller' => 'histories','action' => 'showPastExam',),array('class' => 'btn btn-default btn-lg',)); 
?>
</div>