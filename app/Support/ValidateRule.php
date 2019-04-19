<?php

namespace App\Support;


class ValidateRule
{

    protected function rules($ruleName, $id = '')
    {
        $rules = [
            'auth.login' => [
                'login_name' => 'required|string',
                'password' => 'required|string'
            ],
            'open.upload' => [
                'file' => 'required|file',
                'dir' => 'required|string'
            ]
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
