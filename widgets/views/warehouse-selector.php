<?php
/**
 * @author Albert Gainutdinov <xalbert.einsteinx@gmail.com>
 *
 * @var $language string
 * @var $warehouses ->data
 * @var $model
 * @var $attribute string
 */

use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\jui\AutoComplete;

?>


<div id="nova-poshta">

    <label for="city" ><?= Yii::t('nova-poshta', 'City'); ?></label>
    <input type="text" name="city" class="form-control" id="np-city"
           placeholder="<?= Yii::t('nova-poshta', 'Start typing the name of the city'); ?>">

    <?= $form->field($model, 'delivery_post_office')->textInput([
        'id' => 'np-warehouse',
        'placeholder' => Yii::t('nova-poshta', 'Start typing the name of the street')
    ]); ?>



</div>


