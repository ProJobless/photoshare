<?= validation_errors(); ?>
<? if (isset($invalid_user_error)) echo $invalid_user_error; ?>

<p><a href="<?= site_url('member/logout') ?>">Logout</a></p>

<!-- BEGIN LOGIN FORM -->
<?= form_open('welcome/login') ?>
<fieldset>
<h3>Login</h3>
<p>
<label for="username">Username</label>
<input type="text" id="log-username" name="log_username" value="<?= set_value('log_username') ?>" />
</p>

<p>
<label for="password">Password</label>
<input type="password" id="log-password" name="log_password" value="<?= set_value('log_password') ?>" />
</p>

<p><input type="submit" value="Login" /></p>
</fieldset>

</form>
<!-- END LOGIN FORM -->

<!-- BEGIN REGISTRATION FORM -->
<?= form_open('welcome/register') ?>
<fieldset>
<h3>Register</h3>

<p>
<label for="first-name">First name</label>
<input type="text" id="first-name" name="first_name" value="<?= set_value('first_name') ?>" />
</p>
<p>
<label for="last-name">Last name</label>
<input type="text" id="last-name" name="last_name" value="<?= set_value('last_name') ?>" />
</p>

<p>
<label for="email">Email</label>
<input type="text" id="email" name="email" value="<?= set_value('email') ?>" />
</p>

<p>
<label for="username">Username</label>
<input type="text" id="reg-username" name="reg_username" value="<?= set_value('reg_username') ?>" />
</p>

<p>
<label for="password">Password</label>
<input type="password" id="reg-password" name="reg_password" value="<?= set_value('reg_password') ?>" />
</p>


<p><input type="submit" value="Register" /></p>
</fieldset>

</form>
<!-- END REGISTRATION FORM -->

