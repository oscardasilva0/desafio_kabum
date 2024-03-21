<!-- Page Wrapper -->
<div id="wrapper">

  <?php include_once __DIR__ . '/menu.php'; ?>

  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

      <!-- Begin Page Content -->
      <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <div class="card-header py-3 d-flex flex-row justify-content-between align-items-center">
              <h6 class="m-0 font-weight-bold text-primary">Lista Clientes</h6>
              <a href="/view/enderecos/inserir?cliente_id=<?php echo $cliente_id; ?>" class="btn btn-success">Inserir</a>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Endereço ID</th>
                    <th>CEP</th>
                    <th>Logradouro</th>
                    <th>Número</th>
                    <th>Complemento</th>
                    <th>Bairro</th>
                    <th>Cidade</th>
                    <th>Estado</th>
                    <th>Ação</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Endereço ID</th>
                    <th>CEP</th>
                    <th>Logradouro</th>
                    <th>Número</th>
                    <th>Complemento</th>
                    <th>Bairro</th>
                    <th>Cidade</th>
                    <th>Estado</th>
                    <th>Ação</th>
                  </tr>
                </tfoot>
                <tbody>

                  <?php
                  foreach ($enderecos as $endereco) : ?>
                    <tr>
                      <td><?php echo $endereco["endereco_id"]; ?></td>
                      <td><?php echo $endereco["cep"]; ?></td>
                      <td><?php echo $endereco["logradouro"]; ?></td>
                      <td><?php echo $endereco["numero"]; ?></td>
                      <td><?php echo $endereco["complemento"]; ?></td>
                      <td><?php echo $endereco["bairro"]; ?></td>
                      <td><?php echo $endereco["cidade"]; ?></td>
                      <td><?php echo $endereco["estado"]; ?></td>
                      <td><?php echo "
                                    <a href='/view/enderecos/editar?cliente_id={$endereco['cliente_id']}&endereco_id={$endereco['endereco_id']}' class='btn btn-primary'>Editar</a>                      
                                    <form action='/enderecos' method='post' onsubmit='return confirmarDelecao(this)' class='d-inline'>
                                      <input type='text' name='cliente_id' value='{$endereco['cliente_id']}' hidden>
                                      <input type='text' name='endereco_id' value='{$endereco['endereco_id']}' hidden>
                                      <button type='submit' name='acao' value='deletar' class='btn btn-danger ml-2'>Deletar</button>
                                    </form>";
                          echo "</tr>"; ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
      <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    <?php include_once __DIR__ . '/copyright.php'; ?>
    <!-- End of Footer -->

  </div>
  <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<script>
  function confirmarDelecao(form) {
    const enderecoID = form.querySelector('input[name="endereco_id"]').value;
    if (confirm(`Tem certeza que deseja deletar o endereço ${enderecoID}?`)) {
      form.submit();
    } else {
      return false;
    }

  }
</script>