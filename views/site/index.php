<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use app\models\Hasil;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '1st Fantasties.id Anniversary';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hadiah-index">
    <?php
    $i = $pagination->getPage() * $pagination->getPageSize() + 1;
    foreach ($model as $m) {
        $penomoran = $i;
        $nomor = 'nomor' . strlen($penomoran);
        $hasil = Hasil::findOne($m->id);
        ?>
        <div class="col-xs-4 col-sm-1 col-md-1">
            <?php
            if ($hasil === null) {
                echo Html::a('<span class="' . $nomor . '">' . $penomoran . '</span>' . Html::img(Yii::$app->request->baseUrl . '/img/kotak.png'), ['/pilih', 'id' => $m->id], ['class' => 'thumbnail pilih']);
            } else {
                echo Html::a(Html::img(Yii::$app->request->baseUrl . '/img/hadiahonline/'.$m->gambar), ['/pilih/hadiah', 'id' => $m->id], ['class' => 'thumbnail pilih']);
            }
            ?>
        </div>

        <?php
        $i++;
    }
    ?>


    <div class="row page">
        <?php
        echo LinkPager::widget([
            'pagination' => $pagination,
        ]);
        ?>
    </div>

</div>
