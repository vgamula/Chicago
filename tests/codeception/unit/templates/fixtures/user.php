<?php
use app\models\User;

/**
 * @var $faker Faker\Generator
 * @var $index integer
 */
return [
    'username' => $faker->userName,
    'email' => $faker->email,
    'middleName' => $faker->lastName,
    'lastName' => $faker->lastName,
    'role' => rand(1, 2),
    'firstName' => $faker->firstName,
    'passwordHash' => Yii::$app->getSecurity()->generatePasswordHash('password_' . $index),
    'status' => User::STATUS_ACTIVE,
    'emailConfirmed' => 1,
    'createdAt' => time(),
    'updatedAt' => time(),
];