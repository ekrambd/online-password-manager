<?php
 namespace App\Repositories\Password;

 interface PasswordInterface
 {
 	public function fetch();
 	public function store($request);
 	public function update($request,$password);
 	public function delete($password);
 	public function statusUpdate($request);
	public function showPassword($id);
 }