// $(document).on('click','.laporan-awalan',function() {
//     var id = $(this).data('id');
//     $('#modal-view-laporan-awalan').modal('show');
//     $('#form-view-laporan-awalan')[0].reset();
//     // $('.message-form').html('');
//
//         $.ajax({
//             url: "ajaxViewDataMap&id=" + id,
//             type: "GET",
//             dataType: "JSON",
//             success: function(data){
//                 $('[name="v_fdata_id"]').val(id);
//                 $('[name="v_latitude"]').val(data.latitude);
//                 $('[name="v_longitude"]').val(data.logitude);
//                 $('[name="v_no_laluan"]').val(data.no_laluan);
//                 $('[name="v_nombor_seksyen"]').val(data.nombor_seksyen);
//                 $('[name="v_pos_kilometer"]').val(data.pos_kilometer);
//                 $("#v_no_laporan").val(data.no_laporan);
//                 $("#v_negeri").val(data.negeri.name);
//                 $("#v_daerah").val(data.daerah.name);
//                 $("#v_jenis_kemalangan").val(data.jeniskemalangan.name);
//                 $("#v_tempat_kejadian").val(data.tempat_kejadian);
//                 $("#v_tarikh_kejadian").val(data.tarikh);
//                 $("#v_bulan").val(data.bulan.name);
//                 $("#v_tahun").val(data.tahun);
//                 $("#v_jenis_permukaan").val(data.jenis_permukaan.name);
//                 $("#v_keadaan_jalan").val(data.keadaan_jalan.name);
//                 $("#v_kualiti_permukaan").val(data.kualiti_permukaan.name);
//                 $("#v_sistem_laluan").val(data.sistem_laluan.name);
//                 $("#v_cuaca").val(data.cuaca.name);
//                 $("#v_jenis_langgar_pertama").val(data.jenis_langgar_pertama.name);
//                 $("#v_bentuk_jalan").val(data.bentuk_jalan.name);
//                 $("#v_jenis_garis").val(data.jenis_garis.name);
//                 $("#v_muka_jalan").val(data.muka_jalan.name);
//                 $("#v_sebab_cacat_jalan").val(data.sebab_cacat_jalan.name);
//                 $("#v_cahaya").val(data.cahaya.name);
//                 $("#v_updated_by").html(data.user.fullname);
//                 $("#v_bahagian").html(data.user.department.name);
//                 $("#v_updated_at").html(data.updated);
//                 $('#kemaskini').attr('data-id',id);
//             },
//             error: function(jqXHR, textStatus, errorThrown){
//                 alert('Error get data from ajax');
//             }
//         });

// });
$(document).on('click','.laporan-awalan',function() {
    var id = $(this).data('id');
    $.ajax({
        url: "ajaxlaporanawalan&id="+id,
        type: "GET",
        success: function(data){
            $(".breadcrumb").append('<li>Kemaskini Maklumatt<li>');
            $("#wrapper-laporan-awalan").html(data);
        },
        error: function(jqXHR, textStatus, errorThrown){
            alert(errorThrown);
        }
    });

});

$(document).on('click','.laporan-awalan-view',function() {
    var id = $(this).data('id');
    $.ajax({
        url: "ajaxViewLaporanAwalan&id="+id,
        type: "GET",
        success: function(data){
            $(".breadcrumb").append('<li>Paparan Maklumat<li>');
            $("#wrapper-laporan-awalan").html(data);
        },
        error: function(jqXHR, textStatus, errorThrown){
            alert(errorThrown);
        }
    });

});

// $(document).ready(function() {
//     if(session_val !=  null){
//         if(session_val !=0){
//             $.ajax({
//                 url: "ajaxlaporanawalan&id="+session_val,
//                 type: "GET",
//                 success: function(data){
//                     $(".breadcrumb").append('<li>Test<li>');
//                     $("#wrapper-laporan-awalan").html(data);
//                 },
//                 error: function(jqXHR, textStatus, errorThrown){
//                     alert(errorThrown);
//                 }
//             });
//         }
//     }
// });