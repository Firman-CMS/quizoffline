<?php

namespace app\controllers;

use Yii;
use app\models\HadiahEsAniv;
use app\models\Hasil;
use app\models\InvoiceForm;
use app\models\InvoiceForm2;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LuckyController implements the CRUD actions for Hadiah model.
 */
class PilihController extends Controller {

    public function actionIndex($id) {
        $id = (int) $id;
        $hadiah = $this->findHadiah($id);
        $today = date("Y-m-d");
        $dateToko = array("2017-09-19", "2017-09-26", "2017-09-22");
        if(in_array($today, $dateToko)){
            $model = new InvoiceForm2();
        }else{
            $model = new InvoiceForm();
        }

        if (Hasil::findOne($id) !== null) {
            throw new NotFoundHttpException('Nomor ini sudah pernah dipilih.');
        }

        if (Yii::$app->request->post()) {

            if(!in_array($today, $dateToko)){
                $post = Yii::$app->request->post()['InvoiceForm'];
                $invoice = trim($post['invoice']);
                $custid = trim($post['custid']);

                $dataInvoice = $this->checkInvoice($invoice, $custid);
                // print_r($dataInvoice);
                // die;
                if ($dataInvoice['valid'] != 0 ) {
                    $transaction = Yii::$app->db->beginTransaction();
                    try {
                        $hasil = new Hasil();
                        $hasil->id = $hadiah->id;
                        $hasil->invoiceid = $invoice;
                        $hasil->custid = $dataInvoice['custid'];
                        $hasil->custname = $dataInvoice['custname'];
                        $hasil->storeid = $dataInvoice['storeid'];
                        $hasil->storename = $dataInvoice['storename'];
                        $hasil->tanggal = date('Y-m-d H:i:s');
                        if ($hasil->save()) {
                            $hadiah->stat = 1;
                            if ($hadiah->save()) {
                                $transaction->commit();
                                echo "<script type=\"text/javascript\">window.alert('Anda mendapatkan : {$hadiah->nama}');
                                    window.location.href = '/';</script>";
                                exit;
                                // alert $hadiah->nama;
                                // return $this->goHome();
                            } else {
                                $transaction->rollBack();
                                $model->addError('invoice', 'Data tidak dapat disimpan, silahkan coba kembali nanti');
                            }
                        } else {
                            $transaction->rollBack();
                            $model->addError('invoice', 'Data tidak dapat disimpan, silahkan coba kembali nanti');
                        }
                    } catch (\Exception $e) {
                        $transaction->rollBack();
                        $model->addError('invoice', 'Data tidak dapat disimpan, silahkan coba kembali nanti');
                    } catch (\Throwable $e) {
                        $transaction->rollBack();
                        $model->addError('invoice', 'Data tidak dapat disimpan, silahkan coba kembali nanti');
                    }
                } else {
                    if (isset($dataInvoice['errormsg']) && !empty($dataInvoice['errormsg'])) {
                        $model->addError('invoice', $dataInvoice['errormsg']);
                    } else
                        $model->addError('invoice', 'Nomor invoice tidak valid');
                }
            }else{
                $post = Yii::$app->request->post()['InvoiceForm2'];
                $user = trim($post['userid']);
                $password = trim($post['password']);

                $isUser = $this->checkUser($user, $password);
                if($isUser){
                    if (count(Hasil::countHasil($isUser['store'])) > 30) {
                        throw new NotFoundHttpException('Limit sudah terpenuhi, yaitu 30 kali pilih untuk store ini.');
                    }
                    $transaction = Yii::$app->db->beginTransaction();
                    try {
                        $hasil = new Hasil();
                        $hasil->id = $hadiah->id;
                        $hasil->invoiceid = (string) mt_rand(100000,999999);
                        $hasil->custid = (string)$isUser['id'];
                        $hasil->custname = $isUser['user'];
                        $hasil->storeid = $isUser['store'];
                        $hasil->storename = $isUser['storename'];
                        $hasil->tanggal = date('Y-m-d H:i:s');
                        if ($hasil->save()) {
                            $hadiah->stat = 1;
                            if ($hadiah->save()) {
                                $transaction->commit();
                                echo "<script type=\"text/javascript\">window.alert('Anda berpeluang mendapatkan : {$hadiah->nama}');
                                    window.location.href = '/';</script>";
                                exit;
                                // alert $hadiah->nama;
                                // return $this->goHome();
                            } else {
                                $transaction->rollBack();
                                $model->addError('userid', 'Data tidak dapat disimpan, silahkan coba kembali nanti');
                            }
                        } else {
                            $transaction->rollBack();
                            $model->addError('userid', 'Data tidak dapat disimpan, silahkan coba kembali nanti');
                        }
                    } catch (\Exception $e) {
                        $transaction->rollBack();
                        $model->addError('userid', 'Data tidak dapat disimpan, silahkan coba kembali nanti');
                    } catch (\Throwable $e) {
                        $transaction->rollBack();
                        $model->addError('userid', 'Data tidak dapat disimpan, silahkan coba kembali nanti');
                    }

                }else {
                    throw new NotFoundHttpException('User id dan password tidak valid');
                }
            }
        }

        return $this->render('index', [
                    'model' => $model,
        ]);
    }

