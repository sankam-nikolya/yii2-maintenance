<?php
/**
 * @var string $maintenanceText
 * @var int|string $retryAfter
 */
?>
<div class="row">
    <div class="col-md-6">
		<div class="maintenance-content">
			<p class="well">
				<?php echo Yii::t('common', $maintenanceText, [
					'retryAfter' => $retryAfter,
					'adminEmail' => Yii::$app->params['adminEmail']
				]) ?>
			</p>
		</div>
	</div>
</div>
