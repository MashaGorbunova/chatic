<?php
namespace app\components;
use yii\base\BootstrapInterface;

class LanguageSelector implements BootstrapInterface
{
    static public $LNG_NAME = [
                        'uk' => 'uk',
                        'en' => 'en'
                    ];

    public $supportedLanguages = [];

    public function bootstrap($app)
    {
        if(! $lang = $app->session->get('Language')){
            $preferredLanguage = 'uk';
            $lang = $preferredLanguage;
        }

        $app->language = $lang;
    }
}
?>