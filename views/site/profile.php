<?php
/**
 * Created by PhpStorm.
 * User: AleksM
 * Date: 15.12.2018
 * Time: 18:04
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'My Profile';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-profile">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="container">
        <?php $form = ActiveForm::begin(['id' => 'form-profile']); ?>
        <div class="row">
            <div class="col-md-4 details">
                <p>
                    <?= $form->field($model, 'first_name')->textInput(['autofocus' => true]) ?>
                </p>
                <p>
                    <?= $form->field($model, 'second_name')->textInput() ?>
                </p>
                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'save-button']) ?>
                </div>
            </div>
            <div class="col-md-2 img">
                <?= Html::img('img/' . $model->photo, ['alt' => 'Profile picture', 'class' => 'img-rounded', 'height' => '120'])?>
                <?= $form->field($model, 'photo')->fileInput() ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>