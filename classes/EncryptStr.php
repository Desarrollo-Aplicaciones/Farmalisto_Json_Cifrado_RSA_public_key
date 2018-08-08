<?php

class EncryptStr
{
    public static function encrypt($jsonData, $publicKey)
    {
        if (! empty($jsonData) && ! empty($publicKey)) {

            // read the public key
            $public_key = openssl_pkey_get_public($publicKey);
            $public_key_details = openssl_pkey_get_details($public_key);
            // there are 11 bytes overhead for PKCS1 padding
            $encrypt_chunk_size = ceil($public_key_details['bits'] / 8) - 11;
            $output = null;
            // loop through the long plain text, and divide by chunks

            while ($jsonData) {
                $chunk = substr($jsonData, 0, $encrypt_chunk_size);
                $jsonData = substr($jsonData, $encrypt_chunk_size);
                $encrypted = '';
                if (! openssl_public_encrypt($chunk, $encrypted, $public_key))
                    return 'Failed to encrypt data';
                $output .= $encrypted;
            }

            openssl_free_key($public_key);

            return base64_encode($output);
        }

        return null;
    }
}