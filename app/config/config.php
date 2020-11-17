<?php

  //db params
  define('DB_HOST', 'localhost');
  define('DB_USER', 'root');
  define('DB_PASS', '');
  define('DB_NAME', 'flightcase');

  //live db params
  //define('DB_HOST', 'localhost');
  //define('DB_USER', 'ukpxt4ekqxrcq');
  //define('DB_PASS', '6gu5xsbh6tcn');
  //define('DB_NAME', 'dbykpxt4ekqxrc');

  //app root
  define('APPROOT', dirname(dirname(__FILE__)));

  //uploads folder
  define('UPLOADS', $_SERVER['DOCUMENT_ROOT'].'/flightcase/public/uploads/');

  //url root
  define('URLROOT', 'http://192.168.1.208:8080/flightcase'); //needs to be either http or https
  //define('URLROOT', 'https://flightcase.simulated.flights'); //needs to be either http or https

  //site name
  define('SITENAME', 'FS Flightcase');

  //site description - for good SEO should be 50-150 characters
  define('SITEDESCRIPTION', 'This is the site description');

  //default site image -
  define('SITEIMAGE', '');

  //app version
  define('APPVERSION', '0.0.0');

  //allowed mime types
  define('MIMETYPES', array(
    'pdf' => 'application/pdf',
    'bmp' => 'image/bmp',
		'gif' => 'image/gif',
    'jpeg' => 'image/jpeg',
    'jpg' => 'image/jpeg',
    'jpe' => 'image/jpeg',
    'png' => 'image/png',
    'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    'doc' => 'application/msword',
    'dot' => 'application/msword',
    'dotx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.template'
  ));

  //file size limit in bytes - 3mb = 3000000
  define('FILESIZE', '3000000');

  //PHPMail settings - SMTP Host
  define('EMAILSMTPHOST', 'yachtmanager.co.uk');

  //PHPMail settings - Email username
  define('EMAILUSERNAME', 'matt@yachtmanager.co.uk');

  //PHPMail settings - Email password
  define('EMAILPASSWORD', 'nbnU4qvg3uJtOyntG6uL');

  //PHPMail settings - Email set from Address
  define('EMAILSETFROMADDRESS', 'matt@yachtmanager.co.uk');

  //PHPMail settings - Email set from name
  define('EMAILSETFROMNAME', 'Matt Barraud');

  //PHPMail settings - Email sending port
  define('EMAILPORT', 25);

  //Google site verification token
  define('GOOGLEKEY', '');

  //twitter username
  define('TWITTER', '');

  //allow guests to register (true / false)
  define('REGISTRATION', true);

  define('DATEFORMAT', 'd/m/Y');
