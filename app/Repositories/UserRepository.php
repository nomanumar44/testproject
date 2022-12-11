<?php
namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
class UserRespository implements UserRepositoryInterface {

    public function find($name)
    {
        $user = User::where('name',$name)->first();
        return $user;
    }

}
?>
