$(document).ready(function() {
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
    
    $('.chosen-year').chosen({
        width: "100%"
    });
    
    $('.chosen-month').chosen({
        width: "100%"
    });
});

$(document).on('click','.data-filter',function() {
    $('#modal-filter-fdata').modal('show');
    $('#form-filter-fdata')[0].reset();
});