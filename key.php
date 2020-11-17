<?php

//for security purposes this file should be moved outside of the main web root so that it is not accessible to joe public.
//point to the file location in bootstrap.php

define('CRYPTOKEY', base64_decode('RlrE3cBwfzFmwEyyPNRVwkSaHWN8uP8y8FCdDXT/09s='));

//How to generate a site encryption key
//uncomment the code below to generate a site key. This should be stored prior to creation of any encrypted records in the database
//if the encryption key is changed you will not be able to decrypt the records in the database!!!


//$privateKey = random_bytes(SODIUM_CRYPTO_SECRETBOX_KEYBYTES);
//echo 'This is your encryption key: '.base64_encode($privateKey);
