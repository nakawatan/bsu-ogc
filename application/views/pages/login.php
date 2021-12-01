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
    <input type="hidden" name="google_id" id="google_id"/>
    <input type="hidden" name="first_name" id="first_name"/>
    <input type="hidden" name="last_name" id="last_name"/>
    <input type="hidden" name="google_image" id="google_image"/>
    <input type="hidden" name="email_hidden" id="email_hidden"/>
    <div class="admin-login-form" style="display:none;">
    <div class="form-group no-flex">
        <label for="user">Username</label>
        <input type="text" name="user" id="user" value="<?= set_value('user') ?>" autocomplete="off">
    </div>
    <div class="form-group no-flex">
        <label for="pass">Password</label>
        <input type="password" name="pass" id="pass" value="<?= set_value('pass') ?>">
        <span class="txt-helper">*Password is case sensitive</span>
    </div>
    </div>
    <?php //echo form_error('fname', '<div class="red">', '</div>'); ?>
    <?php if( form_error('user') || form_error('pass') || $error ) : ?>
    <p class="error-box text-center txt-red">Login Credentials is Incorrect.</p>
    <?php endif; ?>
    <!-- <div><a href="#">Forgot Password?</a></div> -->
    <div class="text-center"><div type="submit" class="g-signin2" data-longtitle="true" data-onsuccess="onSignIn" style="display:inline-block"></div></div>
    <div class="text-center"><button type="submit" class="btn btn-login" style="display:none;">Login</button></div>
    <div class="text-center"><button type="button" class="btn btn-admin">Admin</button></div>
    
    <!-- <div class="text-center" style="margin-top: 10px;"><a href="<?= LINK ?>register">Register Now</a></div> -->
</form>

<script>
    function onSignIn(googleUser) {
        var profile = googleUser.getBasicProfile();
        $('#first_name').val(profile.getGivenName());
        $('#last_name').val(profile.getFamilyName());
        $('#google_image').val(profile.getImageUrl());
        $('#email_hidden').val(profile.getEmail());
        $('#google_id').val(profile.getId());
        var auth2 = gapi.auth2.getAuthInstance();
            auth2.signOut().then(function () {
            console.log('User signed out.');
        });
        $('#login').submit();
    }
    
</script>