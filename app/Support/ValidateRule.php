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
            'open.picture' => [
                'format' => 'string',
                'n' => 'integer|min:1|max:8',
                'idx' => 'integer|min:-1|max:16'
            ],
            'open.upload' => [
                'file' => 'required|file',
                'dir' => 'required|string'
            ],
            'open.patch_upload' => [
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
                'tags' => 'array',
                'title' => 'required|string',
                'source' => 'required|string',
                'content' => 'required|string'
            ],
            'article.update' => [
                'user_id' => 'required|integer',
                'category_id' => 'required|integer',
                'tags' => 'array',
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
            ],
            'feedback.store' => [
                'nickname' => 'required|string|max:32',
                'email' => 'required|email|max:64',
                'content' => 'required|string',
            ],
            'link.store' => [
                'url'=>'required|string|url|unique:links,url',
                'name'=>'required|string|unique:links,name',
            ],
            'link.update' => [
                'url'=>'required|string|url|unique:links,url,'.$id,
                'name'=>'required|string|unique:links,name,'.$id,
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
