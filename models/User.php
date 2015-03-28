<?php

namespace app\models;

use nullref\useful\PasswordTrait;
use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $email
 * @property string $firstName
 * @property string $middleName
 * @property string $lastName
 * @property integer $status
 * @property integer $role
 * @property string $passwordHash
 * @property string $passwordResetToken
 * @property integer $passwordResetExpire
 * @property integer $createdAt
 * @property integer $updatedAt
 * @property string $emailConfirmToken
 * @property integer $emailConfirmed
 */
class User extends ActiveRecord implements IdentityInterface
{

    use PasswordTrait;
    /**
     * Roles
     */
    const ROLE_ADMIN = 1;
    const ROLE_USER = 2;


    /**
     * Statuses
     */
    const STATUS_ACTIVE = 1;
    const STATUS_NONACTIVE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'passwordHash', 'createdAt', 'updatedAt'], 'required'],
            [['status', 'role', 'passwordResetExpire', 'createdAt', 'updatedAt', 'emailConfirmed'], 'integer'],
            [['email', 'firstName', 'middleName', 'lastName', 'passwordHash', 'passwordResetToken', 'emailConfirmToken'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => Yii::t('user', 'Email'),
            'firstName' => Yii::t('user', 'First Name'),
            'middleName' => Yii::t('user', 'Middle Name'),
            'lastName' => Yii::t('user', 'Last Name'),
            'status' => Yii::t('user', 'Status'),
            'role' => Yii::t('user', 'Role'),
            'passwordHash' => Yii::t('user', 'Password Hash'),
            'passwordResetToken' => Yii::t('user', 'Password Reset Token'),
            'password' => Yii::t('user', 'Password'),
            'passwordResetExpire' => Yii::t('user', 'Password Reset Expire'),
            'createdAt' => Yii::t('user', 'Created At'),
            'updatedAt' => Yii::t('user', 'Updated At'),
            'emailConfirmToken' => Yii::t('user', 'Email Confirm Token'),
            'emailConfirmed' => Yii::t('user', 'Email Confirmed'),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        //@TODO implement it
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        //@TODO implement it

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        //@TODO implement it
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        //@TODO implement it
    }

    /**
     * Validates password
     *
     * @param  string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->passwordHash);
    }

    /**
     * @param $email
     * @return null|static
     */
    public static function findByEmail($email)
    {
        return self::findOne(['email' => $email]);
    }
}
