<?php
namespace App\Repositories;

use App\Entities\PasswordReset;
use App\Entities\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthenticationRepository
{
    protected $password;
    protected $user;

    public function __construct(User $user, PasswordReset $password)
    {
        $this->password = $password;
        $this->user = $user;
    }

    public function register($request)
    {
        DB::beginTransaction();

        try {
            $user = $this->user->create($request);
            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function findUserByEmail($request)
    {
        $user = $this->user->where('email', $request->email)->first();
        return $user;
    }

    public function createToken($request)
    {
        $user = $this->findUserByEmail($request);

        $this->deleteTokens($user);

        $newToken = strtolower(Str::random(64));

        $token = $this->password->insert([
            'email' => $user->email,
            'token' => $newToken,
            'created_at' => Carbon::now(),
        ]);

        $data = [
            'token' => $newToken,
            'user' => $user
        ];

        return $data;
    }

    public function resetPassword($request)
    {
        $user = $this->findUserByEmail($request);
        $user->update([
            'password' => Hash::make($request->password)
        ]);
        $this->deleteTokens($user);
        return $user;
    }

    public function deleteTokens($user)
    {
        $this->password->where('email', $user->email)->delete();
    }
}
