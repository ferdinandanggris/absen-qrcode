<?php

namespace App\Helpers;

use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;

class UserHelper
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function create($payload)
    {
        try {
            // encrypt password
            if ($payload['password']) {
                $payload['password'] = bcrypt($payload['password']);
            }

            $response = $this->userModel->create($payload);
            return [
                'status'    => true,
                'message'   => 'Berhasil menambahkan data',
                'data'      => $response
            ];
        } catch (\Throwable $th) {
            //throw $th;
            return [
                'status'    => false,
                'message'   => $th->getMessage()
            ];
        }
    }

    public function update($payload)
    {
        try {
            $response = $this->userModel->find($payload['id'])->update($payload);
            if ($response) {
                return [
                    'status'    => true,
                    'message'   => 'Berhasil mengubah data',
                ];
            } else {
                throw new Exception("Gagal Mengupdate data!", 1);
            }
        } catch (\Throwable $th) {
            return [
                'status'    => false,
                'message'   => $th->getMessage(),
            ];
        }
    }

    public function updatePassword($payload)
    {
        try {
            $oldPassword = $this->userModel->findOrFail($payload['id'])->password;
            if (password_verify($payload['current_password'], $oldPassword)) {
                $response = $this->userModel->findOrFail($payload['id'])->update(['password' => bcrypt($payload['password'])]);
                if ($response) {
                    return [
                        'status' => true,
                        'message' => 'password berhasil diubah'
                    ];
                } else {
                    throw new Exception("Gagal mengubah password", 1);
                }
            } else {
                return [
                    'status'    => false,
                    'message'   => ['current_password' => 'Your current password does not match with our record']
                ];
            }
        } catch (\Throwable $th) {
            //throw $th;
            return [
                'status'    => false,
                'message'   => $th->getMessage()
            ];
        }
    }
}
