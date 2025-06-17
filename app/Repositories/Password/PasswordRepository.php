<?php
 namespace App\Repositories\Password;
 use App\Models\Password;
 use Illuminate\Support\Facades\Crypt;

 class PasswordRepository implements PasswordInterface
 {
 	public function fetch()
 	{
 		try
 		{
 			$passwords = Password::query();
 			return $passwords;
 		}catch(Exception $e){
 			return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
 		}
 	}

 	public function store($request)
 	{
 		try
 		{
 			$password = Password::create([
 				'user_id' => user()->id,
 				'title' => $request->title,
 				'group_id' => $request->group_id,
 				'category_id' => $request->category_id,
 				'password' => Crypt::encryptString($request->password),
 				'remarks' => $request->remarks,
 				'status' => $request->status,
 			]);
 			return response()->json(['status'=>true, 'password_id'=>intval($password->id), 'message'=>'Successfully a password has been added']);
 		}catch(Exception $e){
 			return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
 		}
 	}

 	public function update($request,$password)
 	{
 		try
 		{
 			$password->title = $request->title;
 			$password->group_id = $request->group_id;
 			$password->category_id = $request->category_id;
 			$password->password = Crypt::encryptString($request->password);
 			$password->remarks = $request->remarks;
 			$password->status = $request->status;
 			$password->update();
 			return response()->json(['status'=>true, 'password_id'=>intval($password->id), 'message'=>'Successfully the password has been updated']);
 		}catch(Exception $e){
 			return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
 		}
 	}

 	public function statusUpdate($request)
 	{
 		try
 		{
 			$password = $this->fetch()->findorfail($request->password_id);
 			$password->status = $request->status;
 			$password->update();
 			return response()->json(['status'=>true, 'message'=>"Successfully the password's status has been updated"]);
 		}catch(Exception $e){
 			return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
 		}
 	}

 	public function delete($password)
 	{
 		try
 		{
 			$password->delete();
 			return response()->json(['status'=>true, 'message'=>'Successfully the password has been deleted']);
 		}catch(Exception $e){
 			return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
 		}
 	}

	public function showPassword($id)
	{
		try
		{
			$password = $this->fetch()->findorfail($id);
			$originalPassword = Crypt::decryptString($request->password);
			return response()->json(['status'=>true, 'password_id'=>intval($password->id), 'password'=>$originalPassword]);
		}catch(Exception $e){
 			return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
 		}
	}
 }