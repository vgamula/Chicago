<?php

namespace app\models;

use nullref\useful\PasswordTrait;
use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $email
 * @property string $firstName
 * @property string $lastName
 * @property integer $isActive
 * @property integer $role
 * @property string $passwordHash
 * @property string $passwordResetToken
 * @property integer $passwordResetExpire
 * @property integer $createdAt
 * @property integer $updatedAt
 * @property string $emailConfirmToken
 * @property integer $emailConfirmed
 *
 * @property string $fullName
 */
class User extends ActiveRecord implements IdentityInterface
{
    const SCENARIO_SET_PASSWORD = 'set-password';
    use PasswordTrait;
    /**
     * Roles
     */
    const ROLE_ADMIN = 1;
    const ROLE_USER = 2;

    /**
     * Statuses
     */
    const ACTIVE = 1;
    const NONACTIVE = 0;

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
            [['password'], 'required', 'on' => static::SCENARIO_SET_PASSWORD],
            [['email', 'passwordHash'], 'required'],
            [['isActive', 'role', 'passwordResetExpire', 'createdAt', 'updatedAt', 'emailConfirmed'], 'integer'],
            [['email', 'firstName', 'lastName', 'password', 'passwordHash', 'passwordResetToken', 'emailConfirmToken'], 'string', 'max' => 255],
            ['role', 'preventChangingOwnRole'],
        ];
    }

    public function preventChangingOwnRole($attribute, $params)
    {
        if (isset($this->oldAttributes['role']) && ($this->oldAttributes['role'] == User::ROLE_ADMIN && $this->role != User::ROLE_ADMIN) && $this->id == Yii::$app->user->id) {
            $this->addError($attribute, Yii::t('project', 'You cannot change own role.'));
        }
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
            'lastName' => Yii::t('user', 'Last Name'),
            'isActive' => Yii::t('user', 'Is Active'),
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
        return self::findOne($id);
    }

    /**
     * @inheritdoc
     * @param mixed $token
     * @param null $type
     * @return void|IdentityInterface
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException();
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
     * @param string $authKey
     */
    public function validateAuthKey($authKey)
    {
        return $authKey == md5($this->email . $this->passwordHash);
    }

    /**
     * @inheritdoc
     * @return string|void
     */
    public function getAuthKey()
    {
        return md5($this->email . $this->passwordHash);
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

    public function getFullName()
    {
        return "$this->lastName $this->firstName";
    }
}
