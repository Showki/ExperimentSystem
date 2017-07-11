<table class="tree">
    <?php foreach ($categories as $key => $category): ?>
        <?php
        $id = (int)$category['Category']['id'];
        $name = $category['Category']['categoryies_name'];
        $pa_id = (int)$category['Category']['parent_id'];
        ?>
        <?php if($id == 1): ?>
        <tr class="treegrid-1">
            <td class="category">
                <?php echo $this->Html->link($name,array('action' => 'showKeywords',$id));?>
            </td>
        </tr>
        <?php else: ?>
        <tr class="treegrid-<?php echo $id ?> treegrid-parent-<?php echo $pa_id ?>">
            <td class="category">
                <?php echo $this->Html->link($name,array('action' => 'showKeywords',$id));?>
            </td>
        </tr>
        <?php endif; ?>
    <?php endforeach; ?>
</table>