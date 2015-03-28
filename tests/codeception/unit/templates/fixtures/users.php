<?php
use app\models\User;

/**
 * @var $faker Faker\Generator
 * @var $index integer
 */

return [
    'email' => $faker->email,
    'firstName' => $faker->firstName,
    'lastName' => $faker->lastName,
    'role' => rand(1, 2),
    'passwordHash' => Yii::$app->getSecurity()->generatePasswordHash('password_' . $index),
    'status' => User::STATUS_ACTIVE,
    'emailConfirmed' => 1,
    'createdAt' => time(),
    'updatedAt' => time(),
];