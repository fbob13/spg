<script>
    $(document).ready(function() {

        $('#btn-batal').on('click', function(e) {
            e.preventDefault();
            $('#modal-konfirmasi').modal('hide')
        })

        $('#btn-yes').on('click', function(e) {
            e.preventDefault();

            $('#form-pass').submit();
        })

    });
</script>