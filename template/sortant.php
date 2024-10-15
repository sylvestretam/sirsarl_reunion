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
            <h1 class="m-0">COURRIER</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">entrant</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    
    <div class="content">

      <div class="container-fluid list">

        <div class="row">

          <div class="card col-12">

            <div class="card-header">

              <div class="card-tools">
                <button type="button" class="btn btn-dark btn-block btn-flat font-weight-bold" onclick="back('.list','.add')" > <i class="fas fa-plus"></i> AJOUTER </button>
              </div>

            </div>

            <div class="card-body">

              <table class="table table-bordered tableordered table-stripper">

                <thead>
                    <tr class="fts">
                        <th> Numero </th>
                        <th> Date Emission </th>
                        <th> Objet </th>
                        <th> Reference </th>
                        <th> Numero Archivage </th>
                        <th> Mat. Emmetteur </th>
                        <th> Departement </th>
                        <th> Destinataire </th>
                        <th> Date Transmission </th>
                        <th> Transmetteur </th>
                        <th> Statut </th>
                        <th> ... </th>
                    </tr>
                </thead>

                <tbody class='fts'>
                    <?php
                      foreach ($courriers as $courrier) {
                    ?>
                        <tr>
                          <td> <?= $courrier->numero ?> </td>
                          <td> <?= $courrier->date_emmission ?> </td>
                          <td> <?= $courrier->objet ?> </td>
                          <td> <?= $courrier->reference ?> </td>
                          <td> <?= $courrier->numero_archivage ?> </td>
                          <td> <?= $courrier->emmetteur ?> </td>
                          <td> <?= $courrier->departement ?> </td>
                          <td> <?= $courrier->destinataire ?> </td>
                          <td> <?= $courrier->date_transmission ?> </td>
                          <td> <?= $courrier->transmetteur ?> </td>
                          <td> <?= $courrier->statut ?> </td>
                          <td> 
                            <button class="btn btn-flat btn-outline-dark btn-sm" onclick="showCourrier('<?= $courrier->numero ?>')"> <i class="fas fa-search"></i> </button>
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

      <div class="container add invisible">

        <div class="row">

          <div class="card col-12">

            <div class="card-header">

              <button type="button" class="btn btn-dark btn-sm btn-flat font-weight-bold" onclick="back('.add','.list')"> <i class="fas fa-arrow-left"></i> RETOUR </button>

            </div>

            <div class="card-body">

              <form action="./?action=sortant&subaction=save" method="post" enctype="multipart/form-data">
                <div class="card">
                
                    <div class="card-body">

                      <div class="row">

                        <div class="form-group col-6">
                            <label for=""> Date Emmission </label>
                            <input type="date" class="form-control"  name="date_emmission" required>
                        </div>

                        <div class="form-group col-10">
                            <label for=""> Objet/Nature </label>
                            <input type="text" class="form-control"  name="objet" required>
                        </div>

                        <div class="form-group col-6">
                            <label for=""> Reference </label>
                            <input type="text" class="form-control"  name="reference" required>
                        </div>

                        <div class="form-group col-6">
                            <label for=""> Numero Archivage </label>
                            <input type="text" class="form-control"  name="numero_archivage" required>
                        </div>

                        <div class="form-group col-6">
                            <label> Emmetteur </label>
                            <select class="form-control select2" style="width: 100%;" name="emmetteur" required>
                                <option selected="selected" disabled>Choisir Un Employee</option>
                                <?php
                                    foreach ($employees as $employee) {
                                ?>
                                    <option value="<?= $employee->matricule ?>"> <?= $employee->matricule." - ".$employee->noms." ".$employee->prenoms ?> </option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="form-group col-6">
                            <label for=""> Departement </label>
                            <input type="text" class="form-control"  name="departement" required>
                        </div>

                        <div class="form-group col-10">
                            <label for=""> Destinataire </label>
                            <input type="text" class="form-control"  name="destinataire" required>
                        </div>

                        <div class="form-group col-10">
                            <label for=""> Observation </label>
                            <input type="text" class="form-control"  name="observation" required>
                        </div>

                        <div class="form-group col-6">
                            <label> Transmetteur </label>
                            <select class="form-control select2" style="width: 100%;" name="transmetteur" required>
                                <option selected="selected" disabled>Choisir Un Employee</option>
                                <?php
                                    foreach ($employees as $employee) {
                                ?>
                                    <option value="<?= $employee->matricule ?>"> <?= $employee->matricule." - ".$employee->noms." ".$employee->prenoms ?> </option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="form-group col-4">
                            <label for=""> Date de Transmission </label>
                            <input type="date" class="form-control"  name="date_transmission" required>
                        </div>

                        <div class="form-group col-6">
                            <label for="exampleInputFile">Joindre le Fichier</label>
                            <input type="file" accept="application/pdf" class="btn btn-outline-info btn-block btn-flat" id="exampleInputFile" name="fichier" required>
                        </div>

                      </div>


                    </div>

                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-md btn-dark btn-flat font-weight-bold"> <i class="fas fa-save"></i> ENREGISTRER </button>
                    </div>
                </div>
              </form>
              
            </div>
            
          </div>

        </div>

      </div>

      <div class="container mod invisible">

        <div class="row">

          <div class="card col-12">

            <div class="card-header">

              <button type="button" class="btn btn-dark btn-sm btn-flat font-weight-bold" onclick="back('.mod','.list')"> <i class="fas fa-arrow-left"></i> RETOUR </button>

            </div>

            <div class="card-body">

              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title">Read Mail</h3>

                  <div class="card-tools">
                    <a href="#" class="btn btn-tool" title="Previous"><i class="fas fa-chevron-left"></i></a>
                    <a href="#" class="btn btn-tool" title="Next"><i class="fas fa-chevron-right"></i></a>
                  </div>
                </div>
                
                <div class="card-body p-0">
                  <div class="mailbox-read-info">
                    <h5 class="objet">Message Subject Is Placed Here</h5>
                    <h6>From: <span class="emmetteur"> support@adminlte.io </span>
                      <span class="mailbox-read-time float-right date_reception">15 Feb. 2015 11:03 PM</span></h6>
                  </div>
                  
                  <div class="mailbox-controls with-border text-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-default btn-sm" data-container="body" title="Delete">
                        <i class="far fa-trash-alt"></i>
                      </button>
                      <button type="button" class="btn btn-default btn-sm" data-container="body" title="Reply">
                        <i class="fas fa-reply"></i>
                      </button>
                      <button type="button" class="btn btn-default btn-sm" data-container="body" title="Forward">
                        <i class="fas fa-share"></i>
                      </button>
                    </div>
                    
                    <button type="button" class="btn btn-default btn-sm" title="Print">
                      <i class="fas fa-print"></i>
                    </button>
                  </div>
                  
                  <div class="mailbox-read-message">

                    <iframe src="bc.pdf" width="100%" height="1000dvh" class="fichier"> </iframe>

                  </div>
                  
                </div>
                
                <div class="card-footer">
                  <div class="float-right">
                    <button type="button" class="btn btn-default"><i class="fas fa-reply"></i> Reply</button>
                    <button type="button" class="btn btn-default"><i class="fas fa-share"></i> Forward</button>
                  </div>
                  <button type="button" class="btn btn-default"><i class="far fa-trash-alt"></i> Delete</button>
                  <button type="button" class="btn btn-default"><i class="fas fa-print"></i> Print</button>
                </div>
                
              </div>
              
            </div>
            
          </div>

        </div>

      </div>

    </div>

  </div>


  <?php require('template/import/footer.php'); ?>

</div>

<script>
  const courriers = <?= json_encode($courriers) ?>
</script>

<?php require('template/import/foot.php'); ?>

</body>
</html>
