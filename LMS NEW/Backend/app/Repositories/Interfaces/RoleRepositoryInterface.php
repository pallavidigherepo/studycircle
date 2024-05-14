<?php
namespace App\Repositories\Interfaces;

Interface RoleRepositoryInterface {

    public function all($request);

    public function create($data);

    public function edit($role);

    public function update($data, $role);

    public function delete($role);

}