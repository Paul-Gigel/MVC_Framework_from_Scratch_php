<?php

namespace app\models;

use paul_core\paul_core\Model;

class ContactForm extends Model
{
    public string $subject = '';
    public string $email = '';
    public string $body = '';
    public function rules(): array
    {
        return [
            'subject' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED],
            'body' => [self::RULE_REQUIRED]
        ];
    }
    public function labels(): array
    {
        return [
            'subject' => 'Enter your Subject',
            'email' => 'Enter your Email',
            'body' => 'Enter your Body'
        ];
    }
    public function send()
    {
        return true;
    }
}