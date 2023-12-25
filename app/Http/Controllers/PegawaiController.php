<?php

namespace App\Http\Controllers;

use App\Helpers\ConstantsHelper;
use App\Helpers\ResponseHelpers;
use App\Models\Pegawai;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{
    public function index()
    {
    }

    public function getDataPegawai(Request $request)
    {
        $id = $request->get('id');
        $nama_pegawai = $request->get('nama_pegawai');
        $no_telp = $request->get('no_telp');
        $email = $request->get('email');
        $nik = $request->get('nik');
        $sort = $request->get('sort');
        $isPage = $request->get('is_page');

        try {
            $model = new Pegawai();
            $query = $model->select(
                'id',
                'nama_pegawai',
                'no_telp',
                'email',
                'nik',
                'alamat',
                'is_active'
            );
            if (isset($id)) {
                $query->where('id', $id);
            }

            $query = $query->get();
            return ResponseHelpers::success(ConstantsHelper::STATUS_SUCCESS, ConstantsHelper::MSG_SUCCESS_GET, $query);
        } catch (\Exception $e) {
            return ResponseHelpers::error(ConstantsHelper::STATUS_ERR_SERVER, ConstantsHelper::MSG_ERR_SERVER, $e);
        }
    }

    public function saveDataPegawai(Request $request)
    {

        $id = $request->post('id');
        $nama_pegawai = $request->post('nama_pegawai');
        $no_telp = $request->post('no_telp');
        $email = $request->post('email');
        $nik = $request->post('nik');
        $tgl_lahir = $request->post('tgl_lahir');
        $alamat = $request->post('alamat');
        $is_active = $request->post('is_active');

        try {
            $model = new Pegawai();
            if (isset($id)) {
                $query = $model->find($id);
                if ($query == null) {
                    return ResponseHelpers::error(ConstantsHelper::STATUS_ERR_VALIDATION, ConstantsHelper::MSG_ERR_SAVE, false);
                }
                $model = $model->find($id);
            }
            $model->nama_pegawai = $nama_pegawai;
            $model->no_telp = $no_telp;
            $model->email = $email;
            $model->nik = $nik;
            $model->tgl_lahir = $tgl_lahir;
            $model->alamat = $alamat;
            $model->is_active = $is_active;
            if ($model->validate()->save()) {
                return ResponseHelpers::success(ConstantsHelper::STATUS_SUCCESS, ConstantsHelper::MSG_SUCCESS_SAVE, true);
            } else {
                return ResponseHelpers::error(ConstantsHelper::STATUS_ERR_VALIDATION, ConstantsHelper::MSG_ERR_SAVE, false);
            }
        } catch (\Exception $e) {
            return ResponseHelpers::error(ConstantsHelper::STATUS_ERR_VALIDATION, ConstantsHelper::MSG_ERR_VALIDATION);
        } catch (\Exception $e) {
            return ResponseHelpers::error(ConstantsHelper::STATUS_ERR_SERVER, ConstantsHelper::MSG_ERR_SERVER, $e);
        }
    }

    public function deleteDataPegawai(Request $request)
    {

        $id = $request->get('id');
        try {
            $model = new Pegawai();
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

        } catch (\Exception $e) {
            return ResponseHelpers::error(ConstantsHelper::STATUS_ERR_SERVER, ConstantsHelper::MSG_ERR_SERVER, $e);
        }

    }
}
