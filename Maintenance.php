<?php
namespace sankam\maintenance;

use Yii;
use yii\base\Component;
use yii\base\BootstrapInterface;

/**
 * Class Maintenance
 */
class Maintenance extends Component implements BootstrapInterface
{
    /**
     * @var boolean|\Closure boolean value or Closure that return
     * boolean indicating if app in maintenance mode or not
     */
    public $enabled;
    /**
     * @var string
     * @see \yii\web\Application::catchAll
     */
    public $catchAllRoute;

    /**
     * @var mixed
     * @link http://www.w3.org/Protocols/rfc2616/rfc2616-sec14.html#sec14.37
     */
    public $retryAfter = 300;
    /**
     * @var string
     */
    public $maintenanceLayout = '@sankam/maintenance/views/layouts/main.php';
    /**
     * @var string
     */
    public $maintenanceView = '@sankam/maintenance/views/maintenance/index.php';
    /**
     * @var string
     */
    public $maintenanceText;

    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param \yii\web\Application $app the application currently running
     */
    public function bootstrap($app)
    {
        if ($this->enabled instanceof \Closure) {
            $enabled = call_user_func($this->enabled, $app);
        } else {
            $enabled = $this->enabled;
        }
        if ($enabled) {
            if (!isset(Yii::$app->i18n->translations['maintenance'])) {
                Yii::$app->i18n->translations['maintenance'] = [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'en-GB',
                    'basePath' => '@sankam/maintenance/messages',
                ];
            }
            $this->maintenanceText = $this->maintenanceText ?: Yii::t('maintenance', 'Down to maintenance.');
            if ($this->catchAllRoute === null) {
                $app->controllerMap['maintenance'] = [
                    'class' => 'sankam\maintenance\controllers\MaintenanceController',
                    'retryAfter' => $this->retryAfter,
                    'maintenanceLayout' => $this->maintenanceLayout,
                    'maintenanceView' => $this->maintenanceView,
                    'maintenanceText' => $this->maintenanceText
                ];
                $app->catchAll = ['maintenance/index'];
                Yii::$app->view->registerAssetBundle(MaintenanceAsset::className());
            } else {
                $app->catchAll = [
                    $this->catchAllRoute,
                    'retryAfter' => $this->retryAfter,
                    'maintenanceText' => $this->maintenanceText
                ];
            }
        }
    }
}
