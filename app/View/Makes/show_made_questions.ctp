<!-- <h3>『<?php echo $user_name ?>』さんが作成した問題一覧</h3> -->
<div class="operation_btn_box">
<?php   
    echo $this->Html->link('戻る',array('controller' => 'users','action' => 'top'),array(
        'class' => 'btn btn-default btn-lg op_btn2',)
    ); 
?>
<?php 
    echo $this->Html->link('新規作成',array('action' => $make_url),array(
        'class' => 'btn btn-default btn-lg op_btn1',)
    );
?>
</div>

<?php foreach($made_problems as $problem): ?>
<table class="table table-bordered">
<tbody>
    <tr>
        <td>投稿日時</td>
        <td colspan="5"><?php echo $problem['created'] ?></td>
    </tr>
    <tr>
        <td>問題文</td>
        <td colspan="4"><?php echo $problem['sentence'] ?></td>
        <th rowspan="2">
        <?php   
            echo $this->Html->link('編集',array(
                'action' => 'editMadeQuestion',$problem['id']),array(
                    'class' => 'btn btn-success btn-lg',)
                ); 
        ?>
        <br /><br />
        <?php 
            echo $this->Html->link('削除',array(
                'action' => 'deleteMadeQuestion',$problem['id']),array(
                'confirm' => '本当にこの問題を削除しますか？',
                'class' => 'btn btn-danger btn-lg',)
            ); 
        ?>
        </th>
    </tr>
    <tr>
        <td>選択肢</td>
        <td class="col-xs-6 col-sm-2 answer"><?php echo $problem['answer'] ?></td>
        <td class="col-xs-6 col-sm-2"><?php echo $problem['wrong_answer_1'] ?></td>
        <td class="col-xs-6 col-sm-2"><?php echo $problem['wrong_answer_2'] ?></td>
        <td class="col-xs-6 col-sm-2"><?php echo $problem['wrong_answer_3'] ?></td>
    </tr>
    <tr>
        <td>参考文献</td>
        <td colspan="5"><?php echo $problem['reference'] ?></td>
    </tr>
</tbody>
</table>
<?php endforeach; ?>