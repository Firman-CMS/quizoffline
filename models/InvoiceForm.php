<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class InvoiceForm extends Model
{
    public $invoice;
    public $custid;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['invoice'], 'required','message'=>'Nomor Order tidak boleh kosong'],
            [['custid'], 'required','message'=>'Custid tidak boleh kosong'],
            // [['custid'], 'email','message'=>'Email tidak valid'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'invoice' => 'Masukan Nomor Order',
            'custid' => 'Customer Id',
        ];
    }
   
}
