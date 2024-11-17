$(document).ready(function() {
    $('.scroll_content').slimscroll({
        height: '310px'
    });
    
    $('.slick_chart').slick({
        dots: true
    });
    
    //$('#slick-slide01').trigger('click');
    
    c3.generate({
        bindto: '#barChart',
        data:{
            columns: [
                ['Maut', 30, 90, 100, 210, 120, 50],
                ['Parah', 40, 100, 140, 220, 150, 220],
                ['Ringan', 50, 130, 170, 300, 160, 100],
                ['Rosak', 70, 150, 200, 400, 170, 150]
            ],
            colors:{
                Maut: '#000000',
                Parah: '#e42238',
                Ringan: '#1ab394',
                Rosak: '#3e80c5'
            },
            type: 'bar',
            groups: [
                ['Maut', 'Parah', 'Ringan', 'Rosak']
            ]
        }
    });
    
    c3.generate({
        bindto: '#lineChart',
        data:{
            columns: [
                ['Maut', 30, 90, 100, 210, 120, 50],
                ['Parah', 40, 100, 140, 220, 150, 220],
                ['Ringan', 50, 130, 170, 300, 160, 100],
                ['Rosak', 70, 150, 200, 400, 170, 150]
            ],
            colors:{
                Maut: '#000000',
                Parah: '#e42238',
                Ringan: '#1ab394',
                Rosak: '#3e80c5'
            },
            type: 'spline'
        }
    });
    
    c3.generate({
        bindto: '#pieChart',
        data:{
            columns: [
                ['Maut', 10],
                ['Parah', 20],
                ['Ringan', 30],
                ['Rosak', 40]
            ],
            colors:{
                Maut: '#000000',
                Parah: '#e42238',
                Ringan: '#1ab394',
                Rosak: '#3e80c5'
            },
            type : 'pie'
        }
    });
    
    $('.table-list-fdata').DataTable({
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
    
    $('.chosen-state').chosen({
        width: "100%"
    });
    
    $('.chosen-district').chosen({
        width: "100%"
    });
    
    $('.chosen-road').chosen({
        width: "100%"
    });
    
    $('.chosen-category').chosen({
        width: "100%"
    });
    
    $('.chosen-month').chosen({
        width: "100%"
    });
    
    $('.chosen-year').chosen({
        width: "100%"
    });
    
    $('.chosen-surface').chosen({
        width: "100%"
    });
    
    $('.chosen-condition').chosen({
        width: "100%"
    });
    
    $('.chosen-quality').chosen({
        width: "100%"
    });
    
    $('.chosen-traffic').chosen({
        width: "100%"
    });
    
    $('.chosen-weather').chosen({
        width: "100%"
    });
    
    $('.chosen-hit').chosen({
        width: "100%"
    });
    
    $('.chosen-road-shape').chosen({
        width: "100%"
    });
    
    $('.chosen-line').chosen({
        width: "100%"
    });
    
    $('.chosen-road-surface').chosen({
        width: "100%"
    });
    
    $('.chosen-road-defact').chosen({
        width: "100%"
    });
    
    $('.chosen-light').chosen({
        width: "100%"
    });
    
    $('.input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: false,
        autoclose: true,
        format: "dd-mm-yyyy"
    });
    
    $('[data-toggle="tooltip"]').tooltip();
});

$(document).on('click','.data-filter',function() {
    $('#modal-filter-fdata').modal('show');
    $('#form-filter-fdata')[0].reset();
});

$(document).on('click','.fdata-view',function() {
    $('#modal-view-fdata').modal('show');
    $('#form-view-fdata')[0].reset();
});

$(document).on('click','.fdata-edit',function() {
    $('#modal-edit-fdata').modal('show');
    $('#form-edit-fdata')[0].reset();
});

$(document).on('click','.fdata-delete',function() {
    $('#modal-delete-fdata').modal('show');
    $('#form-delete-fdata')[0].reset();
});    