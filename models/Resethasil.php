<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hasil".
 *
 * @property string $id
 * @property integer $hadiahid 
 * @property integer $userid
 * @property string $invoiceid
 * @property string $custid
 * @property string $custname
 * @property string $storeid
 * @property string $storename
 *
 * @property Hadiah $hadiah
 */
class Resethasil extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'resethasil';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hadiahid','tanggal','hasil_tanggal','userid', 'invoiceid', 'custid', 'storeid', 'storename'], 'required','message'=>'Terjadi kesalahan, ada data yang kosong'],
            [['hadiahid','userid'], 'integer'],
            [['invoiceid', 'custid', 'custname', 'storeid', 'storename'], 'string', 'max' => 250],
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
}
