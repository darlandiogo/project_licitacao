<?php

namespace App\Repositories;
Interface Repository{

    public function all($params);
    public function getById($id);
    public function create($input);
    public function edit($input,$id);
    public function delete($input);

}