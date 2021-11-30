<?php
defined('BASEPATH') or exit('No direct script access allowed');
// define('LINK', base_url());
// define('ASSETS', LINK . 'assets/');

// print_r($login);
?>

<?php //$this->view('templates/banner');?>

<div class="container">
    <h1 class="text-center"><?= $title ?></h1>
    <form method="post" id="register">
        <div class="form_loader">
            <img src="<?= ASSETS ?>images/batstateu-redspartan.png" alt="" width="120" height="170">
        </div>
        <div class="form-row" style="display:none;">
            <input type="hidden" name="google_id" id="google_id" value="<?php echo $google_id; ?>">
            <input type="hidden" name="google_image" id="google_image" value="<?php echo $google_image; ?>">
            <div class="col-start">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" value="<?php echo $first_name; ?>" autocomplete="false">
            </div>
            <div class="col-end">
                <label for="middle_name">Middle Name</label>
                <input type="text" name="middle_name" id="middle_name" value="" autocomplete="false">
            </div>
        </div>
        <div class="form-row" style="display:none;">
            <div class="col-start">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" value="<?php echo $last_name; ?>" autocomplete="false">
            </div>
            <div class="col-end" style="display:none">
                <label for="email">Email</label>
                <div class="input-group">
                    <input type="text" name="email" id="email" value="" autocomplete="false">
                    <span class="input-group-text">@g.batstate-u.edu.ph</span>
                </div>
                <input type="hidden" name="email_hidden" id="email_hidden" value="<?php echo $email_hidden; ?>">
            </div>
        </div>
        <div class="form-row post-signup">
            <div class="col-start">
                <label for="username">SR-Code</label>
                <input type="text" name="username" id="username" value="" autocomplete="false">
            </div>
            <div class="col-end">
                <label for="department">Department</label>
                <select name="department" id="department">
                    <option value="" disabled selected></option>
                    <option value="1">College of Informatics and Computing Sciences</option>
                    <option value="2">College of Industrial Technology</option>
                    <option value="3">College of Engineering Architecture and Fine Arts</option>
                </select>
            </div>
        </div>
            <div class="form-row post-signup">
            <div class="col-end">
                <label for="program">Program</label>
                <select name="program" id="program">
                    <option value="" disabled selected></option>
                    <option value="1">Bachelor of Science in Computer Science</option>
                    <option value="2">Bachelor of Science in Information Technology</option>
                    <option value="3">Bachelor of Industrial Technology - Automotive Technology</option>
                    <option value="4">Bachelor of Industrial Technology - Computer Technology</option>
                    <option value="5">Bachelor of Industrial Technology - Civil Technology</option>
                    <option value="6">Bachelor of Industrial Technology - Drafting Technology</option>
                    <option value="7">Bachelor of Industrial Technology - Electrical Technology</option>
                    <option value="8">Bachelor of Industrial Technology - Electronics Technology</option>
                    <option value="9">Bachelor of Industrial Technology - Food Technology</option>
                    <option value="10">Bachelor of Industrial Technology - Instrumentation and Control Technology</option>
                    <option value="11">Bachelor of Industrial Technology - Mechanical Technology</option>
                    <option value="12">Bachelor of Industrial Technology - Mechatronics Technology</option>
                    <option value="13">Bachelor of Industrial Technology - Welding and Fabrication Technology</option>
                    <option value="14">Bachelor of Science in Chemical Engineering</option>
                    <option value="15">Bachelor of Science in Civil Engineering</option>
                    <option value="16">Bachelor of Science in Computer Engineering</option>
                    <option value="17">Bachelor of Science in Electrical Engineering</option>
                    <option value="18">Bachelor of Science in Electronics Engineering</option>
                    <option value="19">Bachelor of Science in Food Engineering</option>
                    <option value="20">Bachelor of Science in Industrial Engineering</option>
                    <option value="21">Bachelor of Science in Instrumentation and Control Engineering</option>
                    <option value="22">Bachelor of Science in Mechanical Engineering</option>
                    <option value="23">Bachelor of Science in Mechatronics Engineering</option>
                    <option value="24">Bachelor of Science in Petroleum Engineering</option>
                    <option value="25">Bachelor of Science in Sanitary Engineering</option>
                    <option value="26">Bachelor of Science in Automotive Engineering</option>
                    <option value="27">Bachelor of Science in Aerospace Engineering</option>
                    <option value="28">Bachelor of Science in Transportation Engineering</option>
                    <option value="29">Bachelor of Science in Biomedical Engineering</option>
                    <option value="30">Bachelor of Science in Geodetic Engineering</option>
                    <option value="31">Bachelor of Science in Geological Engineering</option>
                    <option value="32">Bachelor of Science in Ceramics Engineering</option>
                    <option value="34">Bachelor of Science in Metallurgical Engineering</option>
                    <option value="35">Bachelor of Science in Naval Architecture and Marine Engineering</option>
                    <option value="36">Bachelor of Science in Architecture</option>
                    <option value="37">Bachelor of Science in Interior Design</option>
                    <option value="38">Bachelor of Fine Arts and Design major in Visual Communication</option>
                </select>
            </div>
        </div>
        <div class="text-center">
        <div class="text-center" style="margin-top: 10px;"><a href="<?= LINK ?>login">Login</a></div>
        <button type="submit" class="btn btn-register">Register</button>
        </div>
    </form>
</div>
<script>
    function onSignIn(googleUser) {
        var profile = googleUser.getBasicProfile();
        $('#first_name').val(profile.getGivenName());
        $('#last_name').val(profile.getFamilyName());
        $('#google_id').val(profile.getId());
        $('#google_image').val(profile.getImageUrl());
        $('#email_hidden').val(profile.getEmail());

        $('.post-signup').css('display','');
        $('.g-signin2').hide();
        $('.btn-register').show();

        var auth2 = gapi.auth2.getAuthInstance();
            auth2.signOut().then(function () {
            console.log('User signed out.');
        });
    }
</script>

<script>
    var params_register = <?= json_encode(department()) ?>;
</script>