
<body>
<?=$render('header')?>
<?=$render('nav-services')?>

<body>
<div class="container">
    <section class="airports-home">
      <div class="container p-5 bg-white my-4">
        <div class="row">
          <div class="col">
            <h2 class="fs-2 text-center mb-4">SERVICO DE LIMOUSINE</h1>
          </div>
        </div>
        <div class="row">
          <div class="col ">
            <h2
              class=""
            >
              Etapa 2/5
            </h2>
            <p class="mb-5 ">
              Nos informe sobre os passageiros
            </p>
          </div>
        </div>
        <div class="row">
        <div class="container bg-white">
            <div class="row justify-content-center">
                <div>
                    <form novalidate method="POST" action="<?=$base?>/limousine/step2" class="p-4 needs-validation">
                        <?php if(!empty($flash)):?>
                            <div class="alert alert-danger" role="alert"><?php echo $flash;?></div>
                        <?php endif;?>

                        <div class="mb-3">
                            <label for="" class="form-label">Passageiros</label>
                            <input type="text" id='passageiros' class="form-control" name='passengers' required>
                            <div class="invalid-feedback">Esse campo é obrigatório</div>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Cadeiras de Crianca</label>
                            <input type="text" id='criancas' class="form-control" name='kids_seats'
                            >
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Assento Elevátorio</label>
                            <input type="text" id='assento' class="form-control" name='booster_seats' >
                        </div>

                        <div class="mb-3">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="deixe uma observacao" style="height: 100px" name='obs'></textarea>
                                <label for="floatingTextarea2">Observacao</label>
                            </div>
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
    
</body>
</html>

<script src="https://unpkg.com/imask"></script>
    <script>
        var mascara = {
            mask: '00'
        }
      IMask(document.getElementById('passageiros'), mascara)
      IMask(document.getElementById('criancas'),mascara)
      IMask(document.getElementById('assento'),mascara)
      IMask(document.getElementById('partida-airport-date'),
      {
        mask: '0000/00/00'
      }
      )
      IMask(document.getElementById('partida-airport-time'),
      {
        mask: '00:00',
      }
      )
    </script>
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
