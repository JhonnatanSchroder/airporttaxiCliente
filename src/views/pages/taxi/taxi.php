
<body>
  <?=$render('header')?>
  <?=$render('nav-services')?>
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
              Etapa 1/6
            </h2>
            <p class="mb-5 ">
              escolha o tipo de conexão que você precisa
            </p>
          </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4 mb-3">
                <div class="card shadow justify-content-center p-1" style="">
                  <div class="card-body align-items-center">
                    <div class="card-img-top text-center">

                      <i class="fa-solid fa-arrow-right text-primary icone"></i>
                      </div>
                    <h5
                      class="card-title text-center mb-3 text-uppercase"
                    >
                    PARA UM DESTINO <br />
                      
                    </h2>
                    <a
                      href="<?=$base?>/taxi/toDestiny/step2"
                      name="airpot-zurique"
                      id="aeroporto_zurique"
                      class="btn btn-outline-primary d-block"
                      >Selecionar</a
                    >
                  </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-3">
                <div class="card shadow justify-content-center p-1" style="">
                  <div class="card-body align-items-center">
                    <div class="card-img-top text-center">

                      <i class="fa-solid fa-arrow-right text-primary icone"></i>
                      </div>
                    <h5
                      class="card-title text-center mb-3 text-uppercase"
                    >
                      DE E PARA UM DESTINO<br />
                      
                    </h2>
                    <a
                      href="<?=$base?>/taxi/fromToDestiny/step2"
                      name="airpot-zurique"
                      id="aeroporto_zurique"
                      class="btn btn-outline-primary d-block"
                      >Selecionar</a
                    >
                  </div>
                </div>
            </div>
        </div>
      </div>
    </section>
  </div>
  <?=$render('footer')?>

</body>
</html>
