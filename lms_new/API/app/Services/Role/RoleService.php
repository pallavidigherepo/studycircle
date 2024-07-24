<?php
namespace App\Services\Role;

use App\Http\Requests\RoleRequest;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use Spatie\Permission\Models\Role;

class RoleService
{

    public function __construct(protected RoleRepositoryInterface $roleRepository) { }

    public function all($request)
    {
        return $this->roleRepository->all($request);
    }


    public function create(StoreRoleRequest $request): mixed
    {
        if (!$request->validated()) {
            return false;
        }

        return $this->roleRepository->create($request);
    }

    public function edit(Role $role): mixed
    {
        if (!$role) {
            return false;
        }
        return $this->roleRepository->edit($role);
    }

    public function update(UpdateRoleRequest $request, $role)
    {
        if (!$request->validated()) {
            return false;
        }

        return $this->roleRepository->update($request, $role);
    }

    public function delete(Role $role): mixed
    {
        if (!$role) {
            return false;
        }
        return $this->roleRepository->delete($role);
    }
}
