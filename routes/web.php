<?php

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Wakel;
use App\Models\contoh;
use App\Models\Jadwal;
use App\Models\Presensi; 
use App\Models\Semester;
use App\Models\Pelajaran;
use App\Http\Controllers\Login;
use App\Http\Middleware\CekRole;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController; 
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WakelController;
use App\Http\Controllers\ContohController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\PelajaranController;
use App\Http\Controllers\UserController;

//contoh role level user
Route::group(['middleware' => ['auth', CekRole::class.':admin']], function() {
    Route::get('/pegawai', [ContohController::class, 'index'])->name('pegawai');
    //tambah data
    Route::get('/tambahpegawai',[ContohController::class, 'tambahpegawai'])->name('tambahpegawai')->middleware('auth');
    Route::post('/insertdata',[ContohController::class, 'insertdata'])->name('insertdata')->middleware('auth');
    //update data
    Route::get('/tampildata/{id}',[ContohController::class, 'tampildata'])->name('tampildata')->middleware('auth');
    Route::post('/updatedata/{id}',[ContohController::class, 'updatedata'])->name('updatedata')->middleware('auth');
    //delete data
    Route::get('/delete/{id}',[ContohController::class, 'delete'])->name('delete')->middleware('auth');
    //export pdf
    Route::get('/exportpdf',[ContohController::class, 'exportpdf'])->name('exportpdf')->middleware('auth');
    //export excel
    Route::get('/exportexcel',[ContohController::class, 'exportexcel'])->name('exportexcel')->middleware('auth');
    //
    Route::get('/guru',[GuruController::class, 'index'])->name('guru')->middleware('auth');
    Route::get('/tambahguru',[GuruController::class, 'tambahguru'])->name('tambahguru')->middleware('auth');
    Route::post('/insertguru',[GuruController::class, 'insertguru'])->name('insertguru')->middleware('auth');
    Route::get('/deleteguru/{id}',[GuruController::class, 'deleteguru'])->name('deleteguru')->middleware('auth');
    Route::get('/tampilguru/{id}',[GuruController::class, 'tampilguru'])->name('tampilguru')->middleware('auth');
    Route::post('/updateguru/{id}',[GuruController::class, 'updateguru'])->name('updateguru')->middleware('auth');
    Route::get('/gurupdf',[GuruController::class, 'gurupdf'])->name('gurupdf')->middleware('auth');
    //wakel
    Route::get('/wakel',[WakelController::class, 'index'])->name('wakel')->middleware('auth');
    Route::get('/tambahwakel',[WakelController::class, 'tambahwakel'])->name('tambahwakel')->middleware('auth');
    Route::post('/insertwakel',[WakelController::class, 'insertwakel'])->name('insertwakel')->middleware('auth');
    Route::get('/deletewakel/{id}',[WakelController::class, 'deletewakel'])->name('deletewakel')->middleware('auth');
    Route::get('/tampilwakel/{id}',[WakelController::class, 'tampilwakel'])->name('tampilwakel')->middleware('auth');
    Route::post('/updatewakel/{id}',[WakelController::class, 'updatewakel'])->name('updatewakel')->middleware('auth');
    Route::get('/wakelpdf',[WakelController::class, 'wakelpdf'])->name('wakelpdf')->middleware('auth');

    //
    Route::get('/kelas',[KelasController::class, 'index'])->name('kelas')->middleware('auth');
    Route::get('/tambahkelas',[KelasController::class, 'tambahkelas'])->name('tambahkelas')->middleware('auth');
    Route::post('/insertkelas',[KelasController::class, 'insertkelas'])->name('insertkelas')->middleware('auth');
    Route::get('/deletekelas/{id}',[KelasController::class, 'deletekelas'])->name('deletekelas')->middleware('auth');
    Route::get('/tampilkelas/{id}',[KelasController::class, 'tampilkelas'])->name('tampilkelas')->middleware('auth');
    Route::post('/updatekelas/{id}',[KelasController::class, 'updatekelas'])->name('updatekelas')->middleware('auth');
    Route::get('/kelaspdf',[KelasController::class, 'kelaspdf'])->name('kelaspdf')->middleware('auth');

    //
    Route::get('/pelajaran',[PelajaranController::class, 'index'])->name('pelajaran')->middleware('auth');
    Route::get('/tambahpelajaran',[PelajaranController::class, 'tambahpelajaran'])->name('tambahpelajaran')->middleware('auth');
    Route::post('/insertpelajaran',[PelajaranController::class, 'insertpelajaran'])->name('insertpelajaran')->middleware('auth');
    Route::get('/deletepelajaran/{id}',[PelajaranController::class, 'deletepelajaran'])->name('deletepelajaran')->middleware('auth');
    Route::get('/tampilpelajaran/{id}',[PelajaranController::class, 'tampilpelajaran'])->name('tampilpelajaran')->middleware('auth');
    Route::post('/updatepelajaran/{id}',[PelajaranController::class, 'updatepelajaran'])->name('updatepelajaran')->middleware('auth');
    Route::get('/pelajaranpdf',[PelajaranController::class, 'pelajaranpdf'])->name('pelajaranpdf')->middleware('auth');


    //
    Route::get('/jadwal',[JadwalController::class, 'index'])->name('jadwal')->middleware('auth');
    Route::get('/tambahjadwal',[JadwalController::class, 'tambahjadwal'])->name('tambahjadwal')->middleware('auth');
    Route::post('/insertjadwal',[JadwalController::class, 'insertjadwal'])->name('insertjadwal')->middleware('auth');
    Route::get('/deletejadwal/{id}',[JadwalController::class, 'deletejadwal'])->name('deletejadwal')->middleware('auth');
    Route::get('/tampiljadwal/{id}',[JadwalController::class, 'tampiljadwal'])->name('tampiljadwal')->middleware('auth');
    Route::post('/updatejadwal/{id}',[JadwalController::class, 'updatejadwal'])->name('updatejadwal')->middleware('auth');
    Route::get('/jadwalpdf',[JadwalController::class, 'jadwalpdf'])->name('jadwalpdf')->middleware('auth');

    //
    Route::get('/semester',[SemesterController::class, 'index'])->name('semester')->middleware('auth');
    Route::get('/tambahsemester',[SemesterController::class, 'tambahsemester'])->name('tambahsemester')->middleware('auth');
    Route::post('/insertsemester',[SemesterController::class, 'insertsemester'])->name('insertsemester')->middleware('auth');
    Route::get('/deletesemester/{id}',[SemesterController::class, 'deletesemester'])->name('deletesemester')->middleware('auth');
    Route::post('/updatesemester/{id}',[SemesterController::class, 'updatesemester'])->name('updatesemester')->middleware('auth');
    Route::get('/tampilsemester/{id}',[SemesterController::class, 'tampilsemester'])->name('tampilsemester')->middleware('auth');
    //
    Route::get('/user',[UserController::class, 'index'])->name('user')->middleware('auth');
    Route::get('/tambahuser',[UserController::class, 'tambahuser'])->name('tambahuser')->middleware('auth');
    Route::post('/insertuser',[UserController::class, 'insertuser'])->name('insertuser')->middleware('auth');
    Route::get('/deleteuser/{id}',[UserController::class, 'deleteuser'])->name('deleteuser')->middleware('auth');
    Route::post('/updateuser/{id}',[UserController::class, 'updateuser'])->name('updateuser')->middleware('auth');
    Route::get('/tampiluser/{id}',[UserController::class, 'tampiluser'])->name('tampiluser')->middleware('auth');


    Route::get('/deletepresensi/{id}',[PresensiController::class, 'deletepresensi'])->name('deletepresensi')->middleware('auth');

    
});


