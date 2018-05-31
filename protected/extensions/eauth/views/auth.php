<?php foreach ($services as $name => $service): ?>
	<?php if($service->id == 'facebook'): ?>
		<div style="height: 50px;">
			<div style="display:block;width:290px;background:#3B5998;" class="uk-button auth-service <?=$service->id;?>">
				<?php
				$html = '<i class="uk-icon-facebook-official" style="font-size:32px;padding:4px;float:left;"></i>';
				$html .= '<div style="padding-top:8px;">&nbsp;&nbsp;Entrar com ' . $service->title . '</div>';

				$url = Yii::app()->controller->createUrl($action,array(
					'service' => $name,
				)) . (isset($_GET['t']) ? '&t=' . $_GET['t'] : '' );

				$html = CHtml::link($html, $url, array(
					'class' => 'auth-link ' . $service->id,
					'style' => 'display:block;color:white;text-shadow:none;font-weight:bold;text-decoration:none;text-align:left;padding-bottom:5px;'
				));
				echo $html;
				?>
			</div>
		</div>
	<?php else: ?>
		<div style="height: 50px;">
			<div style="display:block;width:290px;background:#DD4B39;" class="uk-button auth-service <?=$service->id;?>">
			<?php
			$html = '<i class="uk-icon-google" style="font-size:32px;padding:4px;float:left;"></i>';
			$html .= '<div style="padding-top:8px;">&nbsp;&nbsp;&nbsp;Entrar com ' . $service->title . '</div>';
			$url = Yii::app()->controller->createUrl($action,array('service' => $name)) . (isset($_GET['t'])?$_GET['t']:'');
			$html = CHtml::link($html,$url, array(
				'class' => 'auth-link ' . $service->id,
				'style' => 'display:block;color:white;text-shadow:none;font-weight:bold;text-decoration:none;text-align:left;padding-bottom:5px;'
			));
			echo $html;
			?>
			</div>
		</div>
	<?php endif; ?>
<?php endforeach; ?>
