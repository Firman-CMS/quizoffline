<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hadiah".
 *
 * @property string $id
 * @property string $user
 * @property string $password
 * @property integer $store
 * @property integer $status
 *
 * @property Hasil $id0
 */
class Userdb extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['user', 'password', 'store', 'status'], 'required'],
            [['status'], 'integer', 'max' => 1],
            [['user', 'password', 'store'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'password' => 'Password',
            'store' => 'Store',
            'user' => 'User',
            'status' => 'Status',
        ];
    }

}
