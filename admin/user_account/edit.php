<?php
require_once('../../private/initialize.php');
require_login();

if (!isset($_GET['email'])) {
  redirect_to(url_for('/user_account/index.php'));
}
$email = $_GET['email'];

if (is_post_request()) {
  $new_email = $_POST['email'];
  $account = [];
  //$account['id'] = $id;
  $account_email = $email;
  $account_password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  $account_set = find_all_users();
  while ($account = mysqli_fetch_assoc($account_set)) {
    if ($account['email'] == $account_email) {
      if ($_POST['email'] == null) {
        $new_email = $email;
      }
      if ($_POST['password'] == null) {
        $account_password = $account['password'];
      }
      break;
    }
  }

  $result = update_user($account_email, $new_email, $account_password);
  if ($result === true) {
    $_SESSION['message'] = 'User account updated.';
?>
    <meta http-equiv="Refresh" content="0.5;url=index.php">
<?php
    //redirect_to(url_for('/staff/admins/show.php?id=' . $id));
  } else {
    $errors = $result;
  }
} else {
  $account = find_user_by_email($email);
}

?>

<?php $page_title = 'Edit User Account'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<body>
  <header>
    <h1>Account Menu</h1>
  </header>

  <div id="content">

    <a class="action" href="<?php echo url_for('/user_account/index.php'); ?>">&laquo; Back to List</a>

    <div class="admin edit">
      <h1>Edit User Account</h1>
      <p style="color:red;">If field is left empty data will NOT be changed!</p>

      <!-- <?php // echo display_errors($errors); 
            ?> -->

      <form action="<?php echo url_for('/user_account/edit.php?email=' . h(u($email))); ?>" method="post">

        <dl>
          <p class="bold" style="float: left;">Old Email:</p>
          <p style="float: left; margin-left: 10px"><?php echo ($account['email']); ?></p>
        </dl>

        <dl>
          <dt>New Email</dt>
          <dd><input type="text" name="email" placeholder="new email" /><br /></dd>
        </dl>

        <dl>
          <dt>New Password</dt>
          <dd><input type="password" name="password" placeholder="new password" /></dd>
        </dl>

        <dl>
          <dt>Confirm Password</dt>
          <dd><input type="password" name="confirm_password" placeholder="confirm password" /></dd>
        </dl>
        <!-- <p>
                Passwords should be at least 12 characters and include at least one uppercase letter, lowercase letter, number, and symbol.
              </p> -->
        <br />

        <div id="operations">
          <input type="submit" value="Edit User Account" />
        </div>
      </form>

    </div>

  </div>

  <?php include(SHARED_PATH . '/footer.php'); ?>