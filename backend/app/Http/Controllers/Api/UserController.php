<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Helpers\UserHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\UpdatePasswordRequest;
use App\Http\Requests\User\UpdateRequest;

class UserController extends Controller
{
    private $userHelper;
    public function __construct()
    {
        $this->userHelper = new UserHelper();
    }

    /**
     * @method getAll
     * Mengambil semua data dari tabel user
     * @return json
     */
    public function getAll()
    {
        return response()->json([
            'status'    => true,
            'data'      => User::all(),
            'message'   => 'Berhasil mendapatkan data'
        ]);
    }

    public function index()
    {
        return response()->json([
            'status'    => true,
            'data'      => 'test',
            'message'   => 'Berhasil mendapatkan data'
        ]);
    }

    public function show($id)
    {
        try {
            return response()->json([
                'status' => true,
                'data'   => User::findOrFail($id),
                'message' => 'Berhasil mendapatkan data'
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 422);
        }
    }

    public function store(CreateRequest $request)
    {
        /**
         * Cek validasi
         */
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $request->validator->errors()
            ], 422);
        }

        $payload =  $request->only([
            'name',
            'email',
            'password'
        ]);

        return $this->userHelper->create($payload);
    }

    public function update(UpdateRequest $request)
    {
        /**
         * Cek validasi
         */
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $request->validator->errors()
            ], 422);
        }

        $payload = $request->only([
            'id',
            'name',
            'email',
            'rule'
        ]);

        return $this->userHelper->update($payload);
    }

    public function delete($id)
    {
        try {
            User::findOrFail($id)->delete();
            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus data'
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'status'    => false,
                'message'   => $th->getMessage()
            ]);
        }
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        /**
         * Cek validasi
         */
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $request->validator->errors()
            ], 422);
        }

        $payload = $request->only([
            'password',
            'current_password',
            'id'
        ]);
        return $this->userHelper->updatePassword($payload);
    }
}
