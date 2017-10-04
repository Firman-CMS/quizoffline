<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Pilih Hadiah';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hadiah-form">
    <h1>PILIH HADIAH</h1>

    <?php
	$today = date("Y-m-d");
	$dateToko = array("2017-09-19", "2017-09-26", "2017-09-22");
	if(in_array($today, $dateToko)){
		$form = ActiveForm::begin();

	    echo $form->field($model, 'userid')->textInput(['maxlength' => true]);
	    echo $form->field($model, 'password')->passwordInput(['maxlength' => true]);

	    echo '<div class="form-group">';
	        echo Html::submitButton('Pilih', ['class' => 'btn btn-primary', 'name' => 'contact-button']);
	        echo "&nbsp;";
	        echo Html::a('Kembali', Yii::$app->getHomeUrl(), ['class' => 'btn btn-primary', 'name' => 'contact-button']);
	    echo '</div>';

	    ActiveForm::end();
	}else{

		$form = ActiveForm::begin();

	    echo $form->field($model, 'invoice')->textInput(['maxlength' => true]);
	    echo $form->field($model, 'custid')->textInput(['maxlength' => true]);

	    echo '<div class="form-group">';
	        echo Html::submitButton('Pilih', ['class' => 'btn btn-primary', 'name' => 'contact-button']);
	        echo "&nbsp;";
	        echo Html::a('Kembali', Yii::$app->getHomeUrl(), ['class' => 'btn btn-primary', 'name' => 'contact-button']);
	    echo '</div>';

	    ActiveForm::end();
		
	}

	?>
    

</div>