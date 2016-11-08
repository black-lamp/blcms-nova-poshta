<?php
/**
 * @author Albert Gainutdinov <xalbert.einsteinx@gmail.com>
 *
 * @var $language string
 * @var $warehouses->data
 * @var $model
 * @var $attribute string
 */

use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
?>
<?php /* echo Html::activeDropDownList(
        $model,
        $attribute,
        ArrayHelper::map($areas, 'Ref', 'Description'),
        [
            'id' => 'np-areas'
        ]);
    */
?>
<!--    --><?//= Html::activeDropDownList(
//        $model,
//        $attribute,
//        ArrayHelper::map($warehouses, 'Number', 'DescriptionRu'),
//        [
//            'id' => 'useraddress-postoffice'
//        ]);
//    ?>

<div id="nova-poshta">

    <lable for="area-selector">Area</lable>
    <select name="area-selector" id="area-selector">
    </select>

    <lable for="settlement-selector">Settlement</lable>
    <select name="settlement-selector" id="settlement-selector">
    </select>




</div>


