<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mdm\admin\models\Menu;
use yii\helpers\Json;
use mdm\admin\AutocompleteAsset;

/* @var $this yii\web\View */
/* @var $model mdm\admin\models\Menu */
/* @var $form yii\widgets\ActiveForm */

$this->registerCss(<<<CSS
.ui-autocomplete {
    z-index: 99999 !important;
    max-height: 300px;
    overflow-y: auto;
    overflow-x: hidden;
    background-color: #fff;
    border: 1px solid #ccc;
    font-size: 14px;
}
CSS);

AutocompleteAsset::register($this);
$opts = Json::htmlEncode([
        'menus' => Menu::getMenuSource(),
        'routes' => Menu::getSavedRoutes(),
    ]);
$this->registerJs("var _opts = $opts;");
$this->registerJs($this->render('_script.js'));
?>

<div class="menu-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= Html::activeHiddenInput($model, 'parent', ['id' => 'parent_id']); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => 128]) ?>

            <?= $form->field($model, 'parent_name')->textInput(['id' => 'parent_name']) ?>

            <?= $form->field($model, 'route')->textInput(['id' => 'route']) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'order')->input('number') ?>

            <?= $form->field($model, 'data')->textarea(['rows' => 4]) ?>
        </div>
    </div>

    <div class="form-group">
        <?=
        Html::submitButton($model->isNewRecord ? Yii::t('rbac-admin', 'Create') : Yii::t('rbac-admin', 'Update'), ['class' => $model->isNewRecord
                    ? 'btn btn-success' : 'btn btn-primary'])
        ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php
$this->registerJs(<<<JS
// Override default jQuery UI autocomplete to fit input width
$.widget("custom.autocomplete", $.ui.autocomplete, {
    _resizeMenu: function () {
        var ul = this.menu.element;
        ul.outerWidth(this.element.outerWidth());
    }
});
JS);
?>
<?php
$this->registerCss(<<<CSS
.modal, .content-wrapper, .main-sidebar {
    overflow: visible !important;
}
CSS);
?>
