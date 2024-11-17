$(document).ready(function() {
    $('.table-list-access').DataTable({
        pageLength: 25,
        responsive: true,
        dom: 'lTfgitp',
        language: {
            decimal:        "",
            emptyTable:     "Tiada data",
            info:           "Paparan _START_ sehingga _END_ daripada _TOTAL_ rekod",
            infoEmpty:      "Paparan 0 sehingga 0 daripada 0 rekod",
            infoFiltered:   "(Tapisan daripada _MAX_ jumlah rekod)",
            infoPostFix:    "",
            thousands:      ",",
            lengthMenu:     "Paparan _MENU_ rekod",
            loadingRecords: "Sedang memuatkan...",
            processing:     "Sedang diproses...",
            search:         "Carian:",
            zeroRecords:    "Tiada rekod yang dijumpai",
            paginate: {
                first:      "Pertama",
                last:       "Terakhir",
                next:       "Berikut",
                previous:   "Terdahulu"
            },
            aria: {
                sortAscending:  ": aktif untuk susunan jaluran menaik",
                sortDescending: ": aktif untuk susunan jaluran menurun"
            }
        }
    });
    
    $('.chosen-role').chosen({
        width: "100%"
    });
    
    $('[data-toggle="tooltip"]').tooltip();
});

$(document).on('click','.access-edit',function() {
    $('#modal-edit-access').modal('show');
    $('#form-edit-access')[0].reset();
});