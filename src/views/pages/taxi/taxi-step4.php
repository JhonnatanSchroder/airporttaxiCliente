
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
              Etapa 4/6
            </h2>
            <p class="mb-4">
              Quando você precisa da viagem?
            </p>
          </div>
        </div>
        <div class="row">
        <div class="container bg-white">
            <div class="row">
                <div class='col-lg-5'>
                    <form novalidate method="POST" action="<?=$base?>/taxi/<?=$conection?>/step4" class="p-4 needs-validation">
                        <?php if(!empty($flash)):?>
                            <div class="alert alert-danger" role="alert"><?php echo $flash;?></div>
                        <?php endif;?>
                        <label for="exampleInputPassword1" class="form-label"
                            >Data de partida </label>
                        <div class="input-group mb-3">
                            
                            <input
                                type="date"
                                class="form-control"
                                name='date_start'
                                id="partida-airport-date"
                                required
                            />
                            <span class="input-group-text">-</span>
                            <input type="time" class="form-control"
                            name='time_start' id='partida-airport-time'
                            placeholder="00:00"
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
<script src="https://unpkg.com/imask"></script>
    <script>

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
