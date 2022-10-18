
<body>
<?=$render('header')?>
<?=$render('nav-services')?>

<body>
<div class="container">
    <section class="airports-home">
      <div class="container p-5 bg-white my-4">
        <div class="row">
          <div class="col">
            <h2 class="fs-2 text-center mb-4">MICROÔNIBUS / ÔNIBUS</h1>
          </div>
        </div>
        <div class="row">
          <div class="col ">
            <h2
              class=""
            >
              Etapa 1/5
            </h2>
            <p class="mb-5 ">
              Informe-nos a sua hora de inicio e ponto de partida
            </p>
          </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-11 col-md-10">
                <p class="mb-5 is-size-5-desktop is-size-5-tablet">A nossa frota de
                veículos não se limita apenas aos veículos Opel Zafira
                <br />
                <br />
                Também temos minivans de 9 lugares Renault Trafic (8 passageiros mais
                motorista) por conta própria. Estas minivans têm um grande espaço de
                armazenamento de bagagem.
                <br />
                <br />
                Dispomos também de um midibus de 25 lugares, ideal para grupos de
                média dimensão para transfers para o aeroporto, ou outras ocasiões
                como viagens ao Europa Park, Conny-Land, etc.
                <br />
                <br />
                Graças a várias cooperações com outras empresas de transporte, também
                podemos providenciar ônibus maiores. Estes, então, variam de 36
                lugares a 50 lugares a ônibus de dois andares (até 82 pessoas).
                <br />
                <br />
                RESERVAS E OFERTAS: Entre em contato conosco via e-mail ou telefone.
                Nós nos esforçamos para enviar uma oferta o mais rápido possível.
                Muito importante para nós sabermos: Número de pessoas ou tamanho de
                veículo desejado Rota e tempo
                </p>
                <br />
            </div>
        </div>
        <div class="row">
        <div class="container bg-white">
            <div class="row justify-content-center">
                <div>
                    <form novalidate method="POST" action="<?=$base?>/bus" class="p-4 needs-validation">
                        <?php if(!empty($flash)):?>
                            <div class="alert alert-danger" role="alert"><?php echo $flash;?></div>
                        <?php endif;?>
                        <label for="exampleInputPassword1" class="form-label"
                            >Data de inicio </label>
                        <div class="input-group mb-3">
                            <input
                                type="text"
                                class="form-control"
                                name='date_start'
                                id="partida-airport-date"
                                placeholder="yyyy/mm/dd"
                                required
                            />
                            <span class="input-group-text">-</span>
                            <input type="text" class="form-control"
                            name='time_start' id='partida-airport-time'
                            placeholder="00:00"
                            required>
                            <div class="invalid-feedback">Esse campo é obrigatório</div>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Rua</label>
                            <input type="text" id='Rua' class="form-control" name='street' required>
                            <div class="invalid-feedback">Esse campo é obrigatório</div>
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"
                                >CEP / CIDADE</label
                            >
                            <input
                                type="text"
                                class="form-control has-validation"
                                name="cep_start"
                                required
                            />
                            <div class="invalid-feedback">
                                Esse campo é obrigatório
                            </div>
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
<script src="https://unpkg.com/imask"></script>
    <script>
        var mascara = {
            mask: '00'
        }
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
