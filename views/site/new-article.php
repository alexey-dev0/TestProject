<?php
/**
 * Created by PhpStorm.
 * User: AleksM
 * Date: 16.12.2018
 * Time: 18:23
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'New Article';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-new-article">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="container">
        <?php $form = ActiveForm::begin(['id' => 'form-new-article']); ?>
        <div class="row">
            <p>
                <?= $form->field($model, 'title')->textInput(['autofocus' => true]) ?>
            </p>
            <p>
                <?= $form->field($model, 'content')->textInput() ?>
            </p>
            <div class="form-group">
                <?= Html::submitButton('Add', ['class' => 'btn btn-primary', 'name' => 'add-button']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>