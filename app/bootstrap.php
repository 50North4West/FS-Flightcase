<?php
//load the key
require_once '../key.php'; //make sure that this is changed to outside the webroot

//load the config
require_once 'config/config.php';

//load helpers
require_once 'helpers/url_helper.php';
require_once 'helpers/session_helper.php';
require_once 'helpers/echo_helper.php';
require_once 'helpers/upload_helper.php';
require_once 'helpers/crypto_helper.php';
require_once 'helpers/email_helper.php';
require_once 'helpers/email_template_helper.php';
require_once 'helpers/date_helper.php';

//load core libraries
require_once 'libraries/Controller.php';
require_once 'libraries/Core.php';
require_once 'libraries/Database.php';
require_once 'libraries/Validate.php';

//load templates
require_once 'templates/emails.php';
