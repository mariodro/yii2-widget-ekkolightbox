<?php

namespace  mdq\ekkolightbox;

use Yii;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\base\Widget as BaseWidget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JsExpression;

/**
 * Ekko-Lightbox widget.
 * @property string $text html text or image tag to preview link**
 * @property string $url target link to video or full resolution image**
 * @property array $options html tag properties*
 * @property array $settings JS Lightbox settings
 *
 
 * @link https://github.com/ashleydw/lightbox
 * @link http://ashleydw.github.io/lightbox
 * @license https://github.com/ashleydw/lightbox/blob/master/LICENSE
 */
class Lightbox extends BaseWidget
{
    /** Name of inline JavaScript package that is registered by the widget */
    const INLINE_JS_KEY = 'mdq/ekkolightbox/';

    public $text;
    public $url;
    
    /**
     * @var array the HTML attributes for the link tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = [];

    /**
     * @var array {@link http://ashleydw.github.io/lightbox/ lightbox options}.
     */
    public $settings = [];

    /**
     * @var array Default settings that will be merged with {@link $settings}. Useful with DI container.
     */
    public $defaultSettings = [];


    /**
     * @inheritdoc
     */
    public function init()
    {
        if ($this->text === null || $this->url === null) {
            throw new InvalidConfigException("'text' and 'url' properties must be specified.");
        }
        
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
        
        if (!empty($this->defaultSettings)) {
            $this->settings = ArrayHelper::merge($this->defaultSettings, $this->settings);
        }

        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $this->register();
        
        return Html::a($this->text, $this->url, $this->options);
    }

    /**
     * Register all widget logic.
     */
    protected function register()
    {
        $this->registerClientScripts();
    }

    /**
     * Register widget asset.
     */
    protected function registerClientScripts()
    {
        $view = $this->getView();
        $selector = Json::encode('#'.$this->options['id']);
        $asset = Yii::$container->get(LightboxAsset::className());
        $asset = $asset::register($view);

        $settings = !empty($this->settings) ? Json::encode($this->settings) : '';
        $view->registerJs("jQuery($selector).on('click', function(event){ event.preventDefault(); $(this).ekkoLightbox($settings);});", $view::POS_READY, self::INLINE_JS_KEY . $this->options['id']);
    }

}
