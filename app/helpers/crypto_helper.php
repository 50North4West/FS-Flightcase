<?php

function encryptData($data) {

  //create random number
  $nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);

  //encrypt the input
  //to encrypt the value we pass it to sodium_crypto_secretbox() with our key and a $nonce. The nonce is generated using random_bytes(), because the same nonce should never be reused.
  $cipher = sodium_crypto_secretbox($data, $nonce, CRYPTOKEY);

  //This presents a problem because we need the nonce to decrypt the value later.
  //Luckily, nonces don’t have to be kept secret so we can prepend it to our $ciphertext then base64_encode() the value before saving it to the database.
  $encoded = base64_encode_url($nonce . $cipher);

  sodium_memzero($data);

  return $encoded;

}

function decryptData($data) {

  //When it comes to decrypting the value, we do the opposite.
  $decoded = base64_decode_url($data);

  //Because we know the length of nonce we can extract it using mb_substr() before decrypting the value.
  $nonce = mb_substr($decoded, 0, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, '8bit');
  $ciphertext = mb_substr($decoded, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, null, '8bit');
  $plaintext = sodium_crypto_secretbox_open($ciphertext, $nonce, CRYPTOKEY);

  sodium_memzero($data);

  return $plaintext;

}

//base64 encode but safe for use when passing in a url
function base64_encode_url($string) {
  return rtrim(strtr(base64_encode($string), '+/', '-_'), '=');
}

//base64 decode but safe for use when passing in a url
function base64_decode_url($string) {
  return base64_decode(str_pad(strtr($string, '-_', '+/'), strlen($string) % 4, '=', STR_PAD_RIGHT));
}
