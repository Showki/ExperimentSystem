<div class=tree>
<?php foreach ($keywords as $keyword): ?>
    <h4>
    <?php echo $this->html->link($keyword,
        array(
            'controller' => 'makes',
            'action' => 'generateQuestions',
            $keyword
        ));
    ?>
    </h4>
    <hr />
<?php endforeach; ?>
</div>