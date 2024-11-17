Dropzone.options.dropzoneForm = {
    type: "POST",
    url: "importCSV",
    paramName: "import_file", // The name that will be used to transfer the file
    dictDefaultMessage: "<strong>Letakkan fail atau klik di sini untuk muat naik. </strong>",
    addRemoveLinks: true,
    acceptedFiles: ".csv",
    headers: {
      'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
    },
    init: function () {
        // Set up any event handlers
        this.on('complete', function () {
            location.reload();
        });
    }
};

$(document).ready(function() {
    var table = $('.table-list-file').DataTable({
        processing: true,
        serverSide: false,
        ajax:  {
            url: 'getDataProcess'
        },
        columns: [
            {data: 'DT_RowIndex', sortable: false, searchable: false},
            {data: 'name', name: 'name'},
            {data: 'status', name: 'status'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action'},
        ],
        order:[[3, 'desc']],
        pageLength: 31,
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

    $.fn.dataTable.Debounce = function ( table, options ) {
        var tableId = table.settings()[0].sTableId;
        $('.dataTables_filter input[aria-controls="' + tableId + '"]') // select the correct input field
            .unbind() // Unbind previous default bindings
            .bind('input', (delay(function (e) { // Bind our desired behavior
                table.search($(this).val()).draw();
                return;
            }, 1000))); // Set delay in milliseconds
    }

    function delay(callback, ms) {
        var timer = 0;
        return function () {
            var context = this, args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function () {
                callback.apply(context, args);
            }, ms || 0);
        };
    }

    var debounce = new $.fn.dataTable.Debounce(table);

    $('[data-toggle="tooltip"]').tooltip();

});

$(document).on('click','.file-edit',function() {
    $('#mesej').html('');
    var id = $(this).data('id');

    $.ajax({
        url: "migrateData/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(){
            $(location).attr('href','dataProcess');
        }
    });
});

$(document).on('click','.file-delete',function() {
    var id = $(this).data('id');
    console.log(id);
    swal({
          title: "Adakah anda pasti?",
          text: "Untuk memadam data ini?",
          icon: "warning",
          buttons: ["Batal", "Teruskan"],
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax({
                url:"deleteMigrateData/" + id,
                type: "GET",
                data: id,
                processData: false,
                contentType: false,
                headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data){
                    swal("Data berjaya dipadam!", {
                      icon: "success",
                    });
                    location.reload();
                }
            });
          } else {
            swal("Data tidak dipadam.");
          }
    });
});
$(document).on('click','.apirecord-edit',function() {
    $('#mesej').html('');
    var id = $(this).data('id');

    $.ajax({
        url: "migrateApiData/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(){
            $(location).attr('href','dataProcess');
        }
    });
});

$(document).on('click','.apirecord-delete',function() {
    var id = $(this).data('id');
    console.log(id);
    swal({
        title: "Adakah anda pasti?",
        text: "Untuk memadam data ini?",
        icon: "warning",
        buttons: ["Batal", "Teruskan"],
        dangerMode: true,
    })
        .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url:"deleteApiData/" + id,
                type: "GET",
                data: id,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data){
                    swal("Data berjaya dipadam!", {
                        icon: "success",
                    });
                    location.reload();
                }
            });
        } else {
            swal("Data tidak dipadam.");
}
});
});
$(document).on('click','.pol-27',function() {
    $('#POL27').modal('show');
    $('#form-api-pol27')[0].reset();
    $('.message-form').html('');
});
$(document).on('click','.24-jam',function() {
    $('#24-jam').modal('show');
    $('#form-24-jam')[0].reset();
    $('.message-form').html('');
});
$(document).on('click','.no-laporan',function() {
    $('#no-laporan').modal('show');
    $('#form-no-laporan')[0].reset();
    $('.message-form').html('');
});
$('#jenis27').change(function(){
    if ( $(this).val() == "Date") {


        $('.laporan').hide();
        $('.tarikh').show();
    }
    else{
        $('.laporan').show();
        $('.tarikh').hide();
    }
});
$(document).ready(function() {
    $('.laporan').hide();
    $('.tarikh').show();
});
$('.input-group.date').datepicker({
    todayBtn: "linked",
    keyboardNavigation: false,
    forceParse: false,
    calendarWeeks: false,
    autoclose: true,
    format: "yyyy-mm-dd"
});
$('#laporan27').click(function(){

    var startDate = $('[name="startDate1"]').val();
    var endDate = $('[name="endDate"]').val();
    var noLaporan = $('[name="noLaporan"]').val();
    // alert(startDate);
    // alert('we did it');
    if($('[name="Jenis"]').val()=='Date'){
        var url="/api_1";
    }
    else{

        var url="/api_2";
    }
        $.ajax({

            url:url,
            type: "POST",
            data: $('#form-api-pol27').serialize(),
            dataType: "json",
            success: function(data){
                    $('.message-form').html(data.success_form);
                    setTimeout(function(){
                        $('.message-form').remove();
                        $('#POL27').modal('hide');
                        $(location).attr('href','dataProcess');
                    }, 1000);

            },
            error: function(jqXHR, textStatus, errorThrown){
                alert(errorThrown);
            }
        });

});
$('#laporan24').click(function(){
    var url="/api_3";
    $.ajax({

        url:url,
        type: "POST",
        data: $('#form-no-laporan').serialize(),
        dataType: "json",
        success: function(data){
            $('.message-form').html(data.success_form);
            // console.log(data.status);
            setTimeout(function(){
                $('.message-form').remove();
                $('#no-laporan').modal('hide');
                $(location).attr('href','dataProcess');
            }, 1000);

        },
        error: function(jqXHR, textStatus, errorThrown){
            console.log(jqXHR);
        }
    });

});
$(document).on('click','.exportList-view',function() {
    $('.table-list-export').DataTable().destroy();
    var id = $(this).data('id');
    $('#export_list').modal('show');
    $('.table-list-export').DataTable( {
        processing: true,
        serverSide: true,
        ajax: "getListExport&id="+id,
        columns: [
        {data: 'DT_RowIndex', sortable: false,searchable: false},
        {data: 'no_laporan', name: 'no_laporan'},
        // {data: 'jenis_kemalangan', name: 'jenis_kemalangan'},
        {data: 'tarikh_kejadian', name: 'tarikh_kejadian'},
        // {data: 'negeri', name: 'negeri'},
        {data: 'no_laluan', name: 'no_laluan'},
    ],
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


});

