
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
            </h2>
            <p class="mb-5 ">
              Por favor, verifique o seu pedido de limousine;
            </p>
          </div>
        </div>
        <div class="row">
        <div class="container bg-white">
            <div class="row justify-content-center">
                <div>
                    <div>
                        <h3>Endereco Inicial</h3>
                        <p class='d-inline-block'>Rua:</p>
                        <p class='d-inline-block fw-bold'><?=$order->street?></p>
                    </div>

                    <div >
                        <p class="d-inline-block">CEP / CIDADE:</p>
                        <p class="d-inline-block fw-bold"><?=$order->cep_start?> </p>
                    </div>
                    <hr>

                    <div>
                        <h3>Informacões Sobre a Viagem</h3>
                        <p class='d-inline-block'>Data de partida:</p>
                        <p class='d-inline-block fw-bold'><?=$order->date?></p>
                    </div>

                    <div >
                        <p class="d-inline-block">Passageiros:</p>
                       <p class="d-inline-block fw-bold"><?=$order->passengers?></p>
                    </div>

                    <div >
                        <div class="form-floating mb-3">
                            <textarea class="form-control" placeholder="deixe uma observacao" style="height: 100px" name='obs'><?=$order->obs?>
                        </textarea>
                            <label for="floatingTextarea2">Observacao</label>
                        </div>
                    </div>

                    <div >
                        <div class="form-floating mb-3">
                            <textarea class="form-control" placeholder="deixe uma observacao" style="height: 100px" name='how'><?=$order->how?>
                        </textarea>
                            <label for="floatingTextarea2">Como você planejou</label>
                        </div>
                    </div>
                    <hr>

                    <div >
                        <h3>Informacões de Contato</h3>
                        <p class="d-inline-block">Primeiro e último nome:</p>
                       <p class="d-inline-block fw-bold"><?=$order->name?></p>
                    </div>

                   <div >
                        <p class="d-inline-block">Email:</p>
                       <p class="d-inline-block fw-bold"><?=$order->email?></p>
                    </div>

                    <div >
                        <p class="d-inline-block">Telefone:</p>
                       <p class="d-inline-block fw-bold"><?=$order->phone?></p>
                    </div>

                    <a href='<?=$base?>/thankpage' class="btn btn-primary mb-3 px-5">
                    Continuar
                    </a>
                    <div>
                    </div>
                </div>
            </div>
        </div>
        </div>
      </div>
    </section>
  </div>
</body>
</html>

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
