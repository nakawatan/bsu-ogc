<?php
defined('BASEPATH') or exit('No direct script access allowed');
// define('LINK', base_url());
// define('ASSETS', LINK . 'assets/');

// print_r($login);
?>

<?php $this->view('templates/banner'); ?>

<form method="post" id="login">
    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
    <h2 class="text-center">Please Login</h2>
    <div class="form-group no-flex">
        <label for="user">Username</label>
        <input type="text" name="user" id="user" value="<?= set_value('user') ?>" autocomplete="off">
    </div>
    <div class="form-group no-flex">
        <label for="pass">Password</label>
        <input type="password" name="pass" id="pass" value="<?= set_value('pass') ?>">
        <span class="txt-helper">*Password is case sensitive</span>
    </div>
    <?php //echo form_error('fname', '<div class="red">', '</div>'); ?>
    <?php if( form_error('user') || form_error('pass') || $error ) : ?>
    <p class="error-box text-center txt-red">Login Credentials is Incorrect.</p>
    <?php endif; ?>
    <div><a href="#">Forgot Password?</a></div>
    <div style="margin-top: 10px;"><a href="<?= LINK ?>register">Register Now</a></div>
    <div class="text-center"><button type="submit" class="btn btn-login">Login</button></div>
</form>