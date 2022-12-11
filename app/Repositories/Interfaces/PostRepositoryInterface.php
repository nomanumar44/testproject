<?php

namespace App\Repositories\Interfaces;

Interface PostRepositoryInterface{
       public function index();
       public function createpost($data);
       public function editpost($id);
       public function deletepost($id);
       public function updatepost($id,$data);
}

?>
