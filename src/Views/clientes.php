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
        <div class="card shadow mb-4 mt-4">
          <div class="card-header py-3">
            <div class="card-header py-3 d-flex flex-row justify-content-between align-items-center">
              <h6 class="m-0 font-weight-bold text-primary">Lista Clientes</h6>
              <a href="/view/clientes/inserir" class="btn btn-success">Inserir</a>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Data de Nascimento</th>
                    <th>CPF</th>
                    <th>rg</th>
                    <th>Telefone</th>
                    <th>Ação</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Data de Nascimento</th>
                    <th>CPF</th>
                    <th>rg</th>
                    <th>Telefone</th>
                    <th>Ação</th>
                  </tr>
                </tfoot>
                <tbody>

                  <?php
                  foreach ($clientes as $cliente) {

                    $data = new DateTime($cliente['data_nascimento']);

                    $data_nascimento = $data->format("d/m/Y");


                    echo "<tr>";
                    echo "<td>{$cliente['cliente_id']}</td>";
                    echo "<td>{$cliente['nome']}</td>";
                    echo "<td >{$data_nascimento}</td>";
                    echo "<td class='cpf'>{$cliente['cpf']}</td>";
                    echo "<td>{$cliente['rg']}</td>";
                    echo "<td class='phone_with_ddd'>{$cliente['telefone']}</td>";
                    echo "
                    <td>
                      <a href='/view/clientes/editar?cliente_id={$cliente['cliente_id']}' class='btn btn-primary'>Editar</a>                      
                      <form action='/cliente' method='post' onsubmit='return confirmarDelecao(this)' class='d-inline'>
                        <input type='text' name='cliente_id' value='{$cliente['cliente_id']}' hidden>
                        <button type='submit' name='acao' value='deletar' class='btn btn-danger ml-2'>Deletar</button>
                      </form>
                      <a href='/view/enderecos?cliente_id={$cliente['cliente_id']}' class='btn btn-info ml-2'>Lista endereços</a>
                    </td>";
                    echo "</tr>";
                  }
                  ?>
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
    const clienteId = form.querySelector('input[name="cliente_id"]').value;
    if (confirm(`Tem certeza que deseja deletar o cliente ${clienteId}?`)) {
      form.submit();
    } else {
      return false;
    }

  }
</script>