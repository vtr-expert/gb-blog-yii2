<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "blg_user".
 *
 * @property integer $id
 * @property string $username
 * @property string $surname
 * @property string $name
 * @property string $password write-onlu password
 * @property string $salt
 * @property string $access_token
 * @property string $create_date
 *
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blg_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'surname', 'name', 'password'], 'required'],            
            [['username'], 'email'],            
            [['username'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => _('ID'),
            'name' => _('Имя'),
            'surname' => _('Фамилия'),
            'online' => _('Онлайн'),
            'password' => _('Пароль'),
            'salt' => _('Соль'),
            'access_token' => _('Ключ авторизации'),            
        ];
    }
   
    /**
     * Before save event handler
     * @param boolean $insert
     * @return boolean
     */
    public function beforeSave($insert) 
    {
        if (parent::beforeSave($insert)) {
            if ($this->getIsNewRecord() && !empty($this->password)) {
                $this->salt = $this->saltGenerator();
            }
            if (!empty($this->password)) {
                $this->password = $this->passWithSalt($this->password, $this->salt);
            } else {
                unset($this->password); // уничтожаем атрибут, чтобы он не перезаписывался в БД
            }
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Generates the salt
     * @return string
     */
    public function saltGenerator() 
    {
        return hash("sha512", uniqid('salt_', true));
    }
    
    /**
     * Returns password with the salt
     * @param string $password
     * @param string $salt
     * @return string
     */
    public function passWithSalt($password, $salt) 
    {
        return hash("sha512", $password .$salt);
    }
    
    /**
     * Finds identity
     * @param int $id
     */
    public static function findIdentity($id) 
    {
        return static::findOne(['id' => $id]);
    }
    
    /**
     * Finds user by access token
     * @param int $token
     * @param int $type
     */
    public static function findIdentityByAccessToken($token, $type = null) 
    {
        return static::findOne(['access_token' => $token]);
    }
    
    /**
     * Finds user by username
     * @param string $username
     * @return string
     */
    public static function findByUsername($username) 
    {
        return static::findOne(['username' => $username]);
    }
    
    /**
     * Returns user's Id
     * @return int
     */
    public function getId() 
    {
        return $this->getPrimaryKey();
    }
    
    /**
     * Returns user's Auth Key
     * @return string
     */
    public function getAuthKey() 
    {
        return $this->getAuthKey();
    }
    
    /**
     * Validates Auth Key
     * @param string $authKey
     * @return boolean
     */
    public function validateAuthKey($authKey) 
    {
        return $this->getAuthKey() === $authKey;
    }
    
    /**
     * Validates password    
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password) 
    {
        return $this->password === $this->passWithSalt($password, $this->salt);
    }
    
    /**
     * Generates password hash from password and sets it to the model     * 
     * @param string $password
     */
    public function setPassword($password) 
    {
        $this->password = $this->passWithSalt($password, $this->saltGenerator());
    }
    
    /**
     * Generates "remember me" authentication key 
     */
    public function generateAuthKey() 
    {
        $this->access_token = Yii::$app->security->generateRandomString();
    }
}
