$(document).ready(function() {
    $('.table-list-report').DataTable({
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
    
    $('.table-list-fyear').DataTable({
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
    
    $('[data-toggle="tooltip"]').tooltip();
});

$(document).on('click','.fdata-view',function() {
    $('#modal-view-fdata').modal('show');
    $('#form-view-fdata')[0].reset();
});

$(document).on('click','#close-fdata',function() {
    $('#modal-view-fdata').modal('hide');
    $('#form-view-fdata')[0].reset();
    $('#modal-view-fyear').modal('show');
});

$(document).on('click','.fyear-view',function() {
    $('#modal-view-fyear').modal('show');
    $('#form-view-fyear')[0].reset();
});

$(document).on('click','#close-fyear',function() {
    $('#modal-view-fyear').modal('hide');
    $('#form-view-fyear')[0].reset();
});