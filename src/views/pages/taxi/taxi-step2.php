
<body>
<?=$render('header')?>
<?=$render('nav-services')?>

<body>
<div class="container">
    <section class="airports-home">
      <div class="container p-5 bg-white my-4">
        <div class="row">
          <div class="col">
            <h2 class="fs-2 text-center mb-4">PEDIDO DE TÁXI</h1>
          </div>
        </div>
        <div class="row">
          <div class="col ">
            <h2
              class=""
            >
              Etapa 2/6
            </h2>
            <p class="mb-4">
              Onde podemos busca-lo?
            </p>
          </div>
        </div>
        <div class="row">
        <div class="container bg-white">
            <div class="row ">
                <div class='col-lg-5'>
                    <form novalidate method="POST" action="<?=$base?>/taxi/<?=$conection?>/step2Action" class="p-4 needs-validation">
                        <?php if(!empty($flash)):?>
                            <div class="alert alert-danger" role="alert"><?php echo $flash;?></div>
                        <?php endif;?>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"
                                >Rua</label
                            >
                            <input
                                type="text"
                                class="form-control has-validation"
                                name="street_start"
                                required
                            />
                            <div class="invalid-feedback">
                                Esse campo é obrigatório
                            </div>
                        </div>
                        <label for="exampleInputPassword1" class="form-label"
                            >CEP / CIDADE </label>
                        <div class="input-group mb-3">
                            
                            <input
                                type="text"
                                class="form-control"
                                name='cep_start'
                                id="partida-airport-date"
                                required
                            />
                            <span class="input-group-text">&</span>
                            <input type="text" class="form-control"
                            name='city_start' 
                            required>
                            <div class="invalid-feedback">Esse campo é obrigatório</div>
                        </div>

                        <button type="submit" class="btn btn-primary mb-3 px-5">
                        Continuar
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
