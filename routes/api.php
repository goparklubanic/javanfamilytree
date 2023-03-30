<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
// use app\Models\Keluarga;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('keluarga', function(){
    // SELECT a.id , a.generasiKe , (SELECT b.nama FROM keluarga b WHERE id=a.parentId) orangtua , a.urutKe , a.nama, jnKelamin FROM keluarga a ORDER BY generasiKe , parentId, urutKe;
        
    $klg = DB::select("SELECT a.id , a.generasiKe , a.parentId , (SELECT b.nama FROM keluarga b WHERE id=a.parentId) orangtua , a.urutKe , a.nama, jnKelamin FROM keluarga a ORDER BY generasiKe , parentId, urutKe");
    return response()->json(['klg'=>$klg]);
});

Route::get('anak/{anak}/{klm?}',function($anak,$klm='all'){
    // echo "Anaknya - " . $anak;
    if($klm == 'L' || $klm == "P"){
        $jnkel = $klm == "L" ? "Laki-laki" : "Perempuan";
        $klg = DB::select("SELECT * FROM keluarga WHERE parentId = (SELECT id FROM keluarga WHERE nama='$anak') && jnKelamin='$jnkel'");
    }else{
        $klg = DB::select("SELECT * FROM keluarga WHERE parentId = (SELECT id FROM keluarga WHERE nama='$anak')");
    }
    return response()->json(['klg'=>$klg]);

});

Route::get('cucu/{anak}/{klm?}',function($anak,$klm='all'){
    // echo "Cucunya - " . $anak;
    if($klm == "L" || $klm == "P"){
        $jnk = $klm == "L" ? "Laki-laki" : "Perempuan";
        $klg = DB::select("SELECT * FROM keluarga WHERE generasiKe = (SELECT (generasiKe + 2) FROM keluarga WHERE nama='$anak') && jnKelamin ='$jnk'");
    }else{
        $klg = DB::select("SELECT * FROM keluarga WHERE generasiKe = (SELECT (generasiKe + 2) FROM keluarga WHERE nama='$anak')");
    }
    return response()->json(['klg'=>$klg]);
});

Route::get('bibi/{anak}',function($anak){
    // echo "Bibinya - " . $anak;
    // $klg = DB::select("SELECT * FROM keluarga WHERE generasiKe = (SELECT generasiKe-1 FROM keluarga WHERE nama='$anak') && id != (SELECT parentId  FROM keluarga WHERE nama='$anak') && urutKe > (SELECT urutKe FROM keluarga WHERE id=(SELECT parentId FROM keluarga WHERE nama ='$anak')) && jnKelamin  = 'Perempuan'");
    $klg = DB::select("SELECT * FROM keluarga WHERE generasiKe = (SELECT generasiKe-1 FROM keluarga WHERE nama='$anak') && id != (SELECT parentId  FROM keluarga WHERE nama='$anak') && jnKelamin  = 'Perempuan'");
    return response()->json(['klg'=>$klg]);
});

Route::get('paman/{anak}',function($anak){
    // echo "Pamannya - " . $anak;
    // $klg = DB::select("SELECT * FROM keluarga WHERE generasiKe = (SELECT generasiKe-1 FROM keluarga WHERE nama='$anak') && id != (SELECT parentId  FROM keluarga WHERE nama='$anak') && urutKe > (SELECT urutKe FROM keluarga WHERE id=(SELECT parentId FROM keluarga WHERE nama ='$anak')) && jnKelamin  = 'Laki-laki'");
    $klg = DB::select("SELECT * FROM keluarga WHERE generasiKe = (SELECT generasiKe-1 FROM keluarga WHERE nama='$anak') && id != (SELECT parentId  FROM keluarga WHERE nama='$anak') && jnKelamin  = 'Laki-laki'");
    return response()->json(['klg'=>$klg]);
});

Route::get('sepupu/{anak}/{klm?}',function($anak,$klm='all'){
    // echo "Pamannya - " . $anak;
    if( $klm == "L" || $klm == "P"){
        $jnKelamin = $klm == "P" ? "Perempuan" : "Laki-laki";
        $klg = DB::select("SELECT * FROM keluarga WHERE generasiKe = (SELECT generasiKe FROM keluarga WHERE nama='$anak') &&
            parentId != (SELECT parentId FROM keluarga WHERE nama='$anak') && jnKelamin = '$jnKelamin'");
    }else{
        $klg = DB::select("SELECT * FROM keluarga WHERE generasiKe = (SELECT generasiKe FROM keluarga WHERE nama='$anak') &&parentId != (SELECT parentId FROM keluarga WHERE nama='$anak')");
    }
    
    return response()->json(['klg'=>$klg]);
});

