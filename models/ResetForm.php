<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ResetForm extends Model {

    public $invoice;
    public $custid;
    public $username;
    public $password;

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            [['invoice'], 'required', 'message' => 'Nomor Invoice tidak boleh kosong'],
            [['custid'], 'required', 'message' => 'Customer Id tidak boleh kosong'],
            [['username'], 'required', 'message' => 'Username tidak boleh kosong'],
            [['password'], 'required', 'message' => 'Password tidak boleh kosong'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels() {
        return [
            'invoice' => 'Masukan Nomor Invoice',
            'custid' => 'Customer ID',
            'username' => 'User',
            'password' => 'Password',
        ];
    }

}
