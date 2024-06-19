@extends('layout.frontend')

@section('content')
asdasdasd
@endsection

@section('javascript')
<script>
    function getEditForm(id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('product.getEditForm') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': id
                },
                success: function(data) {
                    $('#modalContent').html(data.msg)
                }
            });
        }

        function deleteDataRemoveTR(product_id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('product.deleteData') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': product_id
                },
                success: function(data) {
                    if (data.status == "oke") {
                        $('#tr_' + product_id).remove();
                    }
                }
            });
        }
</script>
