<?php
namespace bl\cms\novaposhta\widgets;
use bl\cms\novaposhta\widgets\assets\NovaPoshtaWarehouseSelectorAsset;
use yii\base\Widget;


/**
 * @author Albert Gainutdinov <xalbert.einsteinx@gmail.com>
 **/
class NovaPoshtaWarehouseSelector extends Widget
{

    public $form;
    public $formModel;
    public $formAttribute;

    public $language = 'ru';

    public function init()
    {
        NovaPoshtaWarehouseSelectorAsset::register($this->getView());
    }

    public function run()
    {
        return $this->render('warehouse-selector', [
            'form' => $this->form,
            'model' => $this->formModel,
            'attribute' => $this->formAttribute
        ]);
    }
}