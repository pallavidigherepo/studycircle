<?php
namespace App\Repositories\Interfaces;

Interface CourseTypeRepositoryInterface {

    public function all($request);

    public function create($data);

    public function show($data);

    public function update($data, $course);

    public function delete($course);

    public function list();

}