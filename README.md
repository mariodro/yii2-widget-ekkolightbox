Yii2 Ekko Lightbox widget
=========================
http://ashleydw.github.io/lightbox/

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require mdq/yii2-widget-ekkolightbox "*"
```

or add

```
"mdq/yii2-widget-ekkolightbox": "*"
```

to the require section of your `composer.json` file.

Require Bootstrap 4. You can use:

```
    "bower-asset/bootstrap": "~4.0.0@alpha",
    "yiisoft/yii2-bootstrap": "2.1.x-dev as 2.0.0",
```

Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
use mdq\ekkolightbox\LightBox;
<?= Lightbox::widget([
    'text' => 'text or image thumb', 
    'url' => ['image or embed video link'], 
    'settings' => ['js pluggins settings'], 
    'options' => ['html tag properties']
]); ?>