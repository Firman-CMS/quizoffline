<?php


use	yii\grid\GridView;

$this->title = 'Hasil Quiz Fantasties.id Anniversary';
$this->params['breadcrumbs'][] = $this->title;
// print_r($dataProvider); die;
echo GridView::widget([
	'id' => 'scan-batch-grid',
    'dataProvider' => $dataProvider,
    'options' => [ 'style' => 'background-color:#fff' ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'invoiceid',
        'nama',
        'custid',
        'custname',
        'tanggal',
    ],
]); 
