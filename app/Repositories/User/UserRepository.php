<?php
 namespace App\Repositories\User;
 use App\Models\User;

 class UserRepository implements UserInterface
 {
 	public function fetch()
 	{
 		try
 		{
 			$users = User::query();
 			return $users;
 		}catch(Exception $e){
 			return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
 		}
 	}

 	public function store($request)
 	{
 		try
 		{
 			$user = User::create([
 				'role_id' => 2,
 				'name' => $request->name,
 				'email' => $request->email,
 				'password' => bcrypt('123456'),
 				'status' => $request->status,
 			]);
 			return response()->json(['status'=>true, 'user_id'=>intval($user->id), 'message'=>'Successfully an user has been added']);
 		}catch(Exception $e){
 			return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
 		}
 	}

 	public function update($request,$user)
 	{
 		try
 		{
 			$user->name = $request->name;
 			$user->email = $request->email;
 			$user->status = $request->status;
 			$user->update();
 			return response()->json(['status'=>true, 'user_id'=>intval($user->id), 'message'=>'Successfully the user has been updated']);
 		}catch(Exception $e){
 			return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
 		}
 	}

 	public function statusUpdate($request)
 	{
 		try
 		{
 			$user = $this->fetch()->findorfail($request->user_id);
 			$user->status = $request->status;
 			$user->update();
 			return response()->json(['status'=>true, 'message'=>"Successfully the user's status has been updated"]);
 		}catch(Exception $e){
 			return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
 		}
 	}

 	public function delete($user)
 	{
 		try
 		{
 			$user->delete();
 			return response()->json(['status'=>true, 'message'=>'Successfully the user has been deleted']);
 		}catch(Exception $e){
 			return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
 		}
 	}
 }