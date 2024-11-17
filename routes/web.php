<?php

use App\Http\Controllers\AccidentController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\BlackspotController;
use App\Http\Controllers\ForensikController;
use App\Http\Controllers\JejantasController;
use App\Http\Controllers\LampujalanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LipController;
use App\Http\Controllers\LpksiController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\RoadController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StlController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Editor;
use App\Http\Middleware\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Accident routes
Route::get('/importApi', [AccidentController::class, 'importApi']);
Auth::routes();

Route::get('/', function () {
    return view('site.index2');
});

// All roles can access
Route::get('/laporanawalantestemailnegeri', [AccidentController::class, 'laporanawalantestemailnegeri']);
Route::get('/userprofile', [UserController::class, 'userProfile']);
Route::get('/getUserProfil', [UserController::class, 'getUserProfil'])->name('getUserProfil');
Route::post('/ajaxUpdatePassword&id={id}', [UserController::class, 'ajaxUpdatePassword']);

Route::get('/dashboard', [AccidentController::class, 'index']); // key gmap
Route::post('/filterdashboard', [AccidentController::class, 'index']);
Route::get('/populateDaerah', [AccidentController::class, 'populateDaerah']);
Route::get('/populateNolaluan', [AccidentController::class, 'populateNolaluan']);
Route::get('/ajaxNamalaluan', [AccidentController::class, 'ajaxNamalaluan']);
Route::get('/populateNolaluanBlackspot', [AccidentController::class, 'populateNolaluanBlackspot']);
Route::get('/ajaxViewData&id={id}', [AccidentController::class, 'ajaxViewData']);

Route::get('/laporanAwalan', [AccidentController::class, 'laporanAwalan'])->name('laporanAwalan');
Route::post('/laporanAwalan', [AccidentController::class, 'laporanAwalan'])->name('laporanAwalan');
Route::get('/getLaporanAwalan', [AccidentController::class, 'getLaporanAwalan'])->name('getLaporanAwalan');
Route::get('/ajaxlaporanawalan&id={id}', [AccidentController::class, 'ajaxlaporanawalan']);
Route::get('/ajaxViewLaporanAwalan&id={id}', [AccidentController::class, 'ajaxViewLaporanAwalan']);
Route::post('/laporanAwalanPost', [AccidentController::class, 'laporanAwalanPost']);
Route::post('/laporanAwalanHantar', [AccidentController::class, 'laporanAwalanHantar']);
Route::post('/laporanAwalanSah', [AccidentController::class, 'laporanAwalanSah']);
Route::post('/laporanAwalanPdf', [PDFController::class, 'laporanAwalanPdf']);
Route::post('/laporanawalanexceldownload', [AccidentController::class, 'laporanawalanexportexcel']);

Route::get('/dataMap', [AccidentController::class, 'dataMap']); // key gmap
Route::get('/getDataMap', [AccidentController::class, 'getDataMap']);
Route::post('/filterdataMap', [AccidentController::class, 'dataMap']); // key gmap
Route::get('/ajaxViewDataMap&id={id}', [AccidentController::class, 'ajaxViewDataMap']);
Route::get('/dataGMaps', [AccidentController::class, 'dataGMaps']); // key gmap
Route::post('/dataGMaps', [AccidentController::class, 'dataGMaps']); // key gmap
Route::post('/exceldownload', [AccidentController::class, 'exportexcel']);
Route::post('/csvdownload', [AccidentController::class, 'exportcsv']);
Route::post('/jsondownload', [AccidentController::class, 'exportjson']);
Route::post('/pdfdownload', [AccidentController::class, 'exportpdf']);
Route::get('/getListKenderaan&id={id}', [AccidentController::class, 'getListKenderaan'])->name('getListKenderaan');

// Black Spot routes
Route::middleware(Role::class . ':admin,adminjkr')->group(function () {
    Route::get('/reportBlackspot', [BlackspotController::class, 'dataReport']); // key gmap
    Route::post('/reportBlackspot', [BlackspotController::class, 'dataReport']);
    Route::get('/dataBlackspot', [BlackspotController::class, 'dataBlackspot']); // key gmap
    Route::post('/dataBlackspot', [BlackspotController::class, 'dataBlackspot']); // key gmap
    Route::get('/blackspotnew', [BlackspotController::class, 'dataBlackspot']);
    Route::post('/blackspotnew', [BlackspotController::class, 'dataBlackspot']);
    Route::post('/blackexceldownload', [BlackspotController::class, 'blackexportexcel']);
    Route::post('/blackcsvdownload', [BlackspotController::class, 'blackexportcsv']);
    Route::post('/blackjsondownload', [BlackspotController::class, 'blackexportjson']);
    Route::post('/blackpdfdownload', [BlackspotController::class, 'blackexportpdf']);
    Route::get('/generate', [BlackspotController::class, 'dataBlackspot2']);

    Route::get('/report1', [BlackspotController::class, 'generateBlackspotData']);
    Route::post('/report1', [BlackspotController::class, 'generateBlackspotData']);
});

