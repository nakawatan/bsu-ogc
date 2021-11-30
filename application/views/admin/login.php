
  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center mt-5 pt-5">

      <div class="col-xl-5 col-lg-5 col-md-5">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h1 text-gray-900 mb-4">Administrator</h1>
                  </div>
                  <form id="adminLogin" class="user" action="<?= LINK ?>admin/login" method="post">
                    <div class="form-group">
                      <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                      <input type="text" name="admin_user" class="form-control form-control-user" placeholder="Username">
                    </div>
                    <div class="form-group">
                      <input type="password" name="admin_pass" class="form-control form-control-user" placeholder="Password">
                    </div>
                    <div class="form-group show-message text-center"><?php if( form_error('admin_user') || form_error('admin_pass') || $error ) : ?><span class="text-danger"><small><i>Login Credentials is Incorrect.</i></small></span><?php endif; ?></div>
                    <input type="submit" class="btn btn-primary btn-user btn-block" value="Login">
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>