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
    <h1>HADIAH</h1>
    <div class="col-md-4">
    <?php
    
    echo Html::a(Html::img(Yii::$app->request->baseUrl . '/img/hadiah/'.$hadiah->gambar), ['/pilih/hadiah', 'id' => $hadiah->id], ['class' => 'thumbnail pilih']);
    
    ?>
    </div>
    <div class="col-md-8">
        Hadiah : <?php echo $hadiah->nama;?><br/>
        <?= Html::a('Kembali', Yii::$app->getHomeUrl(), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
    </div><br><br><br>
    <div class="col-md-8">
        <?= Html::a('Reset', '../reset?id='.$hadiah->id, ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
    </div>
</div>