// Lampu Jalan routes
Route::middleware(Role::class . ':admin,adminjkr')->group(function () {
    Route::get('/reportLampujalan', [LampujalanController::class, 'dataReport']); // key gmap
    Route::post('/reportLampujalan', [LampujalanController::class, 'dataReport']);
    Route::get('/dataLampujalan', [LampujalanController::class, 'dataLampujalan']); // key gmap
    Route::post('/dataLampujalan', [LampujalanController::class, 'dataLampujalan']); // key gmap
    Route::get('/lampujalannew', [LampujalanController::class, 'dataLampujalan']);
    Route::post('/lampujalannew', [LampujalanController::class, 'dataLampujalan']);
    Route::post('/lampujalanexceldownload', [LampujalanController::class, 'lampujalanexportexcel']);
    Route::post('/lampujalancsvdownload', [LampujalanController::class, 'lampujalanexportcsv']);
    Route::post('/lampujalanjsondownload', [LampujalanController::class, 'lampujalanexportjson']);
    Route::post('/lampujalanpdfdownload', [LampujalanController::class, 'lampujalanexportpdf']);
    Route::get('/generate', [LampujalanController::class, 'dataLampujalan2']);

    Route::get('/reportLampujalan1', [LampujalanController::class, 'generateLampujalanData']);
    Route::post('/reportLampujalan1', [LampujalanController::class, 'generateLampujalanData']);

    Route::get('/analisisLampujalan', [LampujalanController::class, 'analisisLampujalan']);
    Route::get('/borangWaran', [LampujalanController::class, 'borangWaran'])->name('borangWaran');
    Route::get('/borangHantar', [LampujalanController::class, 'borangHantar'])->name('borangHantar');
    Route::get('/waranLampujalanBorang', [LampujalanController::class, 'waranLampujalan'])->name('waranLampujalanBorang');
});

// Jejantas routes
Route::middleware(Role::class . ':admin,adminjkr')->group(function () {
    Route::get('/reportJejantas', [JejantasController::class, 'dataMapJejantas']); // key gmap
    Route::post('/reportJejantas', [JejantasController::class, 'dataMapJejantas']);
    Route::get('/getDataMapJejantas', [JejantasController::class, 'getDataMapJejantas']);
    Route::get('/dataJejantas', [JejantasController::class, 'dataJejantas']); // key gmap
    Route::post('/dataJejantas', [JejantasController::class, 'dataJejantas']); // key gmap
    Route::get('/jejantasnew', [JejantasController::class, 'dataJejantas']);
    Route::post('/jejantasnew', [JejantasController::class, 'dataJejantas']);
    Route::post('/jejantasexceldownload', [JejantasController::class, 'jejantasexportexcel']);
    Route::post('/jejantascsvdownload', [JejantasController::class, 'jejantasexportcsv']);
    Route::post('/jejantasjsondownload', [JejantasController::class, 'jejantasexportjson']);
    Route::post('/jejantaspdfdownload', [JejantasController::class, 'jejantasexportpdf']);
    Route::get('/generate', [JejantasController::class, 'dataJejantas2']);

    Route::get('/reportJejantas1', [JejantasController::class, 'generateJejantasData']);
    Route::post('/reportJejantas1', [JejantasController::class, 'generateJejantasData']);
    Route::get('/analisisJejantas', [JejantasController::class, 'analisisJejantas'])->name('analisisJejantas');
    Route::get('/waranJejantasBorang', [JejantasController::class, 'waranJejantas'])->name('waranJejantasBorang');
});

// Lintasan Pejalan Kaki Searas Berlampu Isyarat [LPKSI] routes
Route::middleware(Role::class . ':admin,adminjkr')->group(function () {
    Route::get('/reportLpksi', [LpksiController::class, 'dataMapLpksi']); // key gmap
    Route::post('/reportLpksi', [LpksiController::class, 'dataMapLpksi']);
    Route::get('/getDataMapLpksi', [LpksiController::class, 'getDataMapLpksi']);
    Route::get('/dataLpksi', [LpksiController::class, 'dataLpksi']); // key gmap
    Route::post('/dataLpksi', [LpksiController::class, 'dataLpksi']); // key gmap
    Route::get('/lpksinew', [LpksiController::class, 'dataLpksi']);
    Route::post('/lpksinew', [LpksiController::class, 'dataLpksi']);
    Route::post('/lpksiexceldownload', [LpksiController::class, 'lpksiexportexcel']);
    Route::post('/lpksicsvdownload', [LpksiController::class, 'lpksiexportcsv']);
    Route::post('/lpksijsondownload', [LpksiController::class, 'lpksiexportjson']);
    Route::post('/lpksipdfdownload', [LpksiController::class, 'lpksiexportpdf']);
    Route::get('/generate', [LpksiController::class, 'dataLpksi2']);

    Route::get('/reportLpksi1', [LpksiController::class, 'generateLpksiData']);
    Route::post('/reportLpksi1', [LpksiController::class, 'generateLpksiData']);
    Route::get('/analisisLpksi', [LpksiController::class, 'analisisLpksi'])->name('analisisLpksi');
    Route::get('/waranLpksiBorang', [LpksiController::class, 'waranLpksi'])->name('waranLpksiBorang');
});

