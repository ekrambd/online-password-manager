<?php
 namespace App\Repositories\Group;
 use App\Models\Group;
 use DB;

 class GroupRepository implements GroupInterface
 {
 	public function fetch()
 	{
 		try
 		{
 			$groups = Group::query();
 			return $groups;
 		}catch(Exception $e){
 			return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
 		}
 	}

 	public function store($request)
 	{   
 		DB::beginTransaction();
 		try
 		{
 			$group = Group::create([
 				'user_id' => user()->id,
 				'group_name' => $request->group_name,
 				'status' => $request->status,
 			]);
 			$group->users()->attach($request->user_ids);
 			DB::commit();
 			return response()->json(['status'=>true, 'group_id'=>intval($group->id), 'message'=>'Successfully a group has been added']);
 		}catch(Exception $e){
 			DB::rollback();
 			return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
 		}
 	}

 	public function update($request,$group)
 	{   
 		DB::beginTransaction();
 		try
 		{
 			$group->update($request->validated());
 			$group->users()->sync($request->user_ids);
 			DB::commit();
 			return response()->json(['status'=>true, 'group_id'=>intval($group->id), 'message'=>'Successfully the group has been updated']);
 		}catch(Exception $e){
 			DB::rollback();
 			return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
 		}
 	}

 	public function statusUpdate($request)
 	{
 		try
 		{
 			$group = $this->fetch()->findorfail($request->group_id);
 			$group->status = $request->status;
 			$group->update();
 			return response()->json(['status'=>true, 'message'=>"Successfully the group's status has been updated"]);
 		}catch(Exception $e){
 			return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
 		}
 	}

 	public function delete($group)
 	{
 		try
 		{
 			$group->users()->delete();
 			$group->passwords()->delete();
 			return response()->json(['status'=>true, 'message'=>'Successfully the group has been deleted']);
 		}catch(Exception $e){
 			return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
 		}
 	}
 }