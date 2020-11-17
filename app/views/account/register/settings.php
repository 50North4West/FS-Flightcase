<?php
  require APPROOT.'/views/inc/header.php';
  //flash messages
  flash('siteMessage');
?>
<div class="container">
  <div class="card">
    <div class="card-body">
      <a href="'.URLROOT.'/register" class="float-right"><i class="fas fa-arrow-alt-circle-left fa-lg text-secondary"></i></a><h5 class="card-title">User Registration Permissions</h5>
      <h6 class="card-subtitle mb-2 text-muted">You can see and update group permissions for user registration below:</h6>
      <form action="<?php echo URLROOT; ?>/register/settings" method="post">
      <table class="table mt-4">
        <thead>
          <tr>
            <th>
              Group
            </th>
            <th width="15%">
              View
            </th>
            <th width="15%">
              Create
            </th>
            <th width="15%">
              Edit
            </th>
            <th width="15%">
              Delete
            </th>
            <th width="15%">
              Super User
            </th>
          </tr>
        </thead>
        <tbody>

            <?php foreach($data['pageData'] as $permission) : ?>
              <tr>
                <td>
                  <input type="hidden" id="permission[<?php echo $permission->permission_id; ?>][recordId]" name="permission[<?php echo $permission->permission_id; ?>][recordId]" value="<?php echo $permission->permission_id; ?>" />
                  <?php echo $permission->userGroup_name; ?>
                </td>
                <td>
                  <div class="checkbox">
                    <input type="checkbox" value="1" id="read-<?php echo $permission->permission_id; ?>" name="permission[<?php echo $permission->permission_id; ?>][read]" <?php echo ($permission->permission_read) ? 'checked' : ''; ?>/>
                    <label for="read-<?php echo $permission->permission_id; ?>"></label>
                  </div>
                </td>
                <td>
                  <div class="checkbox">
                    <input type="checkbox" value="1" id="create-<?php echo $permission->permission_id; ?>" name="permission[<?php echo $permission->permission_id; ?>][create]" <?php echo ($permission->permission_create) ? 'checked' : ''; ?>/>
                    <label for="create-<?php echo $permission->permission_id; ?>"></label>
                  </div>
                </td>
                <td>
                  <div class="checkbox">
                    <input type="checkbox" value="1" id="update-<?php echo $permission->permission_id; ?>" name="permission[<?php echo $permission->permission_id; ?>][update]" <?php echo ($permission->permission_update) ? 'checked' : ''; ?>/>
                    <label for="update-<?php echo $permission->permission_id; ?>"></label>
                  </div>
                </td>
                <td>
                  <div class="checkbox">
                    <input type="checkbox" value="1" id="delete-<?php echo $permission->permission_id; ?>" name="permission[<?php echo $permission->permission_id; ?>][delete]" <?php echo ($permission->permission_delete) ? 'checked' : ''; ?>/>
                    <label for="delete-<?php echo $permission->permission_id; ?>"></label>
                  </div>
                </td>
                <td>
                  <div class="checkbox">
                    <input type="checkbox" value="1" id="settings-<?php echo $permission->permission_id; ?>" name="permission[<?php echo $permission->permission_id; ?>][settings]" <?php echo ($permission->permission_settings) ? 'checked' : ''; ?>/>
                    <label for="settings-<?php echo $permission->permission_id; ?>"></label>
                  </div>
                </td>
              </tr>
              <script>
                $(document).ready(function(){
                  $('#settings-<?php echo $permission->permission_id; ?>').change(function () {
                      if ($(this).prop('checked')) {
                          $('#read-<?php echo $permission->permission_id; ?>').prop('checked', true);
                          $('#create-<?php echo $permission->permission_id; ?>').prop('checked', true);
                          $('#update-<?php echo $permission->permission_id; ?>').prop('checked', true);
                          $('#delete-<?php echo $permission->permission_id; ?>').prop('checked', true);
                      } else {
                        $('#read-<?php echo $permission->permission_id; ?>').prop('checked', false);
                        $('#create-<?php echo $permission->permission_id; ?>').prop('checked', false);
                        $('#update-<?php echo $permission->permission_id; ?>').prop('checked', false);
                        $('#delete-<?php echo $permission->permission_id; ?>').prop('checked', false);
                      }
                  });
                });
              </script>
            <?php endforeach ?>
        </tbody>
      </table>
      <div class="row">
        <div class="col">

          <button type="submit" class="btn btn-primary float-right mt-3"><i class="fas fa-user-check"></i> Update Permissions</button>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>
<?php require APPROOT.'/views/inc/footer.php'; ?>
