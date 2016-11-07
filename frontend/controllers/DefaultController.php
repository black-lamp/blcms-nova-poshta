<?php
namespace bl\cms\nova-poshta\frontend\controllers;

use yii\httpclient\Client;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

/**
 * @author Albert Gainutdinov <xalbert.einsteinx@gmail.com>
 */
class DefaultController extends Controller
{
    /**
     * This method is used for Nova Poshta widget.
     *
     * @param $modelName
     * @param $calledMethod
     * @param null $methodProperties
     * @return string
     */
    private function getResponse($modelName, $calledMethod, $methodProperties = null)
    {

        $data = [
            'apiKey' => 'b696152fde625f5e9b3c6a7a0318701f',
            'modelName' => $modelName,
            'calledMethod' => $calledMethod,
            'language' => 'ru'
        ];

//        $post = json_encode($data);
//
//        $result = file_get_contents('https://api.novaposhta.ua/v2.0/json/', null, stream_context_create([
//            'http' => [
//                'method' => 'POST',
//                'header' => "Content-type: application/x-www-form-urlencoded;\r\n",
//                'content' => $post,
//            ]
//        ]));
//
//        return $result;

        $client = new Client();
        $response = $client->createRequest()
            ->setFormat(Client::FORMAT_JSON)
            ->setMethod('post')
            ->setUrl('https://api.novaposhta.ua/v2.0/json/')
            ->setData([
                'apiKey' => 'b696152fde625f5e9b3c6a7a0318701f',
                'modelName' => 'Address',
                'calledMethod' => 'getAreas',
                'language' => 'ru'
            ])
            ->send();
        if ($response->isOk) {
            return $response;
        }
        else throw new BadRequestHttpException();
    }

    public function actionGetAreas() {
        return $this->getResponse('Address', 'getAreas');
    }

    public function actionGetCities() {
        return $this->getResponse('AddressGeneral', 'getSettlements');
    }

    public function actionGetWarehousesFromNp($cityName) {

//        $cityName = (!empty($cityName)) ? $cityName : $this->defaultCityName;

        $methodProperties = [
            'CityName' => $cityName
        ];

        return $this->getResponse('AddressGeneral', 'getWarehouses', $methodProperties);
    }
}