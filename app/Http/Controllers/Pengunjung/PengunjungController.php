<?php

namespace App\Http\Controllers\Pengunjung;

use App\Helpers\ConstantsHelper;
use App\Helpers\ResponseHelpers;
use App\Http\Controllers\Controller;
use App\Models\Pengunjung;
use Exception;
use Illuminate\Http\Request;

class PengunjungController extends Controller
{
    public function index(){

    }

    public function getPengunjung (Request $request) {
        $id = $request->get('id');
        try {
            $model = new Pengunjung();
            $query = $model->select(
                'id',
                'nama_pengunjung',
                'no_telp',
                'email',
                'nik',
                'alamat',
                'is_active'
            );
            if (isset($id)){
                $query->where('id', $id);
            }
            $query->where('is_deleted', false);
            $query = $query->get();
            return ResponseHelpers::success(ConstantsHelper::STATUS_SUCCESS, ConstantsHelper::MSG_SUCCESS_GET, $query);
        } catch (\Exception $e) {
            return ResponseHelpers::error(ConstantsHelper::STATUS_ERR_SERVER, ConstantsHelper::MSG_ERR_SERVER, $e);
        }
    }

    public function savePengunjung(Request $request){
        $id = $request->post('id');
        $nama_pengunjung = $request->post('nama_pengunjung');
        $no_telp = $request->post('no_telp');
        $email = $request->post('email');
        $nik = $request->post('nik');
        $tgl_lahir = $request->post('tgl_lahir');
        $alamat = $request->post('alamat');
        $is_active = $request->post('is_active');

        try {
            $model = new Pengunjung();

            if (isset($id)) {
                $query = $model->find($id);
                if ($query == null) {
                    return ResponseHelpers::error(ConstantsHelper::STATUS_ERR_VALIDATION, ConstantsHelper::MSG_ERR_SAVE);
                }
                $model = $model->find($id);
            }
            $model->nama_pengunjung = $nama_pengunjung;
            $model->no_telp = $no_telp;
            $model->email = $email;
            $model->nik = $nik;
            $model->tgl_lahir = $tgl_lahir;
            $model->alamat = $alamat;
            $model->is_active = $is_active;

            if($model->validate()->save()){
                return ResponseHelpers::success(ConstantsHelper::STATUS_SUCCESS, ConstantsHelper::MSG_SUCCESS_SAVE, true);
            } else {
                return ResponseHelpers::error(ConstantsHelper::STATUS_ERR_VALIDATION, ConstantsHelper::MSG_ERR_SAVE, false);
            }

        } catch (\Exception $e) {
            return ResponseHelpers::error(ConstantsHelper::STATUS_ERR_VALIDATION, ConstantsHelper::MSG_ERR_VALIDATION, $e);
        } catch (\Exception $e) {
            return ResponseHelpers::error(ConstantsHelper::STATUS_ERR_SERVER, ConstantsHelper::MSG_ERR_SERVER, $e);
        }
    }

    public function deletePengunjung(Request $request)
    {

        $id = $request->get('id');
        try{
            $model =  new Pengunjung();
            if($model->find($id) == null){
                return ResponseHelpers::error(ConstantsHelper::STATUS_ERR_VALIDATION, 'Data tidak ditemukan!', false);
            }
            $model = $model->find($id);
            $model->is_deleted = true;
            if ($model->save()) {
                return ResponseHelpers::success(ConstantsHelper::STATUS_SUCCESS, ConstantsHelper::MSG_SUCCESS_DELETE, true);
            } else {
                return ResponseHelpers::error(ConstantsHelper::STATUS_ERR_VALIDATION, ConstantsHelper::MSG_ERR_DELETE, false);
            }

        }catch (\Exception $e) {
            return ResponseHelpers::error(ConstantsHelper::STATUS_ERR_SERVER, ConstantsHelper::MSG_ERR_SERVER, $e);
        }
    }
}
