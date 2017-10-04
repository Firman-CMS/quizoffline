<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hadiah_es_aniv".
 *
 * @property integer $id
 * @property string $nama
 * @property string $gambar
 * @property integer $nomor
 * @property integer $stat
 */
class HadiahEsAniv extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hadiah_es_aniv';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama', 'gambar', 'nomor', 'stat'], 'required'],
            [['nomor', 'stat'], 'integer'],
            [['nama', 'gambar'], 'string', 'max' => 255],
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

    public function getHasil()
    {
        return $this->hasOne(Hasil::className(), ['id' => 'id']);
    }
}
