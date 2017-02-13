Maintenance Component for Yii2
======================


Installation
------------

### Install With Composer

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer require sankam/yii2-maintenance "*"
```

Or, you may add

```
"sankam/yii2-maintenance": "*"
```

to the require section of your `composer.json` file and execute `php composer update`.

### Install

In your application front config, add the path alias for this extension.

```php
return [
    ...
    'components' => [
        ...
        'maintenance' => [
            'class' => 'sankam\maintenance\Maintenance',
            'enabled' => true
        ],
];
```
