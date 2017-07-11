
<div class="text-center">
<h3>自動生成に用いるキーワードの検索方法を選択してください</h3><br />
<?php 
    echo $this->Html->link('キーワード入力による検索',array('controller' => 'makes','action' => 'inputWord',),array('class' => 'btn btn-default btn-lg',));
?>
<br /><br />
<?php 
    echo $this->Html->link('カテゴリによる検索',array('controller' => 'makes','action' => 'selectCategories',),array('class' => 'btn btn-default btn-lg',));
?>
</div>