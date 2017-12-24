<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\models;

use dektrium\user\models\User as BaseUser;
use dektrium\user\Finder;
use dektrium\user\helpers\Password;
use dektrium\user\Mailer;
use dektrium\user\Module;
use dektrium\user\models\Token;
use Yii;

/**
 * User ActiveRecord model.
 *
 * @property bool    $isAdmin
 * @property bool    $isBlocked
 * @property bool    $isConfirmed
 *
 * Database fields:
 * @property integer $id
 * @property string  $username
 * @property string  $email
 * @property string  $unconfirmed_email
 * @property string  $password_hash
 * @property string  $auth_key
 * @property string  $registration_ip
 * @property integer $confirmed_at
 * @property integer $blocked_at
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $last_login_at
 * @property integer $flags
 *
 * Defined relations:
 * @property Account[] $accounts
 * @property Profile   $profile
 * @property Student   $student
 *
 * Dependencies:
 * @property-read Finder $finder
 * @property-read Module $module
 * @property-read Mailer $mailer
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class User extends BaseUser
{
    public static $usernameRegexp = '/^[-a-zA-ZА-Яа-яЁёІіЇї0-9_\.@]+$/';
    public $imageFile;

    public function rules()
    {
        $rules = parent::rules();

        unset($rules['usernameUnique']); // take off unique username
        unset($rules['usernameMatch']); // take off pattern for username

        $rules ['imageFile'] = [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'];

        return $rules;
    }

    /**
     * This method is used to register new user account. If Module::enableConfirmation is set true, this method
     * will generate new confirmation token and use mailer to send it to the user.
     *
     * @return bool
     */
    public function register()
    {
        if ($this->getIsNewRecord() == false) {
            throw new \RuntimeException('Calling "' . __CLASS__ . '::' . __METHOD__ . '" on existing user');
        }

        $transaction = $this->getDb()->beginTransaction();

        try {
            $this->confirmed_at = $this->module->enableConfirmation ? null : time();
            $this->password     = $this->module->enableGeneratingPassword ? Password::generate(8) : $this->password;

            $this->trigger(self::BEFORE_REGISTER);

            if (!$this->save(false)) {
                $transaction->rollBack();
                return false;
            }

            if ($this->module->enableConfirmation) {
                /** @var Token $token */
                $token = \Yii::createObject(['class' => Token::className(), 'type' => Token::TYPE_CONFIRMATION]);
                $token->link('user', $this);
            }

            $this->mailer->sendWelcomeMessage($this, isset($token) ? $token : null);
            $this->trigger(self::AFTER_REGISTER);

            $transaction->commit();

            return true;
        } catch (\Exception $e) {
            $transaction->rollBack();
            \Yii::warning($e->getMessage());
            throw $e;
        }
    }

    /**
     * Creates new user account. It generates password if it is not provided by user.
     *
     * @return bool
     */
    public function create()
    {
        if ($this->getIsNewRecord() == false) {
            throw new \RuntimeException('Calling "' . __CLASS__ . '::' . __METHOD__ . '" on existing user');
        }

        $transaction = $this->getDb()->beginTransaction();

        try {
            $this->password = $this->password == null ? Password::generate(8) : $this->password;

            $this->trigger(self::BEFORE_CREATE);

            if (!$this->save(false)) {
                $transaction->rollBack();
                return false;
            }

            $this->confirm();

            $this->mailer->sendWelcomeMessage($this, null, true);
            $this->trigger(self::AFTER_CREATE);

            $transaction->commit();

            return true;
        } catch (\Exception $e) {
            $transaction->rollBack();
            \Yii::warning($e->getMessage());
            throw $e;
        }
    }

    /**
     * @return bool Whether the user is an admin or not.
     */
    public function getIsAdmin()
    {
        return
            (\Yii::$app->getAuthManager() && $this->module->adminPermission ?
                \Yii::$app->user->can($this->module->adminPermission) : false)
            || in_array($this->email, $this->module->admins);
    }

    public function getStudent(){
        return self::hasOne(Student::className(), ['user_id' => 'id']);
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    function getPhoto(){
        if($data = glob(Yii::getAlias('@webroot/gallery/user/'.$this->id.'.*'))){
            return str_replace(Yii::getAlias('@webroot'), Yii::getAlias('@web'), $data[0]);
        }else{
            return Yii::getAlias('@web/images/no_image.png');
        }
    }

    function getImagePath(){
        $path = Yii::getAlias('@webroot/gallery');
        if(! file_exists($path)){
            mkdir($path, 0775);
        }
        if(! file_exists($path.'/user')){
            mkdir($path.'/user', 0775);
        }
        return $path.'/user';
    }

    function saveImage(){
        $this->imageFile->saveAs($this->imagePath. '/'. $this->id. '.' . $this->imageFile->extension);
    }

    function deleteImage() {
        $path = $this->getPhoto();
        $basename = pathinfo($path)['basename'];

        if ($path != Yii::getAlias('@web/images/no_image.png')) {
            unlink($this->getImagePath().'/'.$basename);
        }
    }

    function isHasHistory(){
        $users = Chat::find()->where(['send_user_id' => $this->id])->all();
        if(count($users) > 0){
            return true;
        }
        else return false;
    }

}