// Lampu Isyarat Di Persimpangan [LIP]
Route::middleware(Role::class . ':admin,adminjkr')->group(function () {
    Route::get('/reportLip', [LipController::class, 'dataMapLip']); // key gmap
    Route::post('/reportLip', [LipController::class, 'dataMapLip']);
    Route::get('/getDataMapLip', [LipController::class, 'getDataMapLip']);
    Route::get('/dataLip', [LipController::class, 'dataLip']); // key gmap
    Route::post('/dataLip', [LipController::class, 'dataLip']); // key gmap
    Route::get('/lipnew', [LipController::class, 'dataLip']);
    Route::post('/lipnew', [LipController::class, 'dataLip']);
    Route::post('/lipexceldownload', [LipController::class, 'lipexportexcel']);
    Route::post('/lipcsvdownload', [LipController::class, 'lipexportcsv']);
    Route::post('/lipjsondownload', [LipController::class, 'lipexportjson']);
    Route::post('/lippdfdownload', [LipController::class, 'lipexportpdf']);
    Route::get('/generate', [LipController::class, 'dataLip2']);

    Route::get('/reportLip1', [LipController::class, 'generateLipData']);
    Route::post('/reportLip1', [LipController::class, 'generateLipData']);
    Route::get('/analisisLip', [LipController::class, 'analisisLip'])->name('analisisLip');
    Route::get('/waranLipBorang', [LipController::class, 'waranLip'])->name('waranLipBorang');
});

// Smart Traffic Light [STL]
Route::middleware(Role::class . ':admin,adminjkr')->group(function () {
    Route::get('/reportStl', [StlController::class, 'dataMapStl']); // key gmap
    Route::post('/reportStl', [StlController::class, 'dataMapStl']);
    Route::get('/getDataMapStl', [StlController::class, 'getDataMapStl']);
    Route::get('/dataStl', [StlController::class, 'dataStl']); // key gmap
    Route::post('/dataStl', [StlController::class, 'dataStl']); // key gmap
    Route::get('/stlnew', [StlController::class, 'dataStl']);
    Route::post('/stlnew', [StlController::class, 'dataStl']);
    Route::post('/stlexceldownload', [StlController::class, 'stlexportexcel']);
    Route::post('/stlcsvdownload', [StlController::class, 'stlcsvdownload']);
    Route::post('/stljsondownload', [StlController::class, 'stlxportjson']);
    Route::post('/stlpdfdownload', [StlController::class, 'stlexportpdf']);
    Route::get('/generate', [StlController::class, 'dataStl2']);

    Route::get('/reportStl1', [StlController::class, 'generateStlData']);
    Route::post('/reportStl1', [StlController::class, 'generateStlData']);
    Route::get('/analisisStl', [StlController::class, 'analisisStl']);
    Route::get('/waranStlBorang', [StlController::class, 'analisisStl'])->name('waranStlBorang');
});

// list_laporan: Black Spot
Route::get('/laporanBlackspot', [LaporanController::class, 'laporanList']);
Route::post('/laporanBlackspot', [LaporanController::class, 'laporanList']);
Route::get('/laporanPetaBlackspot', [LaporanController::class, 'dataBlackspot']); // key gmap
Route::post('/laporanPetaBlackspot', [LaporanController::class, 'dataBlackspot']); // key gmap

// list_laporan: Lampu Jalan
Route::get('/laporanLampujalan', [LaporanController::class, 'laporanListLampujalan']);
Route::post('/laporanLampujalan', [LaporanController::class, 'laporanListLampujalan']);
Route::get('/laporanPetaLampujalan', [LaporanController::class, 'dataLampujalan']); // key gmap
Route::post('/laporanPetaLampujalan', [LaporanController::class, 'dataLampujalan']); // key gmap

// list_laporan: Jejantas
Route::get('/laporanJejantas', [LaporanController::class, 'laporanListJejantas']);
Route::post('/laporanJejantas', [LaporanController::class, 'laporanListJejantas']);
Route::get('/laporanPetaJejantas', [LaporanController::class, 'dataJejantas']); // key gmap
Route::post('/laporanPetaJejantas', [LaporanController::class, 'dataJejantas']); // key gmap

// list_laporan: Lintasan Pejalan Kaki Searas Berlampu Isyarat [LPKSI]
Route::get('/laporanLpksi', [LaporanController::class, 'laporanListLpksi']);
Route::post('/laporanLpksi', [LaporanController::class, 'laporanListLpksi']);
Route::get('/laporanPetaLpksi', [LaporanController::class, 'dataLpksi']); // key gmap
Route::post('/laporanPetaLpksi', [LaporanController::class, 'dataLpksi']); // key gmap

// list_laporan: Lampu Isyarat Di Persimpangan [LIP]
Route::get('/laporanLip', [LaporanController::class, 'laporanListLip']);
Route::post('/laporanLip', [LaporanController::class, 'laporanListLip']);
Route::get('/laporanPetaLip', [LaporanController::class, 'dataLip']); // key gmap
Route::post('/laporanPetaLip', [LaporanController::class, 'dataLip']); // key gmap

// list_laporan: Smart Traffic Light [STL]
Route::get('/laporanStl', [LaporanController::class, 'laporanListStl']);
Route::post('/laporanStl', [LaporanController::class, 'laporanListStl']);
Route::get('/laporanPetaStl', [LaporanController::class, 'dataStl']); // key gmap
Route::post('/laporanPetaStl', [LaporanController::class, 'dataStl']); // key gmap

