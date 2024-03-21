<!-- Page Wrapper -->
<div id="wrapper">



  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

      <!-- Begin Page Content -->
      <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4 mt-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
          </div>
          <div class="card-body">
            <form id="clienteForm" action="/cliente" method="post" onsubmit="return validateForm()" class="needs-validation" novalidate>
              <input type='text' name='cliente_id' name="cliente_id" value='<?php echo $cliente["cliente_id"] ? $cliente["cliente_id"] : null; ?>' hidden>
              <div class="form-row">
                <div class="col-12">
                  <label for="nome">Nome Completo:</label>
                  <input type="text" id="nome" name="nome" class="form-control" required maxlength="150" placeholder="Digite seu nome completo" value="<?php echo $cliente["nome"] ? $cliente["nome"] : null; ?>">
                  <div class="invalid-feedback">
                    Nome completo inválido. Utilize apenas letras e espaços (máx. 150 caracteres).
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label for="cpf">CPF:</label>
                  <input type="text" id="cpf" name="cpf" class="form-control cpf" required maxlength="16" placeholder="Digite seu CPF (somente números)" value="<?php echo $cliente["cpf"] ? $cliente["cpf"] : null; ?>">
                  <div class="invalid-feedback">
                    CPF inválido. Digite apenas números.
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="data_nascimento">Data de Nascimento:</label>

                  <input type="date" id="data_nascimento" name="data_nascimento" class="form-control" value="<?php echo $cliente["data_nascimento"] ? $cliente["data_nascimento"] : null; ?>" required>
                  <div class="invalid-feedback">
                    Por favor, digite sua data de nascimento.
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label for="rg">rg:</label>
                  <input type="text" id="rg" name="rg" class="form-control" maxlength="12" placeholder="Digite seu rg" value="<?php echo $cliente["rg"] ? $cliente["rg"] : null; ?>">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="telefone">Telefone:</label>
                  <input type="text" id="telefone" name="telefone" class="form-control phone_with_ddd" maxlength="20" placeholder="Digite seu telefone" value="<?php echo $cliente["telefone"] ? $cliente["telefone"] : null; ?>">
                </div>
              </div>

              <button type="submit" name='acao' value='salvar' class="btn btn-primary">Enviar</button>

            </form>
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
  function validateForm() {
    var nome = document.getElementById("nome").value;
    var cpf = document.getElementById("cpf").value;
    var data_nascimento = document.getElementById("data_nascimento").value;
    var rg = document.getElementById("rg").value;
    var telefone = document.getElementById("telefone").value;

    // Validar nome: apenas letras e tamanho máximo de 150
    var nomeRegex = /^[A-Za-zÀ-ÖØ-öø-ÿ\s]*$/;
    if (!nomeRegex.test(nome) || nome.length > 150) {
      alert("Por favor, insira um nome válido (somente letras, máximo 150 caracteres).");
      return false;
    }

    // Validar CPF: apenas números e máscara
    var cpfRegex = /^\d{3}\.\d{3}\.\d{3}-\d{2}$/;
    if (!cpfRegex.test(cpf)) {
      alert("Por favor, insira um CPF válido (somente números e máscara: XXX.XXX.XXX-XX).");
      return false;
    }

    // Validar data de nascimento: formato de data
    if (!data_nascimento) {
      alert("Por favor, insira uma data de nascimento.");
      return false;
    }

    // Validar rg: máximo de 12 caracteres
    if (rg.length > 12) {
      alert("Por favor, insira um rg válido (máximo 12 caracteres).");
      return false;
    }

    // Validar telefone: máscara
    var telefoneRegex = /^\(\d{2}\) \d{4,5}-\d{4}$/;
    if (!telefoneRegex.test(telefone)) {
      alert("Por favor, insira um telefone válido (máscara: (XX) XXXX-XXXX ou (XX) XXXXX-XXXX).");
      return false;
    }
    form.submit();
    return true; // Se tudo estiver válido, permitir o envio do formulário
  }

  function confirmarDelecao(form) {
    const clienteId = form.querySelector('input[name="cliente_id"]').value;
    if (confirm(`Tem certeza que deseja deletar o cliente ${clienteId}?`)) {
      form.submit();
    } else {
      return false;
    }

  }
</script>