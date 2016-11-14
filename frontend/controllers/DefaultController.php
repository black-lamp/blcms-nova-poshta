<?php
namespace bl\cms\novaposhta\frontend\controllers;

use yii\httpclient\Client;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

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
     * @throws NotFoundHttpException
     */
    private function getResponse($modelName, $calledMethod, $methodProperties = [])
    {

        if (\Yii::$app->request->isAjax) {
            $data =
                [
                    'apiKey' => $this->module->apiKey,
                    'modelName' => $modelName,
                    'calledMethod' => $calledMethod,
                    'methodProperties' => $methodProperties
                ];

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
        else throw new NotFoundHttpException();
    }

    /**
     * Gets cities, where there are Nova Poshta warehouses.
     * @return string
     */
    public function actionGetCities() {

        $settlements = $this->getResponse('Address', 'getCities',
            ['FindByString' => $_GET['FindByString']]);

        return json_encode($settlements->data['data']);
    }

    /**
     * Gets warehouses by city and street.
     * @return string
     */
    public function actionGetWarehouses() {

        $street = $_GET['street'];

        $warehouses = $this->getResponse('AddressGeneral', 'getWarehouses',
            ['CityName' => $_GET['CityName']]);

        $warehousesByStreet = [];
        foreach ($warehouses->data['data'] as $warehouse) {
            if (substr_count($warehouse['Description'], $street) != 0 || substr_count($warehouse['DescriptionRu'], $street)) {
                $warehousesByStreet[] = $warehouse;
            }
        }

        return json_encode($warehousesByStreet);
    }

}