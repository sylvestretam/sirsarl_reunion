<?php require('template/import/head.php'); ?>

<body class="hold-transition sidebar-mini">

<div class="wrapper">

  <?php require('template/import/navbar.php'); ?>
  <?php require('template/import/aside.php'); ?>

  <div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">IMMOBILISATION</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">immobilisation</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    
    <div class="content">

      <div class="container-fluid">
        
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-circle"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Immobilisation</span>
                <span class="info-box-number">
                  <?= (empty($Selectimmobilisation->designation))? "" : $Selectimmobilisation->designation ?>
                </span>
              </div>
            </div>
          </div>
          
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-circle"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Acquisition</span>
                <span class="info-box-number"> <?= $totalAcquis ?> </span>
              </div>
            </div>
          </div>

          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-circle"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Ammortissements</span>
                <span class="info-box-number"> <?= $totalAmmort ?> </span>
              </div>
            </div>
          </div>
          
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-circle"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Valeur Net Comptable</span>
                <span class="info-box-number"><?= $totalVNC ?> </span>
              </div>
            </div>
          </div>
          
        </div>
        
      </div>

      <div class="container-fluid list_exercice">

        <div class="row">

          <div class="card col-12">

            <div class="card-header">

              <form action="./?action=immobilisation" method="post">
                <div class="row">
                    <div class="form-group col-12">
                      <span> IMMOBILISATION : </span>
                    </div>
                    <div class="form-group col-4">

                      <select class="form-control" name="immobilisation">
                        <option selected disabled> Choisissez Une Immobilisation </option>
                        <?php
                          foreach ($immobilisations as $immobilisation) {
                        ?>

                        <option value='<?= $immobilisation->code ?>'> <?= $immobilisation->designation ?> </option>

                        <?php
                          }
                        ?>

                      </select>
                      
                    </div>
                    <div class="col-8">
                      <button type="submit" class="btn btn-dark font-weight-bold"> <i class="fas fa-search"></i> </button>
                    </div>
                </div>
              </form>

            </div>

            <div class="card-body">

              <table class="table table-bordered tableordered table-stripper">

                <thead>
                    <tr class="fts text-center">
                        <th rowspan="2"> Exercice </th>
                        <th colspan="5"> Immobilisation </th>
                        <th colspan="3"> Ammortissement </th>
                        <th rowspan="2"> ... </th>
                    </tr>
                    <tr class="fts">
                        <th> Designation </th>
                        <th> A nouveau </th>
                        <th> Entrée </th>
                        <th> Sortie </th>
                        <th> Total </th>
                        <th> A Nouveau </th>
                        <th> Dotation </th>
                        <th> Total </th>
                    </tr>
                </thead>

                <tbody class='fts'>
                  <?php
                    foreach ($exercices as $exercice) {
                      $ammort = $Selectimmobilisation->getAmmortissement($exercice->exercice_id);
                      $immo_exercice = $Selectimmobilisation->getImmo_Exercice($exercice->exercice_id);
                  ?>

                    <tr class="fts">
                        <td class="text-center"> <?= $exercice->exercice_id ?> </td>
                        <td> <?= $Selectimmobilisation->designation ?> </td>
                        <td> <?= $immo_exercice->a_nouveau ?> </td>
                        <td> <?= $immo_exercice->entree ?> </td>
                        <td> <?= $immo_exercice->sortie ?> </td>
                        <td> <?= $immo_exercice->a_nouveau + $immo_exercice->entree + $immo_exercice->sortie ?> </td>
                        <td> <?= $ammort->a_nouveau ?> </td>
                        <td> <?= $ammort->dotation ?> </td>
                        <td> <?= $ammort->a_nouveau + $ammort->dotation ?> </td>
                        <td> 
                          <button type="submit" class="btn btn-dark font-weight-bold" onclick="showExercice('<?= $Selectimmobilisation->code ?>','<?= $exercice->exercice_id ?>')"> <i class="fas fa-search"></i> </button>
                        </td>
                    </tr>

                  <?php
                    }
                  ?>
                </tbody>

              </table>

            </div>
            
          </div>

        </div>

      </div>

      <div class="container mod_exercice invisible">

        <div class="row">

          <div class="card col-12">

            <div class="card-header">

              <button type="button" class="btn btn-dark btn-sm font-weight-bold" onclick="back('.mod_exercice','.list_exercice')"> <i class="fas fa-arrow-left"></i> RETOUR </button>

            </div>

            <div class="card-body">

              <form action="./?action=immobilisation&subaction=update" method="post">
                <div class="card">
                
                    <div class="card-body">

                      <div class="row">

                        <div class="form-group col-6">
                            <label for=""> Exercice </label>
                            <input type="hidden" class="form-control exercice" name="exercice" value="">
                            <input type="text" class="form-control exercice" value="" disabled>
                        </div>

                        <div class="form-group col-6">
                            <label for=""> Immobilisation </label>
                            <input type="hidden" class="form-control immobilisation" name="immobilisation" value="">
                            <input type="text" class="form-control immobilisation" value="" disabled>
                        </div>

                      </div>

                      <div class="row border my-3">

                        <div class="col-12 p-4 text-center">
                            <span class="display-4 font-weight-bold"> IMMOBILISATION </span>
                        </div>

                        <div class="form-group col-4">
                            <label for=""> A Nouveau </label>
                            <input type="number" class="form-control a_nouveau" name="a_nouveau">
                        </div>

                        <div class="form-group col-4">
                            <label for=""> Entrée </label>
                            <input type="number" class="form-control entree" name="entree">
                        </div>

                        <div class="form-group col-4">
                            <label for=""> Sortie </label>
                            <input type="number" class="form-control sortie" name="sortie">
                        </div>

                      </div>

                      <div class="row border">

                        <div class="col-12 text-center p-4">
                            <span class="display-4 font-weight-bold"> AMMORTISSEMENT </span>
                        </div>

                        <div class="form-group col-6">
                            <label for=""> A Nouveau </label>
                            <input type="number" class="form-control ammort_a_anouveau" name="ammort_a_anouveau">
                        </div>

                        <div class="form-group col-6">
                            <label for=""> Dotation </label>
                            <input type="number" class="form-control dotation" name="dotation">
                        </div>

                      </div>

                    </div>

                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-md btn-dark font-weight-bold"> <i class="fas fa-save"></i> ENREGISTRER </button>
                    </div>
                </div>
              </form>
              
            </div>
            
          </div>

        </div>

      </div>

    </div>

  </div>


  <footer class="main-footer">
    <div class="float-right d-none d-sm-inline">
      SIRSARL ERP
    </div>

    <strong>Copyright &copy; <?=date("Y")?> <a href="#">TAM sylvestre</a>.</strong> All rights reserved.
  </footer>

</div>

<script>
  const ammortissements = <?= json_encode($ammortissements) ?>;
  const immobilisations_exercices = <?= json_encode($immobilisations_exercices) ?>;
</script>
<?php require('template/import/foot.php'); ?>

</body>
</html>
