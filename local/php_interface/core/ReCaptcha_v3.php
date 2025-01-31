<?php

class ReCaptcha_v3
{
    private const PUBLIC_KEY = "";
    private const SECRET_KEY = "";

    private string $url = 'https://www.google.com/recaptcha/api/siteverify';
    private float $threshold = 0.7;

    public function getPublicKey()
    {
        return self::PUBLIC_KEY;
    }

    public function verify($response)
    {
        $captchaParams = [
            'secret' => self::SECRET_KEY,
            'response' => $response,
        ];

        $recaptchaResult = file_get_contents($this->url . '?' . http_build_query($captchaParams));
        $recaptchaResult = json_decode($recaptchaResult);

        return isset($recaptchaResult->score) ? $recaptchaResult->score >= $this->threshold : false;
    }
}
