<h3>キーワード：<?php echo $tk_word ?></h3>
<br />
<h3 style="color:red;">問題の生成に利用するテンプレートを選択してください</h3>

<table class="table table-bordered">
<thead class="thead-default">
	<tr>
        <th></th>
        <th>情報</th>
        <th colspan="2">生成例（新渡戸稲造）</th>
        <th></th>
	</tr>
</thead>
<tbody>
<?php foreach($templates as $template): ?>
<?php
    $tmpl_id            = $template['Template']['id'];
    $tmpl_description   = $template['Template']['description'];
    $e_g_sentence       = $template['Template']['example_sentence'];
    $e_g_answer         = $template['Template']['example_answer'];
?>
	<tr>
        <td class=".col-md-2">
            <?php echo $tmpl_id ?>
        </td>
        <td class=".col-md-4">
            <?php echo $tmpl_description ?>
        </td>
        <td class=".col-md-4">
            <?php echo $e_g_sentence; ?>
        </td>
        <td class=".col-md-4">
            <?php echo $e_g_answer; ?>
        </td>
        <td class=".col-md-2">
            <?php echo $this->Html->link('利用',array('action' => 'showQuestions',$tk_word,$tmpl_id),array('class' => 'btn btn-success',)); ?>

        </td>
    </tr>
<?php endforeach; ?>
</tbody>
</table>

<br />