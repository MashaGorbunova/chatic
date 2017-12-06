<?php
namespace frontend\models;

use common\models\catalog\Country;
use common\models\company\Company;
use common\models\company\CompanyCategory;
use yii\base\Model;
use common\models\user\User;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $login;
    public $password;
    public $phone;
    public $country;
    public $language;

    public $company_name;
    public $currency;
    public $company_category = [];
    public $currency_source;
    public $rate_type;
    public $region;
    public $national_company;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required', 'on' => User::SCENARIO_SIGNUP],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['login', 'trim'],
            ['login', 'required', 'on' => User::SCENARIO_SIGNUP],
            ['login', 'email'],
            ['login', 'string', 'max' => 255],
            ['login', 'unique', 'targetClass' => '\common\models\user\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required', 'on' => User::SCENARIO_SIGNUP],
            ['password', 'string', 'min' => 6],

            ['phone', 'required', 'on' => User::SCENARIO_SIGNUP],
            ['phone', 'string', 'max' => 100],

            [['language', 'company_name'], 'string', 'max' => 100],
            [['country', 'currency', 'currency_source', 'national_company'], 'integer'],
            ['rate_type', 'string', 'max' => 3],
            [['company_name', 'currency', 'currency_source', 'rate_type', 'company_category'], 'required', 'on' => User::SCENARIO_SIGNUP_COMPANY],

            [
                ['region'],
                'required',
                'on' => User::SCENARIO_SIGNUP_COMPANY,
                'when' => function($model){
                    if($model->country == Country::find()->where(['code' => 'UA'])->select('id')->scalar() and
                        $model->national_company == 0){
                        return true;
                    }
                    return false;
                },
                'whenClient' => "function (attribute, value) {
                     if($('#signupform-country').val() == '".Country::find()->where(['code' => 'UA'])->select('id')->scalar()."' && 
                         $('#signupform-national_company').prop('checked') == false)
                    return true;
                }"
            ],

        ];
    }

    public function attributeLabels()
    {
        return [
            'username'              => Yii::t('app', 'Username'),
            'login'                 => Yii::t('app', 'E-mail'),
            'password'              => Yii::t('app', 'Password'),
            'phone'                 => Yii::t('app', 'Phone'),
            'language'              => Yii::t('app', 'Language'),
            'company_name'          => Yii::t('app', 'Company Name'),
            'currency'              => Yii::t('app','Currency'),
            'country'               => Yii::t('app','Country'),
            'currency_source'       => Yii::t('app', 'Currency Source'),
            'rate_type'             => Yii::t('app', 'Rate Type'),
            'company_category'      => Yii::t('app', 'Company Category'),
            'region'                => Yii::t('app', 'Region'),
            'national_company' => Yii::t('app', 'National Company')
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->login = $this->login;
        $user->phone = $this->phone;
        $user->preferred_lang = $this->language;
        $user->country_id = $this->country;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        if($user->save()){
            $user->sendConfirm($this->password);
            return $user;
        }

        else return null;
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signupCompany()
    {
        if (!$this->validate()) {
            return null;
        }

        $company = new Company();
        $company->name = $this->company_name;
        $company->owner_id = Yii::$app->user->id;
        $company->country_id = $this->country;
        $company->currency_id = $this->currency;
        $company->currency_source_id = $this->currency_source;
        $company->rate_type = $this->rate_type;
        $company->created_date = date('Y-m-d H:i:s', time());
        $company->setCategories($this->company_category);
        if(!$this->national_company){
            $company->setRegions ($this->region);
        }
        $company->national_company = $this->national_company;

        if($company->save()){

            $user = User::findIdentity(Yii::$app->user->id);
            $user->role = User::ROLE_COMPANY_ADMIN;
            $user->company_id = $company->id;

            if($user->save()){
                return $user;
            }
            else return null;
        }

        else return null;
    }
}