// list_laporan
Route::get('/getLaporan', [LaporanController::class, 'getLaporanData'])->name('getLaporanData');
Route::post('/daftarLaporan', [LaporanController::class, 'daftarLaporan'])->name('daftarLaporan');
Route::get('/ajaxGetDataLaporan&id={id}', [LaporanController::class, 'ajaxGetDataLaporan'])->name('ajaxGetDataLaporan');
Route::post('/ajaxDeleteLaporan&id={id}', [LaporanController::class, 'ajaxDeleteLaporan'])->name('ajaxDeleteLaporan');

// List Laporan Forensik
Route::prefix('forensik')->name('forensik.')->group(function () {
    Route::get('/laporanForensik', [ForensikController::class, 'laporanList'])->name('laporanForensik');
    Route::get('/getLaporan', [ForensikController::class, 'getLaporanData'])->name('getLaporanForensikData');
    Route::post('/daftarLaporan', [ForensikController::class, 'daftarLaporan'])->name('daftarLaporan');
    Route::get('/ajaxGetDataLaporan&id={id}', [ForensikController::class, 'ajaxGetDataLaporan'])->name('ajaxGetDataLaporan');
    Route::post('/ajaxDeleteLaporan&id={id}', [ForensikController::class, 'ajaxDeleteLaporan'])->name('ajaxDeleteLaporan');
});

// Kenderaan routes
Route::get('/dataKenderaan', [AccidentController::class, 'dataKenderaan']);
Route::get('/getDataKenderaan', [AccidentController::class, 'getDataKenderaan']);
Route::post('/filterdataKenderaan', [AccidentController::class, 'dataKenderaan']);
Route::get('/filterdataKenderaan', [AccidentController::class, 'dataKenderaan']);
Route::get('/ajaxViewDataKenderaan&id={id}', [AccidentController::class, 'ajaxViewDataKenderaan']);
Route::post('/excelkenderaandownload', [AccidentController::class, 'exportexcelkenderaan']);
Route::post('/excelkenderaandownload2', [AccidentController::class, 'exportexcelkenderaan2']);

// User manual
Route::get('/userManual', [UserController::class, 'userManual']);

// Cache clearing route
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    return "Cache is cleared";
});

// Data Jalan routes
Route::get('/roadRoad', [RoadController::class, 'roadRoad']);
Route::get('/getDataJalan', [RoadController::class, 'getDataJalan'])->name('getDataJalan');
Route::get('/ajaxViewJalan&id={id}', [RoadController::class, 'ajaxViewJalan']);
Route::post('/ajaxUpdateJalan&id={id}', [RoadController::class, 'ajaxUpdateJalan']);
Route::post('/ajaxRegisterJalan', [RoadController::class, 'ajaxRegisterJalan'])->name('ajaxRegisterJalan');
Route::post('/ajaxDeleteJalan&id={id}', [RoadController::class, 'ajaxDeleteJalan']);
Route::post('/filterdataJalan', [AccidentController::class, 'dataJalan']);
Route::get('/filterdataJalan', [AccidentController::class, 'dataJalan']);

// User routes
Route::middleware(Editor::class)->group(function () {
    Route::post('/ajaxUpdateDataMap&id={id}', [AccidentController::class, 'ajaxUpdateDataMap']);
    Route::post('/ajaxSahkanDataMap&id={id}', [AccidentController::class, 'ajaxSahkanDataMap']);
    Route::get('/userUser', [UserController::class, 'userUser']);
    Route::get('/getUserData', [UserController::class, 'getUserData'])->name('getUserData');
    Route::get('/ajaxViewUser&id={id}', [UserController::class, 'ajaxViewUser']);
    Route::post('/ajaxUpdateUser&id={id}', [UserController::class, 'ajaxUpdateUser']);
    Route::post('/ajaxRegisterUser', [UserController::class, 'ajaxRegisterUser']);
    Route::get('/department', [SettingController::class, 'department']);
    Route::get('/getDepartmentData', [SettingController::class, 'getDepartmentData'])->name('getDepartmentData');
    Route::get('/ajaxViewDepartment&id={id}', [SettingController::class, 'ajaxViewDepartment']);
    Route::post('/ajaxUpdateDepartment&id={id}', [SettingController::class, 'ajaxUpdateDepartment']);
    Route::post('/ajaxRegisterDepartment', [SettingController::class, 'ajaxRegisterDepartment']);
});

// POL 27 routes
Route::get('/pol271/{startDate1}/{endDate}', [ApiController::class, 'pol27ByDateGet']);

