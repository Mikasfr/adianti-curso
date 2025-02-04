<?php
class EncryptionServices
{
    const SECRET = '1KtD1kMtmu08Nteq85qTwouUELduFSpnlqPETuL5vbN6HKqVaM';
    const SEED   = 'sB5FbqZrlKYyBHbKfD5vWOSwFvwZtWA4BNMTtlkVeAJ5Ub2Eog';
    const METHOD = 'aes-256-cbc';
    
    public static function encrypt($content)
    {
        $secretHash = md5(self::SECRET);
        $length = openssl_cipher_iv_length(self::METHOD);
        $iv = substr(md5(SELF::SEED), 0, $length);
        return openssl_encrypt( (string) $content, self::METHOD, $secretHash, 0, $iv);
    }
    
    public static function decrypt($content)
    {
        $secretHash = md5(self::SECRET);
        $length = openssl_cipher_iv_length(self::METHOD);
        $iv = substr(md5(SELF::SEED), 0, $length);
        return openssl_decrypt((string) $content, self::METHOD, $secretHash, 0, $iv);
    }
}
