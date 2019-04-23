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
            ],
            'user.store' => [
                'name' => 'required|string',
                'email' => 'required|string|email|unique:users,email'
            ],
            'user.update' => [
                'name' => 'required|string',
                'email' => 'required|string|email|unique:users,email,'.$id
            ],
            'article.store' => [
                'user_id' => 'required|integer',
                'category_id' => 'required|integer',
                'tags' => 'required|array',
                'title' => 'required|string',
                'source' => 'required|string',
                'content' => 'required|string'
            ],
            'article.update' => [
                'user_id' => 'required|integer',
                'category_id' => 'required|integer',
                'tags' => 'required|array',
                'title' => 'required|string',
                'source' => 'required|string',
                'content' => 'required|string'
            ],
            'article.batch' => [
                'ids' => 'required|array'
            ],
            'category.store' => [
                'name' => 'required|string'
            ],
            'category.update' => [
                'name' => 'required|string'
            ],
            'category.batch' => [
                'ids' => 'required|array'
            ],
            'tag.store' => [
                'name' => 'required|string'
            ],
            'tag.update' => [
                'name' => 'required|string'
            ],
            'tag.batch' => [
                'ids' => 'required|array'
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
