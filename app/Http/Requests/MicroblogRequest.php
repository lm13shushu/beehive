<?php

namespace App\Http\Requests;

class MicroblogRequest extends Request
{
    public function rules()
    {
        switch($this->method())
        {
            // CREATE
            case 'POST':
            {
                return [
                    // CREATE ROLES
                    'content'       => 'required|max:250',
                    'category_id' => 'required|numeric',
                ];
            }
            // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [
                    // UPDATE ROLES
                ];
            }
            case 'GET':
            case 'DELETE':
            default:
            {
                return [];
            };
        }
    }

    public function messages()
    {
        return [
            // Validation messages
            'content.max' => '微博内容不得超过250个字！'
        ];
    }
}
