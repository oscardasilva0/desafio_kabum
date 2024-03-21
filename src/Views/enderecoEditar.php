<!-- Page Wrapper -->
<div id="wrapper">

  <?php include_once __DIR__ . '/menu.php'; ?>


  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

      <!-- Begin Page Content -->
      <div class="container-fluid">

        <div class="card shadow mb-4 mt-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
          </div>
          <div class="card-body">
            <!-- <form id="clienteForm" action="/cliente" method="post" onsubmit="return validateForm()" class="needs-validation" novalidate> -->
            <form id="enderecoForm" action="/enderecos" method="post" onsubmit="return validateForm()" class="needs-validation" novalidate>
              <input type="hidden" name="cliente_id" value="<?php echo $cliente_id ?>">
              <input type="hidden" name="endereco_id" value="<?php echo $endereco_id ?>">
              <div class="form-row">
                <div class="col-md-4  col-sm-12 mb-3">
                  <label for="cep">CEP:</label>
                  <input type="text" id="cep" name="cep" class="form-control" required maxlength="10" placeholder="Digite seu CEP (somente números)" onblur="buscaCep()" value="<?php echo $endereco["cep"] ? $endereco["cep"] : null; ?>">
                  <div class="invalid-feedback">
                    CEP inválido. Digite apenas números.
                  </div>
                </div>
                <div class="col-md-6 col-sm-10 mb-3">
                  <label for="logradouro">Logradouro:</label>
                  <input type="text" id="logradouro" name="logradouro" class="form-control" required maxlength="255" placeholder="Digite o nome da rua" value="<?php echo $endereco["logradouro"] ? $endereco["logradouro"] : null; ?>">
                  <div class=" invalid-feedback">
                    Logradouro inválido. Utilize apenas letras, números e espaços (máx. 255 caracteres).
                  </div>
                </div>
                <div class="col-md-2  col-sm-2 mb-3">
                  <label for="numero">Número:</label>
                  <input type="text" id="numero" name="numero" class="form-control" required maxlength="10" placeholder="Digite o número do imóvel" value="<?php echo $endereco["numero"] ? $endereco["numero"] : null; ?>">
                  <div class=" invalid-feedback">
                    Número inválido. Utilize apenas números (máx. 10 caracteres).
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6  col-sm-4 mb-3">
                  <label for="complemento">Complemento:</label>
                  <input type="text" id="complemento" name="complemento" class="form-control" maxlength="255" placeholder="Digite o complemento (opcional)" value="<?php echo $endereco["complemento"] ? $endereco["complemento"] : null; ?>">
                </div>
                <div class=" col-md-6 col-sm-8 mb-3">
                  <label for="bairro">Bairro:</label>
                  <input type="text" id="bairro" name="bairro" class="form-control" required maxlength="100" placeholder="Digite o nome do bairro" value="<?php echo $endereco["bairro"] ? $endereco["bairro"] : null; ?>">
                  <div class=" invalid-feedback">
                    Bairro inválido. Utilize apenas letras e espaços (máx. 100 caracteres).
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-4  col-sm-8 mb-3">
                  <label for="cidade">Cidade:</label>
                  <input type="text" id="cidade" name="cidade" class="form-control" required maxlength="100" placeholder="Digite o nome da cidade" value="<?php echo $endereco["cidade"] ? $endereco["cidade"] : null; ?>">
                  <div class=" invalid-feedback">
                    Cidade inválida. Utilize apenas letras e espaços (máx. 100 caracteres).
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 mb-3">
                  <label for="estado">Estado:</label>
                  <select id="estado" name="estado" class="form-control" required>
                    <option value="">Selecione...</option>
                    <option value="AC" <?php echo $endereco["estado"] == "AC" ? "selected" : ""; ?>>Acre</option>
                    <option value="AL" <?php echo $endereco["estado"] == "AL" ? "selected" : ""; ?>>Alagoas</option>
                    <option value="AP" <?php echo $endereco["estado"] == "AP" ? "selected" : ""; ?>>Amapá</option>
                    <option value="AM" <?php echo $endereco["estado"] == "AM" ? "selected" : ""; ?>>Amazonas</option>
                    <option value="BA" <?php echo $endereco["estado"] == "BA" ? "selected" : ""; ?>>Bahia</option>
                    <option value="CE" <?php echo $endereco["estado"] == "CE" ? "selected" : ""; ?>>Ceará</option>
                    <option value="DF" <?php echo $endereco["estado"] == "DF" ? "selected" : ""; ?>>Distrito Federal</option>
                    <option value="ES" <?php echo $endereco["estado"] == "ES" ? "selected" : ""; ?>>Espírito Santo</option>
                    <option value="GO" <?php echo $endereco["estado"] == "GO" ? "selected" : ""; ?>>Goiás</option>
                    <option value="MA" <?php echo $endereco["estado"] == "MA" ? "selected" : ""; ?>>Maranhão</option>
                    <option value="MT" <?php echo $endereco["estado"] == "MT" ? "selected" : ""; ?>>Mato Grosso</option>
                    <option value="MS" <?php echo $endereco["estado"] == "MS" ? "selected" : ""; ?>>Mato Grosso do Sul</option>
                    <option value="MG" <?php echo $endereco["estado"] == "MG" ? "selected" : ""; ?>>Minas Gerais</option>
                    <option value="PA" <?php echo $endereco["estado"] == "PA" ? "selected" : ""; ?>>Pará</option>
                    <option value="PB" <?php echo $endereco["estado"] == "PB" ? "selected" : ""; ?>>Paraíba</option>
                    <option value="PR" <?php echo $endereco["estado"] == "PR" ? "selected" : ""; ?>>Paraná</option>
                    <option value="PE" <?php echo $endereco["estado"] == "PE" ? "selected" : ""; ?>>Pernambuco</option>
                    <option value="PI" <?php echo $endereco["estado"] == "PI" ? "selected" : ""; ?>>Piauí</option>
                    <option value="RJ" <?php echo $endereco["estado"] == "RJ" ? "selected" : ""; ?>>Rio de Janeiro</option>
                    <option value="RN" <?php echo $endereco["estado"] == "RN" ? "selected" : ""; ?>>Rio Grande do Norte</option>
                    <option value="RS" <?php echo $endereco["estado"] == "RS" ? "selected" : ""; ?>>Rio Grande do Sul</option>
                    <option value="RO" <?php echo $endereco["estado"] == "RO" ? "selected" : ""; ?>>Rondônia</option>
                    <option value="RR" <?php echo $endereco["estado"] == "RR" ? "selected" : ""; ?>>Roraima</option>
                    <option value="SC" <?php echo $endereco["estado"] == "SC" ? "selected" : ""; ?>>Santa Catarina</option>
                    <option value="SP" <?php echo $endereco["estado"] == "SP" ? "selected" : ""; ?>>São Paulo</option>
                    <option value="SE" <?php echo $endereco["estado"] == "SE" ? "selected" : ""; ?>>Sergipe</option>
                    <option value="TO" <?php echo $endereco["estado"] == "TO" ? "selected" : ""; ?>>Tocantins</option>
                    <option value="EX" <?php echo $endereco["estado"] == "EX" ? "selected" : ""; ?>>Estrangeiro</option>
                  </select>
                  <div class="invalid-feedback">
                    Selecione um estado.
                  </div>
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
    // Validação do CEP
    const cep = document.getElementById('cep').value;
    if (!cep.match(/^[0-9]{5}-[0-9]{3}$/)) {
      document.getElementById('cep').classList.add('is-invalid');
      return false;
    } else {
      document.getElementById('cep').classList.remove('is-invalid');
    }

    // Validação do Logradouro
    const logradouro = document.getElementById('logradouro').value;
    if (!logradouro.match(/^[a-zA-Z0-9 .záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]+$/)) {
      document.getElementById('logradouro').classList.add('is-invalid');
      return false;
    } else {
      document.getElementById('logradouro').classList.remove('is-invalid');
    }

    // Validação do Número
    const numero = document.getElementById('numero').value;
    if (!numero.match(/^[0-9]+$/)) {
      document.getElementById('numero').classList.add('is-invalid');
      return false;
    } else {
      document.getElementById('numero').classList.remove('is-invalid');
    }

    // Validação do Bairro
    const bairro = document.getElementById('bairro').value;
    if (!bairro.match(/^[a-zA-Z .záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]+$/)) {
      document.getElementById('bairro').classList.add('is-invalid');
      return false;
    } else {
      document.getElementById('bairro').classList.remove('is-invalid');
    }

    // Validação da Cidade
    const cidade = document.getElementById('cidade').value;
    if (!cidade.match(/^[a-zA-Z záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]+$/)) {
      document.getElementById('cidade').classList.add('is-invalid');
      return false;
    } else {
      document.getElementById('cidade').classList.remove('is-invalid');
    }

    // Validação do Estado
    const estado = document.getElementById('estado').value;
    if (estado === '') {
      document.getElementById('estado').classList.add('is-invalid');
      return false;
    } else {
      document.getElementById('estado').classList.remove('is-invalid');
    }

    // Se todas as validações forem bem-sucedidas, o formulário pode ser enviado
    return true;
  }
</script>