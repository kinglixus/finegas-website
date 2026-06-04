<?php

namespace App\Libraries;

class GoogleAuthenticator
{
    private $codeLength = 6;

    public function createSecret($secretLength = 16)
    {
        $secret = '';
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
        
        for ($i = 0; $i < $secretLength; $i++) {
            $secret .= $characters[random_int(0, strlen($characters) - 1)];
        }
        
        return $secret;
    }

    public function getQRCodeGoogleUrl($name, $secret)
    {
        $url = urlencode('otpauth://totp/' . $name . '?secret=' . $secret);
        return 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' . $url;
    }

    public function verifyCode($secret, $code, $discrepancy = 1, $currentTime = null)
    {
        if ($currentTime === null) {
            $currentTime = time();
        }

        $code = (string) $code;
        $secret = strtoupper($secret);

        if (strlen($code) !== $this->codeLength) {
            return false;
        }

        for ($i = -$discrepancy; $i <= $discrepancy; $i++) {
            $calculatedCode = $this->getCode($secret, $currentTime + (30 * $i));
            if ($this->timingSafeEquals($calculatedCode, $code)) {
                return true;
            }
        }

        return false;
    }

    private function getCode($secret, $time = null)
    {
        if ($time === null) {
            $time = floor(time() / 30);
        }

        $time = pack('N', $time);
        $time = str_pad($time, 8, "\0", STR_PAD_LEFT);

        $hmac = hash_hmac('sha1', $time, $this->base32Decode($secret), true);

        $offset = ord(substr($hmac, -1)) & 0x0F;
        $hash = substr($hmac, $offset, 4);

        $hash = unpack('N', $hash);
        $hash = $hash[1] & 0x7FFFFFFF;

        $hash = $hash % pow(10, $this->codeLength);

        return str_pad($hash, $this->codeLength, '0', STR_PAD_LEFT);
    }

    private function base32Decode($base32)
    {
        $base32 = strtoupper($base32);
        $base32Map = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';

        $output = '';
        $buffer = 0;
        $bitsLeft = 0;

        for ($i = 0; $i < strlen($base32); $i++) {
            $value = strpos($base32Map, $base32[$i]);
            if ($value === false) {
                continue;
            }

            $buffer = ($buffer << 5) | $value;
            $bitsLeft += 5;

            if ($bitsLeft >= 8) {
                $output .= chr(($buffer >> ($bitsLeft - 8)) & 0xFF);
                $bitsLeft -= 8;
            }
        }

        return $output;
    }

    private function timingSafeEquals($a, $b)
    {
        if (function_exists('hash_equals')) {
            return hash_equals($a, $b);
        }

        $result = strlen($a) ^ strlen($b);
        
        for ($i = 0; $i < strlen($a); $i++) {
            $result |= ord($a[$i]) ^ ord($b[$i]);
        }

        return $result === 0;
    }
}