    public function actionHadiah($id) {
        $id = (int) $id;
        $hadiah = $this->findHadiah($id);
        $hasil = $this->findHasil($id);

        return $this->render('hadiah', [
                    'hadiah' => $hadiah,
                    'hasil' => $hasil,
        ]);
    }

    private function checkUser($user,$pass) {
        $isUser   = User::findByUser($user, $pass);

        return $isUser;

    }

    private function checkInvoice($order, $email) {
        $ch = curl_init();
        // $url = 'http://192.168.200.161:8899/AxMidTest/AXmid.asmx';
        $url = 'http://112.78.151.179/AXMidLive2/AXMid.asmx';

        $xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:tem="http://tempuri.org/">
                    <soapenv:Header/>
                    <soapenv:Body>
                        <tem:GetLuckyDip>
                        <!--Optional:-->
                            <tem:xml>
                                <LuckyDip>
                                    <invoiceid>'.$order.'</invoiceid>
                                    <custid>'.$email.'</custid>
                                </LuckyDip>
                            </tem:xml>
                        </tem:GetLuckyDip>
                    </soapenv:Body>
                </soapenv:Envelope>';

        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_POST, true );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $xml);
        $result = curl_exec($ch);
        curl_close($ch);

        $esCard = $this->get_string_between($result,'<valid>','</valid>');
        
        if($esCard != 0 ){
            $data['custid'] = $this->get_string_between($result,'<custid>','</custid>');
            $data['custname'] = $this->get_string_between($result,'<custname>','</custname>');
            $data['storeid'] = $this->get_string_between($result,'<storeid>','</storeid>');
            $data['storename'] = $this->get_string_between($result,'<storename>','</storename>');
            $data['valid'] = $this->get_string_between($result,'<valid>','</valid>');
        }else{
            $data['valid'] = $this->get_string_between($result,'<valid>','</valid>');
            $data['errormsg'] = $this->get_string_between($result,'<errormsg>','</errormsg>');
        }
            
        return $data;
        // $url = 'http://idaff.es.id/checkorder.php';
        // $xml = [
        //     'orderid' => $order,
        //     'email' => $email
        // ];
        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        // $result = curl_exec($ch);
        // curl_close($ch);
        // $data = (array) json_decode($result);
        // // print_r($data);die;
        // if ($data['result'] == '1') {
        //     return $data;
        // } else {
        //     return null;
        // }
    }

    public function actionTesting() {
        print_r($this->checkInvoice('000004336', 'dewi.3asih@gmail.com'));
    }

    public function actionPrima(){

        for($bil=1;$bil<=100;$bil++){ // perulangan 1 sampai 100
            $k = 0;
            for($b=1;$b<=$bil;$b++){ // perulangan bilangan pembagi
                if($bil % $b == 0){ // modulus
                            $k++;
                }
            }
            if($k == 2){
                    echo $bil.',';
            }
        }
    }


    public function actionFibonacci($first = 2,$second = 4)
    {   
        $n = 10;
        $fib = [$first,$second];
        for($i=1;$i<$n;$i++)
        {
            $fib[] = $fib[$i]+$fib[$i-1];
        }
        print_r($fib);
    }


    private function get_string_between($string, $start, $end) {
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0)
            return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return trim(substr($string, $ini, $len));
    }

    private function xmlToArray($xml) {
        $xml = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $xml);
        $xml = simplexml_load_string($xml);
        $json = json_encode($xml);
        return json_decode($json);
    }

    protected function findHadiah($id) {
        if (($model = HadiahEsAniv::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Halaman tidak ditemukan.');
        }
    }

    protected function findHasil($id) {
        if (($model = Hasil::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Halaman tidak ditemukan.');
        }
    }

}
