<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Reset Hadiah';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hadiah-form">
    <h1>RESET HADIAH</h1>

    <?php
		$form = ActiveForm::begin();

	    echo $form->field($model, 'userid')->textInput(['maxlength' => true]);
	    echo $form->field($model, 'password')->passwordInput(['maxlength' => true]);

	    echo '<div class="form-group">';
	        echo Html::submitButton('Reset', ['class' => 'btn btn-primary', 'name' => 'contact-button']);
	        echo "&nbsp;";
	        echo Html::a('Kembali', Yii::$app->getHomeUrl(), ['class' => 'btn btn-primary', 'name' => 'contact-button']);
	    echo '</div>';

	    ActiveForm::end();
	

		
		

	?>
    

</div>