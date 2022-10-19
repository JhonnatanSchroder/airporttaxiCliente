
<body>
<?=$render('header')?>
<?=$render('nav-services')?>

<body>
<div class="container">
    <section class="airports-home">
      <div class="container p-5 bg-white my-4">
        <div class="row">
          <div class="col">
            <h2 class="fs-2 text-center mb-4">TÁXI DE / PARA AEROPORTO</h1>
          </div>
        </div>
        <div class="row">
          <div class="col ">
            <h2
              class=""
            >
              Etapa 4/5
            </h2>
            <p class="mb-5 ">
              Por favor, forneca-nos seus dados de contato:
            </p>
          </div>
        </div>
        <div class="row">
        <div class="container bg-white">
            <div class="row justify-content-center">
                <div>
                    <form novalidate method="POST" action="<?=$base?>/airporttaxi/<?=$airport?>/<?=$conection?>/step4" class="p-4 needs-validation">
                        <?php if(!empty($flash)):?>
                            <div class="alert alert-danger" role="alert"><?php echo $flash;?></div>
                        <?php endif;?>
                        <div class="mb-3">
                            <input type="hidden" name="service_type" value="airportTaxi">
                            <label for="exampleInputEmail1" class="form-label"
                                >Primeiro e ultimo nome</label
                            >
                            <input
                                type="text"
                                class="form-control has-validation"
                                name="name"
                                value='<?=$user->name?>'
                                required
                            />
                            <div class="invalid-feedback">
                                Esse campo é obrigatório
                            </div>
                        </div>
                        <label for="exampleInputPassword1" class="form-label"
                            >Email</label>
                        <div class="mb-3">
                            <input
                                type="text"
                                class="form-control"
                                name='email'
                                value='<?=$user->email?>'
                                required
                            />
                            <div class="invalid-feedback">Esse campo é obrigatório</div>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Telefone</label>
                            <input type="number" id='telefone' class="form-control" name='telefone' required>
                            <div class="invalid-feedback">Esse campo é obrigatório</div>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Rua</label>
                            <input type="text" id='rua' class="form-control" name='street'
                            required
                            >
                            <div class="invalid-feedback">Esse campo é obrigatório</div>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">CEP / CIDADE</label>
                            <input type="text" class="form-control" name='cep_end' required>
                            <div class="invalid-feedback">Esse campo é obrigatório</div>
                        </div>
                        <button type="submit" class="btn btn-primary mb-3 px-5">
                        Enviar
                        </button>
                        <div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
      </div>
    </section>
  </div>
  <?=$render('footer')?>
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
