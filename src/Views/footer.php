<!-- Bootstrap core JavaScript-->
<script src="/public/vendor/jquery/jquery.min.js"></script>
<script src="/public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="/public/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="/public/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="/public/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="/public/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="/public/js/demo/datatables-demo.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $(document).ready(function() {
    $('.date').mask('00/00/0000', {
      reverse: true
    });

    $("#data_nascimento1, #data_nascimento2").mask("00/00/0000")
    $('.cep').mask('00000-000');
    $('.phone_with_ddd').mask('(00) 0000-0000');
    $('.cpf').mask('000.000.000-00', {
      reverse: true
    });
    $('.clear-if-not-match').mask("00/00/0000", {
      clearIfNotMatch: true
    });
    $('.placeholder').mask("00/00/0000", {
      placeholder: "__/__/____"
    });
    $('.fallback').mask("00r00r0000", {
      translation: {
        'r': {
          pattern: /[\/]/,
          fallback: '/'
        },
        placeholder: "__/__/____"
      }
    });
    $('.selectonfocus').mask("00/00/0000", {
      selectOnFocus: true
    });
  });
</script>

</body>

</html>