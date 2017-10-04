<?php

namespace app\models;

use app\models\Userdb;

class User extends \yii\base\Object implements \yii\web\IdentityInterface {

    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;

//    private static $users = [
//        '100' => [
//            'id' => '100',
//            'username' => 'admin',
//            'password' => 'admin',
//            'authKey' => 'test100key',
//            'accessToken' => '100-token',
//        ],
//        '101' => [
//            'id' => '101',
//            'username' => 'demo',
//            'password' => 'demo',
//            'authKey' => 'test101key',
//            'accessToken' => '101-token',
//        ],
//    ];

    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {
        $user = Userdb::findOne($id);
        if ($user) {
            return new static([
                'id' => $user->id,
                'username' => $user->user,
                'password' => $user->password,
//              'store'=>$user->store,
                'authKey' => 'testKey-' . $user->id,
                'accessToken' => 'token-' . $user->id,
            ]);
        }
        return null;
//         return static::findOne($id);
//        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null) {
//        foreach (self::$users as $user) {
//            if ($user['accessToken'] === $token) {
//                return new static($user);
//            }
//        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username) {
//        foreach (self::$users as $user) {
//            if (strcasecmp($user['username'], $username) === 0) {
//                print_r($user);exit;
//                return new static($user);
//            }
//        }
        $user = Userdb::findOne(['user' => $username, 'status' => 1]);
        if ($user) {
            return new static([
                'id' => $user->id,
                'username' => $user->user,
                'password' => $user->password,
//              'store'=>$user->store,
                'authKey' => 'testKey-' . $user->id,
                'accessToken' => 'token-' . $user->id,
            ]);
        }

        return null;
    }


    /**
     * @inheritdoc
     */
    public function findByUser($user, $pass) {
        $data = Userdb::find()
                ->where(['user' => $user, 'password' => $pass])
                ->one();
        // var_dump($id);
        // var_dump($pass);
        // die;
        return $data;
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password) {
        return $this->password === $password;
    }

}
