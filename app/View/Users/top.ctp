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
        'action' => '',),array(
            'class' => 'btn btn-default btn-lg top_btn',
            'disabled' => 'disabled'
        ));
?>
<?php 
    echo $this->Html->link('②問題作成',array(
        'action' => '',),array(
            'class' => 'btn btn-default btn-lg top_btn',
            'disabled' => 'disabled'
        )); 
?>
<?php 
    echo $this->Html->link('③アンケート',array(
        'action' => '',),array(
            'class' => 'btn btn-default btn-lg top_btn',
            'disabled' => 'disabled'
        )); 
?>
<br/>
<?php 
    echo $this->Html->link('④過去問題解答',array(
        'controller' => 'second_made_problems','action' => 'answer'),array(
            'class' => 'btn btn-default btn-lg top_btn',
        ));
?>
<?php 
    echo $this->Html->link(
        '⑤アンケート','https://docs.google.com/forms/d/e/1FAIpQLSdM3pljAK1SE7PRIzmJkBMl6DdN35TIiSCp61UmGRHJe2xT8Q/viewform?fbzx=895800738726232800',array(
            'class' => 'btn btn-default btn-lg top_btn',
            'target' => '_blank' 
        ));
?>
</div>

