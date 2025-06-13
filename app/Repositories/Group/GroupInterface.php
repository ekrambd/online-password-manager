<?php
 namespace App\Repositories\Group;

 interface GroupInterface
 {
 	public function fetch();
 	public function store($request);
 	public function update($request,$group);
 	public function delete($group);
 	public function statusUpdate($request);
 }