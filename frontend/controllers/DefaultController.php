<?php
namespace bl\cms\novaposhta\frontend\controllers;

use yii\helpers\ArrayHelper;
use yii\httpclient\Client;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

/**
 * @author Albert Gainutdinov <xalbert.einsteinx@gmail.com>
 */
class DefaultController extends Controller
{
    /**
     * This method makes request to the API.
     * @property \bl\cms\novaposhta\frontend\Module $module
     *
     * @param string $modelName
     * @param string $calledMethod
     * @param array $methodProperties
     * @return string
     *
     * @throws BadRequestHttpException
     */
    private function getResponse($modelName, $calledMethod, $methodProperties = [])
    {

        $data = ArrayHelper::merge(
            [
                'apiKey' => $this->module->apiKey,
                'modelName' => $modelName,
                'calledMethod' => $calledMethod,
            ],
            $methodProperties);

        $client = new Client();
        $response = $client->createRequest()
            ->setFormat($this->module->format)
            ->setMethod('post')
            ->setUrl("{$this->module->requestUrl}/{$this->module->apiVersion}/{$this->module->format}/")
            ->setData($data)
            ->send();
        if ($response->isOk) {
            return $response;
        }
        else throw new BadRequestHttpException();
    }

    /**
     * @return string
     * Gets Ukrainian regions.
     */
    public function actionGetAreas() {
        return $this->getResponse('Address', 'getAreas')->content;
    }

    public function actionGetCities() {
        $settlements = $this->getResponse('AddressGeneral', 'getSettlements', [
            'methodProperties' => [
                "Region" => $_GET['regionRef']
        ]]);
        return $settlements->content;

    }



    public function actionGetWarehousesFromNp($cityName) {

//        $cityName = (!empty($cityName)) ? $cityName : $this->defaultCityName;

        $methodProperties = [
            'CityName' => $cityName
        ];

        return $this->getResponse('AddressGeneral', 'getWarehouses', $methodProperties);
    }
}