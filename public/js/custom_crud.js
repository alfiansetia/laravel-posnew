$(function () {
    if ($('#table').length > 0) {
        $('#table').DataTable({
            "responsive": true,
        });
    }

    if ($('.select2').length > 0) {
        $('.select2').select2({
            theme: 'bootstrap4'
        })
    }

    if ($('#form').length > 0) {
        $('#form').validate({
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.col-sm-10').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
                $(element).addClass('is-valid');
            }, submitHandler: function (form) {
                block()
                form.submit();
            }
        });
    }

    if ($('[data-mask]').length > 0) {
        $('[data-mask]').inputmask()
    }
});

function deleteData(action) {
    Swal.fire({
        title: 'Are you sure?',
        text: "Your data will be lost!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '<i class="fa fa-thumbs-up"></i> Yes!',
        confirmButtonAriaLabel: 'Thumbs up, Yes!',
        cancelButtonText: '<i class="fa fa-thumbs-down"></i> No',
        cancelButtonAriaLabel: 'Thumbs down',
        customClass: 'animated tada',
        showClass: {
            popup: 'animate__animated animate__tada'
        },
    }).then((result) => {
        if (result.isConfirmed) {
            $('#form_delete').attr('action', action)
            $('#form_delete').submit()
        }
    })
}