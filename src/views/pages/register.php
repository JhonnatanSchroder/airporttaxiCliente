<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="<?=$base?>/assets/css/style.css" />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
      defer
    ></script>
    <title>Airporttaxi.ch</title>
  </head>
  <body>
    <?=$render('login-header')?>
    <section class="section mt-5 p-">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <form method='POST' action='<?=$base?>/register' novalidate class="shadow p-4 needs-validation">
              <?php if(!empty($flash)):?>
                <div class="alert alert-danger">
                  <?=$flash?>
                </div>
              <?php endif;?>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label"
                  >Digite seu nome completo</label
                >
                <input
                  type="text"
                  class="form-control has-validation"
                  id="exampleInputEmail1"
                  aria-describedby="emailHelp"
                  name='name'
                  required
                />
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label"
                  >Email address</label
                >
                <input
                  type="email"
                  class="form-control has-validation"
                  id="exampleInputEmail1"
                  aria-describedby="emailHelp"
                  name='email'
                  required
                />
                <div id="emailHelp" class="invalid-feedback">
                  Email invalido
                </div>
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label"
                  >Password</label
                >
                <input
                  type="password"
                  class="form-control"
                  id="exampleInputPassword1"
                  name='password'
                  required
                />
                <div class="invalid-feedback">Insira uma senha v??lida</div>
              </div>
              <div class="mb-3">
                <label for="birthdate" class="form-label">
                  Digite sua data de nascimento (yyyy/mm/dd)
                </label>
                <input
                  id="birthdate"
                  type="date"
                  class="form-control"
                  name='birthdate'
                  required
                />
                <div class="invalid-feedback">data de nascimento inv??lida</div>
              </div>
              <button type="submit" class="btn btn-primary mb-3 px-5">
                Enviar
              </button>
              <div>
                <span>J?? tem conta? <a href="<?=$base?>/login">Fa??a login
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function () {
        "use strict";

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll(".needs-validation");

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms).forEach(function (form) {
          form.addEventListener(
            "submit",
            function (event) {
              if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
              }

              form.classList.add("was-validated");
            },
            false
          );
        });
      })();
    </script>
  </body>
</html>
