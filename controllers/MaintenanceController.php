<?php
namespace sankam\maintenance\controllers;

use Yii;
use yii\web\Controller;


class MaintenanceController extends Controller
{
    public $retryAfter;
    public $maintenanceLayout;
    public $maintenanceView;
    public $maintenanceText;

    public function actionIndex()
    {
        $this->layout = $this->maintenanceLayout;

        Yii::$app->response->statusCode = 503;
        Yii::$app->response->headers->set('Retry-After', $this->retryAfter);

        return $this->render($this->maintenanceView, [
            'maintenanceText' => $this->maintenanceText,
            'retryAfter' => $this->retryAfter
        ]);
    }
}
