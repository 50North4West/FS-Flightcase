<?php
require APPROOT.'/views/template/header.php';
require APPROOT.'/views/template/navbar.php';
require APPROOT.'/views/template/heading.php';
  //flash messages
  flash('siteMessage');
?>

<div class="container">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Users</h5>
      <h6 class="card-subtitle mb-2 text-muted"></h6>
      <table class="table mt-4">
        <thead>
          <tr>
            <th>
              User
            </th>
            <th>
              Email & Username
            </th>
            <th>
              Group
            </th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($data['pageData'] as $user) : ?>
            <tr>
              <td>
                <a href="<?php echo URLROOT.'/users/account/'.$user->user_id.'/'.$user->user_firstName.' '.$user->user_lastName; ?>"><?php echo $user->user_firstName.' '.$user->user_lastName; ?></a>
              </td>
              <td>
                <?php echo $user->user_email; ?>
              </td>
              <td>
                <?php echo $user->userGroup_name; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php require APPROOT.'/views/template/footer.php'; ?>
