<?php

namespace App\Support;


class ValidateRule
{

    protected function rules($ruleName, $id = '')
    {
        $rules = [
            'user.login' => [
                'password' => 'required|string'
            ],
        ];

        if (isset($rules[$ruleName])) {
            return $rules[$ruleName];
        }

        return [];
    }

    public function getRule($ruleName = '', $id = '')
    {
        return $this->rules($ruleName, $id);
    }
}