Route::group(['middleware' => ['auth', CekRole::class.':admin,guru']], function() {
    Route::get('/', function () {
        $person = contoh::count();
        $personcowok = contoh::where('jeniskelamin', 'cowok')->count();
        $personcewek = contoh::where('jeniskelamin', 'cewek')->count();
        $personguru = Guru::count();
        return view('welcome', compact('person', 'personcowok', 'personcewek', 'personguru'));
    });
    //tampilan depan
    //
    Route::get('/presensi',[PresensiController::class, 'index'])->name('presensi')->middleware('auth');
    Route::get('/tambahpresensi',[PresensiController::class, 'tambahpresensi'])->name('tambahpresensi')->middleware('auth');
    Route::post('/insertpresensi',[PresensiController::class, 'insertpresensi'])->name('insertpresensi')->middleware('auth');
    Route::get('/tampilpresensi/{id}',[PresensiController::class, 'tampilpresensi'])->name('tampilpresensi')->middleware('auth');
    Route::post('/deletepresensi/{id}',[PresensiController::class, 'deletepresensi'])->name('deletepresensi')->middleware('auth');
    Route::get('/updatepresensi/{id}',[PresensiController::class, 'updatepresensi'])->name('updatepresensi')->middleware('auth');
    //
    Route::get('/rekap',[PresensiController::class, 'rekap'])->name('rekap')->middleware('auth');
    Route::get('/rekappdf',[PresensiController::class, 'rekappdf'])->name('rekappdf')->middleware('auth');
    Route::get('/rekapexcel',[PresensiController::class, 'rekapexcel'])->name('rekapexcel')->middleware('auth');

});
//
Route::get('/login',[LoginController::class, 'login'])->name('login');
Route::post('/loginuser',[LoginController::class, 'loginuser'])->name('loginuser');
Route::get('/register',[LoginController::class, 'register'])->name('register');
Route::post('/registeruser',[LoginController::class, 'registeruser'])->name('registeruser');
Route::get('/logout',[LoginController::class, 'logout'])->name('logout')->middleware('auth');