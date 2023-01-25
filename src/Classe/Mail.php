<?php

namespace App\Classe;
use Mailjet\Client;
use Mailjet\Resources;

class Mail {
    private $api_key = 'e42bc923fd204946ae5e2682faa73c16';
    private $api_key_secret = 'dcf0a8a6fb67d1325c249fa5a2865e29';

    public function send($to_email, $to_name, $subject, $content){
        $mj = new Client($this->api_key, $this->api_key_secret, true, ['version' => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "candice.doise@gmail.com",
                        'Name' => "La Boutique Française"
                    ],
                    'To' => [
                        [
                            'Email' => $to_email,
                            'Name' => $to_name
                        ]
                    ],
                    'TemplateID' => 4529211,
                    'TemplateLanguage' => true,
                    'Subject' => $subject,
                    'Variables' => [
                        'content' => $content,
                    ]
                    
                ]
            ]
        ];
$response = $mj->post(Resources::$Email, ['body' => $body]);
$response->success();
    }
}