<?php
namespace bl\cms\novaposhta\frontend;
use Yii;

/**
 * @author Albert Gainutdinov <xalbert.einsteinx@gmail.com>
 */
class Module extends \yii\base\Module
{

    /**
     * @var string
     * All requests will be treated at this URL.
     */
    public $requestUrl = 'https://api.novaposhta.ua/';

    /**
     * @var string
     * Version of API
     */
    public $apiVersion = 'v2.0';

    /**
     * @var string
     * Request format. You may specify 'json' or 'xml'.
     */
    public $format = 'json';

    /**
     * @var string
     * Your API token. You may generate it on https://my.novaposhta.ua/settings/index#apikeys
     */
    public $apiKey;

    /**
     * @var string
     * HTTP request method - 'post' or 'get.
     */
    public $method = 'post';

    /**
     * @var string the namespace that controller classes are in.
     * This namespace will be used to load controller classes by prepending it to the controller
     * class name.
     *
     * If not set, it will use the `controllers` sub-namespace under the namespace of this module.
     * For example, if the namespace of this module is `foo\bar`, then the default
     * controller namespace would be `foo\bar\controllers`.
     *
     * See also the [guide section on autoloading](guide:concept-autoloading) to learn more about
     * defining namespaces and how classes are loaded.
     */
    public $controllerNamespace = 'bl\cms\novaposhta\frontend\controllers';

    /**
     * Initializes the module.
     *
     * This method is called after the module is created and initialized with property values
     * given in configuration. The default implementation will initialize [[controllerNamespace]]
     * if it is not set.
     */
    public function init()
    {
        parent::init();
        $this->registerTranslations();
    }

    public function registerTranslations()
    {
        Yii::$app->i18n->translations['nova-poshta'] = [
            'class'          => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath'       => '@vendor/black-lamp/blcms-nova-poshta/frontend/messages',
        ];
    }

}