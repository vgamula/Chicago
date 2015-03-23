<?php

namespace app\models;

use Yii;

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
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{

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
            'email' => 'Email',
            'firstName' => 'First Name',
            'middleName' => 'Middle Name',
            'lastName' => 'Last Name',
            'status' => 'Status',
            'role' => 'Role',
            'passwordHash' => 'Password Hash',
            'passwordResetToken' => 'Password Reset Token',
            'passwordResetExpire' => 'Password Reset Expire',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
            'emailConfirmToken' => 'Email Confirm Token',
            'emailConfirmed' => 'Email Confirmed',
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
     * @param  string  $password password to validate
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
        return self::findOne(['email']);
    }
}
