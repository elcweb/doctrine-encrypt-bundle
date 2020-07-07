<?php

namespace Elcweb\DoctrineEncryptBundle\Encryptor;

use DoctrineEncrypt\Encryptors\EncryptorInterface;
use Exception;

/**
 * Class AES256Encryptor
 * @package Encryptor
 */
class AES256Encryptor implements EncryptorInterface
{
    /**
     * Secret key for aes algorythm
     * @var string
     */
    private $secretKey;

    /**
     * Initialization of encryptor
     * @param string $key
     */
    public function __construct($key)
    {
        $this->secretKey = $key;
    }

    /**
     * Implementation of EncryptorInterface encrypt method
     * @param string $data
     * @return string
     * @throws \Exception
     */
    public function encrypt($data)
    {
        $nonce = random_bytes(
            SODIUM_CRYPTO_SECRETBOX_NONCEBYTES
        );

        $cipher = base64_encode(
            $nonce.
            sodium_crypto_secretbox(
                $data,
                $nonce,
                $this->secretKey
            )
        );
        sodium_memzero($data);
        sodium_memzero($this->secretKey);

        return trim($cipher);
    }

    /**
     * Implementation of EncryptorInterface decrypt method
     * @param string $data
     * @return string
     * @throws Exception
     */
    public function decrypt($data)
    {
        if (null === $data) return null;
        if ('' === $data) return '';

        $decoded = base64_decode($data);
        if ($decoded === false) {
            throw new Exception('Scream bloody murder, the encoding failed');
        }
        if (mb_strlen($decoded, '8bit') < (SODIUM_CRYPTO_SECRETBOX_NONCEBYTES + SODIUM_CRYPTO_SECRETBOX_MACBYTES)) {
            throw new Exception('Scream bloody murder, the message was truncated');
        }
        $nonce = mb_substr($decoded, 0, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, '8bit');
        $cipherText = mb_substr($decoded, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, null, '8bit');

        $plain = sodium_crypto_secretbox_open(
            $cipherText,
            $nonce,
            $this->secretKey
        );
        if ($plain === false) {
            throw new Exception('the message was tampered with in transit');
        }
        sodium_memzero($cipherText);
        sodium_memzero($this->secretKey);

        return $plain;
    }
}
