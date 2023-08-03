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