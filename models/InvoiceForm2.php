<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class InvoiceForm2 extends Model
{
    public $userid;
    public $password;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['userid'], 'required','message'=>'User ID tidak boleh kosong'],
            [['password'], 'required','message'=>'Password tidak boleh kosong'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'userid' => 'Masukan User ID',
            'password' => 'Password',
        ];
    }
   
}
