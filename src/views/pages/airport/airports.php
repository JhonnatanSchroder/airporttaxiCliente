
<body>
  <?=$render('header')?>
  <?=$render('nav-services')?>
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
              Etapa 1/5
            </h2>
            <p class="mb-5 ">
              selecione o aeroporto para a sua conexão
            </p>
          </div>
        </div>
        <div class="row">
            <?php foreach($airports->data as $airport):?>
                <div class="col-12 col-md-6 col-lg-3 mb-3">
                  <div class="card justify-content-center p-1" style="">
                    <img class="card-img-top" style="height: 80%;"
                      src="<?=$airport->image?>"
                      alt=""
                    />
                    <div class="card-body align-items-center">
                      <h5
                        class="card-title text-center mb-3 text-uppercase"
                      >
                        AEROPORTO DE <br />
                        <?=$airport->name?>
                      </h2>
                      <a
                        href="<?=$base?>/airporttaxi/<?=$airport->name?>/step2"
                        name="airpot-zurique"
                        id="aeroporto_zurique"
                        class="btn btn-outline-primary d-block"
                        >Selecionar</a
                      >
                    </div>
                  </div>
              </div>
            <?php endforeach;?>
        </div>
      </div>
    </section>
  </div>
  <?=$render('footer')?>

</body>
</html>
