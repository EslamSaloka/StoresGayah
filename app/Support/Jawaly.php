<?php

namespace App\Support;

class Jawaly {

    protected $url          = 'https://api-sms.4jawaly.com/api/v1/account/area/sms/send';
    protected $app_id       = '';
    protected $app_sec      = '';
    protected $app_hash     = '';
    protected $sender       = '';
    // ============================================= //
    protected $phoneNumber  = '';
    protected $message      = '';

    public function __construct()
    {
        $this->app_id   = env("SMS_APP_ID");
        $this->app_sec  = env("SMS_APP_SEC");
        $this->sender   = env("SMS_SENDER");
        $this->app_hash = base64_encode("{$this->app_id}:{$this->app_sec}");
    }

    private function getHeaders() {
        return [
            "Accept: application/json",
            "Content-Type: application/json",
            "Authorization: Basic {$this->app_hash}"
        ];
    }

    public function setPhone($phone) {
        $this->phoneNumber = $phone;
        return $this;
    }

    public function setMessage($message) {
        $this->message = $message;
        return $this;
    }

    public function send() {
        $messages = [
            "messages" => [
                [
                    "text" =>  (!is_numeric($this->message)) ? $this->message : "كود التفعيل: ".$this->message,
                    "numbers" => [
                        $this->phoneNumber
                    ],
                    "sender" => $this->sender
                ]
            ]
        ];

        $curl = curl_init($this->url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($messages));
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->getHeaders());
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $response_json = json_decode($response, true);
        if ($status_code == 200) {
            if (isset($response_json["messages"][0]["err_text"])) {
                return $response_json["messages"][0]["err_text"];
            } else {
                return "تم الارسال بنجاح  " . " job id:" . $response_json["job_id"];
            }
        } elseif ($status_code == 400) {
            return $response_json["message"];
        } elseif ($status_code == 422) {
            return "نص الرسالة فارغ";
        } else {
            return "محظور بواسطة كلاودفلير. Status code: {$status_code}";
        }
    }

}
