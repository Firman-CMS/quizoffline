<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hadiah".
 *
 * @property string $id
 * @property string $nama
 * @property string $gambar
 * @property integer $nomor
 * @property integer $stat
 *
 * @property Hasil $id0
 */
class Hadiah extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hadiah';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama', 'gambar', 'nomor', 'stat'], 'required'],
            [['nomor', 'stat'], 'integer'],
            [['nama', 'gambar'], 'string', 'max' => 250],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Hasil::className(), 'targetAttribute' => ['id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'gambar' => 'Gambar',
            'nomor' => 'Nomor',
            'stat' => 'Stat',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHasil()
    {
        return $this->hasOne(Hasil::className(), ['id' => 'id']);
    }
}
