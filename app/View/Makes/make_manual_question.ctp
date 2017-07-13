<div class="text-center">
    <?php echo $this->Form->create('MadeProblem',array(
        'type'  => 'post',
        // 'url'   => 'storeQuestion',
        'onsubmit' => 'return confirm("以下の内容で登録してもよろしいですか？");'
    ));?>

    <?php echo $this->Form->input('sentence', array(
        'label' => array(
            'text'  =>  '問題文',
            'class' =>  'col-xs-12 textarea_label',
            ),
        'div'   => array(
            'class' =>  'col-xs-7 text-center form-group'
            ),
        'class' => 'form-control',
        'type'  => 'textarea',
        'placeholder'   => '問題文を入力してください．',
    )); ?>

    <?php echo $this->Form->input('answer', array(  
        'label' => array(
            'text'  =>  '正答',
            'class' =>  'col-xs-12 textarea_label',),
        'div'   => array(
            'class' =>  'col-xs-5 text-center form-group'),
        'class' => 'form-control',
        'type'  => 'textarea',
        'placeholder'   => '正答を入力してください．',
    )); ?>

    <div class="form-group">
        <?php echo $this->Form->input('wrong_answer_1', array(
            'label' => array('text'  =>  '誤答１','class' =>  'col-xs-12 textarea_label',),
            'div'   => array('class' =>  'col-xs-4 text-center form-group'),
            'class' => 'form-control',
            'type'  => 'textarea',
            'placeholder'   => '誤答選択肢１を入力してください．',
        )); ?>
        <?php echo $this->Form->input('wrong_answer_2', array(
            'label' => array('text'  =>  '誤答２','class' =>  'col-xs-12 textarea_label',),
            'div'   => array('class' =>  'col-xs-4 text-center form-group'),
            'class' => 'form-control',
            'type'  => 'textarea',
            'placeholder'   => '誤答選択肢２を入力してください．',
        )); ?>
        <?php echo $this->Form->input('wrong_answer_3', array(
            'label' => array('text'  =>  '誤答３','class' =>  'col-xs-12 textarea_label',),
            'div'   => array('class' =>  'col-xs-4 text-center form-group'),
            'class' => 'form-control',
            'type'  => 'textarea',
            'placeholder'   => '誤答選択肢３を入力してください．',
        )); ?>
    </div>

    <?php echo $this->Form->input('reference', array(
        'label' => array(
            'text'  =>  '参考文献',
            'class' =>  'col-xs-12 textarea_label'),
        'div'   => array(
            'class' =>  'col-xs-5 text-center form-group'),
        'class' => 'form-control',
        'type'  => 'textarea',
        'placeholder' => '参考文献があれば，URLを入力してください．',
    )); ?>

    <br /><br />
    <?php echo $this->Form->submit('確定',array(
        'name' => "Manual_confirm",
        'class' => 'btn btn-success btn-lg',
    ));?>

    </div>
</div>