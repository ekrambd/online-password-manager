<?php
 
 function user()
 {
 	$user = auth()->user();
 	return $user;
 }


 function userRepository()
 {
 	$userRepository = app(\App\Repositories\User\UserRepository::class);
 	return $userRepository;
 }

 function users()
 {  
 	$users = UserRepository()->fetch()->where('status','Active')->where('role_id',2)->latest()->get();
 	return $users;
 }

 function groupRepository()
 {
 	$groupRepository = app(\App\Repositories\Group\GroupRepository::class);
 	return $groupRepository;
 }

 function groups()
 {  
 	$groups = GroupRepository()->fetch()->where('user_id',user()->id)->where('status','Active')->latest()->get();
 	return $groups;
 }

 function userGroups($group)
 {
 	 $group = GroupRepository()->fetch()->find($group->id); 
     $usersInGroup = $group->users()->pluck('users.id')->toArray();
     return $usersInGroup;
 }