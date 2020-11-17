<?php

function siteRegistrationMessage($name, $email, $token, $encryptedEmail) {
  $message = '
    <p>
      <h2>'.SITENAME.' Account Confirmation</h2>
    </p>
    <p>
      Hi '.$name.',
    </p>
    <p>
      Welcome to '.SITENAME.'. Your account has been successfully registered and you&#39;re one step closer to being able to login.
      Before you do you will need to confirm your email address for security purposes. Please follow the link below to unlock your account.
    </p>
    <p>
      <a href="'.URLROOT.'/account/confirmaccount/'.$encryptedEmail.'/'.$token.'">confirm email address</a>
    </p>
    <p>
      If the link above doesn&#39;t work, please copy and paste the URL below in a new browser window to complete the setup.<br />
      '.URLROOT.'/account/confirmaccount/'.$encryptedEmail.'/'.$token.'
    </p>
    <p>
      The '.SITENAME.' team.
    </p>
  ';

  return $message;
}

function passwordResetMessage($name, $email, $token, $encryptedEmail) {
  $message = '
    <p>
      <h2>'.SITENAME.' Password Reset</h2>
    </p>
    <p>
      Hi '.$name.',
    </p>
    <p>
      There was recently a request to change the password on your account. If you requested the password change, please click the link below to set a new password within 24hrs.
    </p>
    <p>
      <a href="'.URLROOT.'/account/resetpassword/'.$encryptedEmail.'/'.$token.'">Reset Password</a>
    </p>
    <p>
      If the link above doesn&#39;t work, please copy and paste the URL below in a new browser window to complete the setup.<br />
      '.URLROOT.'/account/resetpassword/'.$encryptedEmail.'/'.$token.'
    </p>
    <p>
      The '.SITENAME.' team.
    </p>
  ';

  return $message;
}
