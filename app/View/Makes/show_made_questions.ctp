<!-- <h3>『<?php echo $user_name ?>』さんが作成した問題一覧</h3> -->


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
                'controller' => 'histories',
                'action' => 'editMyQuestion',
                $problem['id']),
                array(
                    'class' => 'btn btn-success btn-lg',
                )
            ); 
        ?>
        <br /><br />
        <?php 
            echo $this->Html->link(
                '削除',array(
                    'controller' => 'histories',
                    'action' => 'deleteMyQuestion',
                    $problem['id']),
                    array(
                        'confirm' => '本当にこの問題を削除しますか？',
                    'class' => 'btn btn-danger btn-lg',
                )
            ); 
        ?>
        </th>
    </tr>
    <tr>
        <td>選択肢（正答）</td>
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