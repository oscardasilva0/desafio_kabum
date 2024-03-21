<div class="container">
  <!-- Outer Row -->
  <div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row">
            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
            <div class="col-lg-6">
              <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Fazer login</h1>
                </div>
                <form action="/auth/login" method="POST" class="user">
                  <div class="form-group">
                    <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." required>
                  </div>
                  <div class="form-group">
                    <input type="password" name="senha" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" required>
                  </div>
                  <div class="form-group">
                    <?php
                    // Exibe as mensagens de erro, se houver
                    if (!empty($erros)) {
                      echo "<ul class='erros'>";
                      echo "<li>$erros</li>";
                      echo "</ul>";
                    }
                    ?>
                  </div>
                  <button type="submit" class="btn btn-primary btn-user btn-block">
                    Login
                  </button>
                  <hr>
                </form>
                <!-- <hr>
              <div class="text-center">
                <a class="small" href="forgot-password.html">Forgot Password?</a>
              </div>
              <div class="text-center">
                <a class="small" href="register.html">Create an Account!</a>
              </div> -->
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>
</div>