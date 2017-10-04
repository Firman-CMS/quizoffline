<?php

namespace app\models;

use Yii;
use app\models\HadiahEsAniv;

/**
 * This is the model class for table "hasil".
 *
 * @property string $id
 * @property string $invoiceid
 * @property string $custid
 * @property string $custname
 * @property string $storeid
 * @property string $storename
 * @property string $tanggal
 *
 * @property Hadiah $hadiah
 */
class Hasil extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hasil';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'invoiceid','tanggal', 'custid', 'storeid', 'storename'], 'required','message'=>'Terjadi kesalahan, ada data yang kosong'],
            [['id'], 'integer'],
            [['invoiceid', 'custid', 'custname', 'storeid', 'storename'], 'string', 'max' => 250],
            // [['invoiceid'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'invoiceid' => 'Invoiceid',
            'custid' => 'Custid',
            'custname' => 'Custname',
            'storeid' => 'Storeid',
            'storename' => 'Storename',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHadiah()
    {
        return $this->hasOne(Hadiah::className(), ['id' => 'id']);
    }

    public function getHasilquis()
    {
        $query = Hasil::find()
            ->select('hasil.*,hadiah_es_aniv.nama')
            ->join('INNER JOIN', 'hadiah_es_aniv', 'hadiah_es_aniv.id=hasil.id')
            ->orderBy(['hasil.tanggal'=>SORT_ASC]);
        $command = $query->createCommand();
        $data = $command->queryAll();
        
        return $data;
    }

    public function countHasil($store_id)
    {
        $query = Hasil::find()
                ->where(['storeid' => $store_id]);
        $command = $query->createCommand();
        $data = $command->queryAll();
        // var_dump($id);
        // var_dump($pass);
        // die;
        return $data;

    }

    public function checkHasilReset($id, $store_id)
    {
        // print_r($id);
        // print_r($store_id);
        $query = Hasil::find()
                ->where(['storeid' => $store_id, 'id' => $id]);
                // ->where(['id' => $id]);
        $command = $query->createCommand();
        $data = $command->queryAll();
        // print_r($data);
        // die;
        return $data;

    }
}