// Role system admin & KKR
Route::middleware(Admin::class)->group(function () {
    Route::get('/dataProcess', [AccidentController::class, 'dataProcess']);
    Route::get('/getDataProcess', [AccidentController::class, 'getDataProcess']);
    Route::post('/importCSV', [AccidentController::class, 'importCSV']);
    Route::get('/migrateData/{id}', [AccidentController::class, 'migrateData']);
    Route::get('/deleteMigrateData/{id}', [AccidentController::class, 'deleteMigrateData']);
    Route::get('/migrateApiData/{id}', [AccidentController::class, 'migrateApiData']);
    Route::get('/deleteApiData/{id}', [AccidentController::class, 'deleteApiData']);
    Route::get('/getListExport&id={id}', [AccidentController::class, 'getListExport'])->name('getListExport');

    // API routes
    Route::post('/api_1', [ApiController::class, 'pol27ByDatePost']);
    Route::get('/api_2', [ApiController::class, 'pol27Bynolaporan']);
    Route::post('/api_3', [ApiController::class, 'report24Post']);

    Route::get('/testApi', [AccidentController::class, 'testApi']);
    Route::get('/apiTest/{action}/{startDate1}/{endDate}', [ApiController::class, 'test_raw_api']);

    Route::get('/api1', [ApiController::class, 'api']);
    Route::get('/apiTest1/{endDate}', [ApiController::class, 'test_raw_api_rp24']);
    Route::get('/api2&negeri={negeri}&tkh={tarikhrepot}', [ApiController::class, 'api2']);
    Route::get('/report241/{Date}', [ApiController::class, 'report24ByDate']);
    Route::get('/pol27', [ApiController::class, 'pol27ByDate']);
    Route::get('/report24', [ApiController::class, 'report24']);

    Route::get('/ajaxDeleteDataMap&id={id}', [AccidentController::class, 'ajaxDeleteDataMap']);

    Route::post('/ajaxDeleteUser&id={id}', [UserController::class, 'ajaxDeleteUser']);

    Route::get('/userRole', [UserController::class, 'userRole']);
    Route::get('/getRoleData', [UserController::class, 'getRoleData'])->name('getRoleData');
    Route::get('/ajaxViewRole&id={id}', [UserController::class, 'ajaxViewRole']);
    Route::post('/ajaxUpdateRole&id={id}', [UserController::class, 'ajaxUpdateRole']);
    Route::post('/ajaxDeleteRole&id={id}', [UserController::class, 'ajaxDeleteRole']);
    Route::post('/ajaxRegisterRole', [UserController::class, 'ajaxRegisterRole']);

    Route::get('/arah', [SettingController::class, 'arah']);
    Route::get('/getArahData', [SettingController::class, 'getArahData'])->name('getArahData');
    Route::get('/ajaxViewArah&id={id}', [SettingController::class, 'ajaxViewArah']);
    Route::post('/ajaxUpdateArah&id={id}', [SettingController::class, 'ajaxUpdateArah']);
    Route::post('/ajaxDeleteArah&id={id}', [SettingController::class, 'ajaxDeleteArah']);
    Route::post('/ajaxRegisterArah', [SettingController::class, 'ajaxRegisterArah']);

    Route::get('/balai', [SettingController::class, 'balai']);
    Route::get('/getBalaiData', [SettingController::class, 'getBalaiData'])->name('getBalaiData');
    Route::get('/ajaxViewBalai&id={id}', [SettingController::class, 'ajaxViewBalai']);
    Route::post('/ajaxUpdateBalai&id={id}', [SettingController::class, 'ajaxUpdateBalai']);
    Route::post('/ajaxDeleteBalai&id={id}', [SettingController::class, 'ajaxDeleteBalai']);
    Route::post('/ajaxRegisterBalai', [SettingController::class, 'ajaxRegisterBalai']);

    Route::get('/bentukJalan', [SettingController::class, 'bentukJalan']);
    Route::get('/getBentukJalanData', [SettingController::class, 'getBentukJalanData'])->name('getBentukJalanData');
    Route::get('/ajaxViewBentukJalan&id={id}', [SettingController::class, 'ajaxViewBentukJalan']);
    Route::post('/ajaxUpdateBentukJalan&id={id}', [SettingController::class, 'ajaxUpdateBentukJalan']);
    Route::post('/ajaxDeleteBentukJalan&id={id}', [SettingController::class, 'ajaxDeleteBentukJalan']);
    Route::post('/ajaxRegisterBentukJalan', [SettingController::class, 'ajaxRegisterBentukJalan']);

    Route::get('/bulan', [SettingController::class, 'bulan']);
    Route::get('/getBulanData', [SettingController::class, 'getBulanData'])->name('getBulanData');
    Route::get('/ajaxViewBulan&id={id}', [SettingController::class, 'ajaxViewBulan']);
    Route::post('/ajaxUpdateBulan&id={id}', [SettingController::class, 'ajaxUpdateBulan']);
    Route::post('/ajaxDeleteBulan&id={id}', [SettingController::class, 'ajaxDeleteBulan']);
    Route::post('/ajaxRegisterBulan', [SettingController::class, 'ajaxRegisterBulan']);

    Route::get('/cahaya', [SettingController::class, 'cahaya']);
    Route::get('/getCahayaData', [SettingController::class, 'getCahayaData'])->name('getCahayaData');
    Route::get('/ajaxViewCahaya&id={id}', [SettingController::class, 'ajaxViewCahaya']);
    Route::post('/ajaxUpdateCahaya&id={id}', [SettingController::class, 'ajaxUpdateCahaya']);
    Route::post('/ajaxDeleteCahaya&id={id}', [SettingController::class, 'ajaxDeleteCahaya']);
    Route::post('/ajaxRegisterCahaya', [SettingController::class, 'ajaxRegisterCahaya']);

    Route::get('/cuaca', [SettingController::class, 'cuaca']);
    Route::get('/getCuacaData', [SettingController::class, 'getCuacaData'])->name('getCuacaData');
    Route::get('/ajaxViewCuaca&id={id}', [SettingController::class, 'ajaxViewCuaca']);
    Route::post('/ajaxUpdateCuaca&id={id}', [SettingController::class, 'ajaxUpdateCuaca']);
    Route::post('/ajaxDeleteCuaca&id={id}', [SettingController::class, 'ajaxDeleteCuaca']);
    Route::post('/ajaxRegisterCuaca', [SettingController::class, 'ajaxRegisterCuaca']);

    Route::get('/daerah', [SettingController::class, 'daerah']);
    Route::get('/getDaerahData', [SettingController::class, 'getDaerahData'])->name('getDaerahData');
    Route::get('/ajaxViewDaerah&id={id}', [SettingController::class, 'ajaxViewDaerah']);
    Route::post('/ajaxUpdateDaerah&id={id}', [SettingController::class, 'ajaxUpdateDaerah']);
    Route::post('/ajaxDeleteDaerah&id={id}', [SettingController::class, 'ajaxDeleteDaerah']);
    Route::post('/ajaxRegisterDaerah', [SettingController::class, 'ajaxRegisterDaerah']);

    Route::post('/ajaxDeleteDepartment&id={id}', [SettingController::class, 'ajaxDeleteDepartment']);

    Route::get('/hadLaju', [SettingController::class, 'hadLaju']);
    Route::get('/getHadLajuData', [SettingController::class, 'getHadLajuData'])->name('getHadLajuData');
    Route::get('/ajaxViewHadLaju&id={id}', [SettingController::class, 'ajaxViewHadLaju']);
    Route::post('/ajaxUpdateHadLaju&id={id}', [SettingController::class, 'ajaxUpdateHadLaju']);
    Route::post('/ajaxDeleteHadLaju&id={id}', [SettingController::class, 'ajaxDeleteHadLaju']);
    Route::post('/ajaxRegisterHadLaju', [SettingController::class, 'ajaxRegisterHadLaju']);

    Route::get('/hari', [SettingController::class, 'hari']);
    Route::get('/getHariData', [SettingController::class, 'getHariData'])->name('getHariData');
    Route::get('/ajaxViewHari&id={id}', [SettingController::class, 'ajaxViewHari']);
    Route::post('/ajaxUpdateHari&id={id}', [SettingController::class, 'ajaxUpdateHari']);
    Route::post('/ajaxDeleteHari&id={id}', [SettingController::class, 'ajaxDeleteHari']);
    Route::post('/ajaxRegisterHari', [SettingController::class, 'ajaxRegisterHari']);

    Route::get('/jenisBahuJalan', [SettingController::class, 'jenisBahuJalan']);
    Route::get('/getJenisBahuJalanData', [SettingController::class, 'getJenisBahuJalanData'])->name('getJenisBahuJalanData');
    Route::get('/ajaxViewJenisBahuJalan&id={id}', [SettingController::class, 'ajaxViewJenisBahuJalan']);
    Route::post('/ajaxUpdateJenisBahuJalan&id={id}', [SettingController::class, 'ajaxUpdateJenisBahuJalan']);
    Route::post('/ajaxDeleteJenisBahuJalan&id={id}', [SettingController::class, 'ajaxDeleteJenisBahuJalan']);
    Route::post('/ajaxRegisterJenisBahuJalan', [SettingController::class, 'ajaxRegisterJenisBahuJalan']);

    Route::get('/jenisGaris', [SettingController::class, 'jenisGaris']);
    Route::get('/getJenisGarisData', [SettingController::class, 'getJenisGarisData'])->name('getJenisGarisData');
    Route::get('/ajaxViewJenisGaris&id={id}', [SettingController::class, 'ajaxViewJenisGaris']);
    Route::post('/ajaxUpdateJenisGaris&id={id}', [SettingController::class, 'ajaxUpdateJenisGaris']);
    Route::post('/ajaxDeleteJenisGaris&id={id}', [SettingController::class, 'ajaxDeleteJenisGaris']);
    Route::post('/ajaxRegisterJenisGaris', [SettingController::class, 'ajaxRegisterJenisGaris']);

    Route::get('/jenisJalan', [SettingController::class, 'jenisJalan']);
    Route::get('/getJenisJalanData', [SettingController::class, 'getJenisJalanData'])->name('getJenisJalanData');
    Route::get('/ajaxViewJenisJalan&id={id}', [SettingController::class, 'ajaxViewJenisJalan']);
    Route::post('/ajaxUpdateJenisJalan&id={id}', [SettingController::class, 'ajaxUpdateJenisJalan']);
    Route::post('/ajaxDeleteJenisJalan&id={id}', [SettingController::class, 'ajaxDeleteJenisJalan']);
    Route::post('/ajaxRegisterJenisJalan', [SettingController::class, 'ajaxRegisterJenisJalan']);

    Route::get('/jenisKawalan', [SettingController::class, 'jenisKawalan']);
    Route::get('/getJenisKawalanData', [SettingController::class, 'getJenisKawalanData'])->name('getJenisKawalanData');
    Route::get('/ajaxViewJenisKawalan&id={id}', [SettingController::class, 'ajaxViewJenisKawalan']);
    Route::post('/ajaxUpdateJenisKawalan&id={id}', [SettingController::class, 'ajaxUpdateJenisKawalan']);
    Route::post('/ajaxDeleteJenisKawalan&id={id}', [SettingController::class, 'ajaxDeleteJenisKawalan']);
    Route::post('/ajaxRegisterJenisKawalan', [SettingController::class, 'ajaxRegisterJenisKawalan']);

    Route::get('/jenisKawasan', [SettingController::class, 'jenisKawasan']);
    Route::get('/getJenisKawasanData', [SettingController::class, 'getJenisKawasanData'])->name('getJenisKawasanData');
    Route::get('/ajaxViewJenisKawasan&id={id}', [SettingController::class, 'ajaxViewJenisKawasan']);
    Route::post('/ajaxUpdateJenisKawasan&id={id}', [SettingController::class, 'ajaxUpdateJenisKawasan']);
    Route::post('/ajaxDeleteJenisKawasan&id={id}', [SettingController::class, 'ajaxDeleteJenisKawasan']);
    Route::post('/ajaxRegisterJenisKawasan', [SettingController::class, 'ajaxRegisterJenisKawasan']);

    Route::get('/jenisKemalangan', [SettingController::class, 'jenisKemalangan']);
    Route::get('/getJenisKemalanganData', [SettingController::class, 'getJenisKemalanganData'])->name('getJenisKemalanganData');
    Route::get('/ajaxViewJenisKemalangan&id={id}', [SettingController::class, 'ajaxViewJenisKemalangan']);
    Route::post('/ajaxUpdateJenisKemalangan&id={id}', [SettingController::class, 'ajaxUpdateJenisKemalangan']);
    Route::post('/ajaxDeleteJenisKemalangan&id={id}', [SettingController::class, 'ajaxDeleteJenisKemalangan']);
    Route::post('/ajaxRegisterJenisKemalangan', [SettingController::class, 'ajaxRegisterJenisKemalangan']);

    Route::get('/jenisLanggarPertama', [SettingController::class, 'jenisLanggarPertama']);
    Route::get('/getJenisLanggarPertamaData', [SettingController::class, 'getJenisLanggarPertamaData'])->name('getJenisLanggarPertamaData');
    Route::get('/ajaxViewJenisLanggarPertama&id={id}', [SettingController::class, 'ajaxViewJenisLanggarPertama']);
    Route::post('/ajaxUpdateJenisLanggarPertama&id={id}', [SettingController::class, 'ajaxUpdateJenisLanggarPertama']);
    Route::post('/ajaxDeleteJenisLanggarPertama&id={id}', [SettingController::class, 'ajaxDeleteJenisLanggarPertama']);
    Route::post('/ajaxRegisterJenisLanggarPertama', [SettingController::class, 'ajaxRegisterJenisLanggarPertama']);

    Route::get('/jenisPermukaan', [SettingController::class, 'jenisPermukaan']);
    Route::get('/getJenisPermukaanData', [SettingController::class, 'getJenisPermukaanData'])->name('getJenisPermukaanData');
    Route::get('/ajaxViewJenisPermukaan&id={id}', [SettingController::class, 'ajaxViewJenisPermukaan']);
    Route::post('/ajaxUpdateJenisPermukaan&id={id}', [SettingController::class, 'ajaxUpdateJenisPermukaan']);
    Route::post('/ajaxDeleteJenisPermukaan&id={id}', [SettingController::class, 'ajaxDeleteJenisPermukaan']);
    Route::post('/ajaxRegisterJenisPermukaan', [SettingController::class, 'ajaxRegisterJenisPermukaan']);

    Route::get('/jenisTempat', [SettingController::class, 'jenisTempat']);
    Route::get('/getJenisTempatData', [SettingController::class, 'getJenisTempatData'])->name('getJenisTempatData');
    Route::get('/ajaxViewJenisTempat&id={id}', [SettingController::class, 'ajaxViewJenisTempat']);
    Route::post('/ajaxUpdateJenisTempat&id={id}', [SettingController::class, 'ajaxUpdateJenisTempat']);
    Route::post('/ajaxDeleteJenisTempat&id={id}', [SettingController::class, 'ajaxDeleteJenisTempat']);
    Route::post('/ajaxRegisterJenisTempat', [SettingController::class, 'ajaxRegisterJenisTempat']);

    Route::get('/keadaanJalan', [SettingController::class, 'keadaanJalan']);
    Route::get('/getKeadaanJalanData', [SettingController::class, 'getKeadaanJalanData'])->name('getKeadaanJalanData');
    Route::get('/ajaxViewKeadaanJalan&id={id}', [SettingController::class, 'ajaxViewKeadaanJalan']);
    Route::post('/ajaxUpdateKeadaanJalan&id={id}', [SettingController::class, 'ajaxUpdateKeadaanJalan']);
    Route::post('/ajaxDeleteKeadaanJalan&id={id}', [SettingController::class, 'ajaxDeleteKeadaanJalan']);
    Route::post('/ajaxRegisterKeadaanJalan', [SettingController::class, 'ajaxRegisterKeadaanJalan']);

    Route::get('/kualitiPermukaan', [SettingController::class, 'kualitiPermukaan']);
    Route::get('/getKualitiPermukaanData', [SettingController::class, 'getKualitiPermukaanData'])->name('getKualitiPermukaanData');
    Route::get('/ajaxViewKualitiPermukaan&id={id}', [SettingController::class, 'ajaxViewKualitiPermukaan']);
    Route::post('/ajaxUpdateKualitiPermukaan&id={id}', [SettingController::class, 'ajaxUpdateKualitiPermukaan']);
    Route::post('/ajaxDeleteKualitiPermukaan&id={id}', [SettingController::class, 'ajaxDeleteKualitiPermukaan']);
    Route::post('/ajaxRegisterKualitiPermukaan', [SettingController::class, 'ajaxRegisterKualitiPermukaan']);

    Route::get('/langgarLari', [SettingController::class, 'langgarLari']);
    Route::get('/getLanggarLariData', [SettingController::class, 'getLanggarLariData'])->name('getLanggarLariData');
    Route::get('/ajaxViewLanggarLari&id={id}', [SettingController::class, 'ajaxViewLanggarLari']);
    Route::post('/ajaxUpdateLanggarLari&id={id}', [SettingController::class, 'ajaxUpdateLanggarLari']);
    Route::post('/ajaxDeleteLanggarLari&id={id}', [SettingController::class, 'ajaxDeleteLanggarLari']);
    Route::post('/ajaxRegisterLanggarLari', [SettingController::class, 'ajaxRegisterLanggarLari']);

    Route::get('/mukaJalan', [SettingController::class, 'mukaJalan']);
    Route::get('/getMukaJalanData', [SettingController::class, 'getMukaJalanData'])->name('getMukaJalanData');
    Route::get('/ajaxViewMukaJalan&id={id}', [SettingController::class, 'ajaxViewMukaJalan']);
    Route::post('/ajaxUpdateMukaJalan&id={id}', [SettingController::class, 'ajaxUpdateMukaJalan']);
    Route::post('/ajaxDeleteMukaJalan&id={id}', [SettingController::class, 'ajaxDeleteMukaJalan']);
    Route::post('/ajaxRegisterMukaJalan', [SettingController::class, 'ajaxRegisterMukaJalan']);

    Route::get('/negeri', [SettingController::class, 'negeri']);
    Route::get('/getNegeriData', [SettingController::class, 'getNegeriData'])->name('getNegeriData');
    Route::get('/ajaxViewNegeri&id={id}', [SettingController::class, 'ajaxViewNegeri']);
    Route::post('/ajaxUpdateNegeri&id={id}', [SettingController::class, 'ajaxUpdateNegeri']);
    Route::post('/ajaxDeleteNegeri&id={id}', [SettingController::class, 'ajaxDeleteNegeri']);
    Route::post('/ajaxRegisterNegeri', [SettingController::class, 'ajaxRegisterNegeri']);

    Route::get('/sebabBinatang', [SettingController::class, 'sebabBinatang']);
    Route::get('/getSebabBinatangData', [SettingController::class, 'getSebabBinatangData'])->name('getSebabBinatangData');
    Route::get('/ajaxViewSebabBinatang&id={id}', [SettingController::class, 'ajaxViewSebabBinatang']);
    Route::post('/ajaxUpdateSebabBinatang&id={id}', [SettingController::class, 'ajaxUpdateSebabBinatang']);
    Route::post('/ajaxDeleteSebabBinatang&id={id}', [SettingController::class, 'ajaxDeleteSebabBinatang']);
    Route::post('/ajaxRegisterSebabBinatang', [SettingController::class, 'ajaxRegisterSebabBinatang']);

    Route::get('/sebabCacatJalan', [SettingController::class, 'sebabCacatJalan']);
    Route::get('/getSebabCacatJalanData', [SettingController::class, 'getSebabCacatJalanData'])->name('getSebabCacatJalanData');
    Route::get('/ajaxViewSebabCacatJalan&id={id}', [SettingController::class, 'ajaxViewSebabCacatJalan']);
    Route::post('/ajaxUpdateSebabCacatJalan&id={id}', [SettingController::class, 'ajaxUpdateSebabCacatJalan']);
    Route::post('/ajaxDeleteSebabCacatJalan&id={id}', [SettingController::class, 'ajaxDeleteSebabCacatJalan']);
    Route::post('/ajaxRegisterSebabCacatJalan', [SettingController::class, 'ajaxRegisterSebabCacatJalan']);

    Route::get('/sistemLaluan', [SettingController::class, 'sistemLaluan']);
    Route::get('/getSistemLaluanData', [SettingController::class, 'getSistemLaluanData'])->name('getSistemLaluanData');
    Route::get('/ajaxViewSistemLaluan&id={id}', [SettingController::class, 'ajaxViewSistemLaluan']);
    Route::post('/ajaxUpdateSistemLaluan&id={id}', [SettingController::class, 'ajaxUpdateSistemLaluan']);
    Route::post('/ajaxDeleteSistemLaluan&id={id}', [SettingController::class, 'ajaxDeleteSistemLaluan']);
    Route::post('/ajaxRegisterSistemLaluan', [SettingController::class, 'ajaxRegisterSistemLaluan']);

    Route::get('/audit', [AuditController::class, 'audit']);
    Route::get('/getAuditData', [AuditController::class, 'getAuditData'])->name('getAuditData');

    Route::get('/userAccess', function () {
        return view('site.useraccess');
    });
});
