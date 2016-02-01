<?php
namespace api\common\models;

/**
 * API User class that overide Common's User class
 */
class User extends \common\models\User {
	/**
	 * @override_function(findIdentityByAccessToken, function_args, function_code) 
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['auth_key' => $token, 'status' => self::STATUS_ACTIVE]);
    }
}