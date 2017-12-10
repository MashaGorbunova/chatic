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

use dektrium\user\models\LoginForm as BaseLoginForm;


class LoginForm extends BaseLoginForm
{

    /** @inheritdoc */
    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            $this->user = $this->finder->findUserByEmail(trim($this->login));

            return true;
        } else {
            return false;
        }
    }
}