

<div class="form">
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
)); ?>

<fieldset>
    <?php echo $form->errorSummary($song); ?>

    <div class="row">
        <?php echo $form->label($song,'title'); ?>
        <?php echo $form->textField($song,'title') ?>
    </div>

    <div class="row">
    <fieldset>
        <?php
            foreach($genres as $genre): ?>
                <br />
                <?php echo $genre['name']; ?>

                <?php echo CHtml::link(Yii::t('songs','Remove'),array('removeGenre',
                    'song' => $song->id,
                    'genre' => $genre['id'])
                ); ?>

        <?php endforeach; ?>
    </fieldset>
    </div>



    <div class ="row">
        <?php echo Yii::t('genres', 'Add new genre:'); ?>
        <br />
        <?php
            echo $form->dropDownListControlGroup(
                $genre,
                'id',
                CHtml::listData(Genres::model()->findAll(), 'id', 'name')
            );
        ?>
    </div>
</fieldset>
<div class="row submit">
    <?php echo TbHtml::submitButton(Yii::t('genres', 'Add Genre')); ?>
</div>

<?php $this->endWidget(); ?>
</div><!-- form -->