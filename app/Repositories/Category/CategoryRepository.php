<?php
 namespace App\Repositories\Category;
 use App\Models\Category;
 
 class CategoryRepository implements CategoryInterface
 {
 	public function fetch()
 	{
 		try
 		{
 			$categories = Category::query();
 			return $categories;
 		}catch(Exception $e){
 			return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
 		}
 	}

 	public function store($request)
 	{
 		try
 		{
 			$category = Category::create([
 				'user_id' => user()->id,
 				'category_name' => $request->category_name,
 				'status' => $request->status,
 			]);
 			return response()->json(['status' => true, 'category_id'=>intval($category->id), 'message' => 'Category created successfully']);
 		}catch(Exception $e){
 			return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
 		}
 	}

 	public function update($request,$category)
 	{
 		try
 		{
 			$category->update($request->validated());
 			return response()->json(['status' => true, 'category_id'=>intval($category->id), 'message' => 'Category Updated Successfully']);
 		}catch(Exception $e){
 			return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
 		}
 	}

 	public function delete($category)
 	{
 		try
 		{
 			$category->delete();
 			return response()->json(['status'=>true, 'message'=>'Successfully the category has been deleted']);
 		}catch(Exception $e){
 			return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
 		}
 	}

 	public function statusUpdate($request)
 	{
 		try
 		{
 			$category = $this->fetch()->findorfail($request->category_id);
 			$category->status = $request->status;
 			$category->update();
 			return response()->json(['status'=>true, 'message'=>"Successfully the category's status has been updated"]);
 		}catch(Exception $e){
 			return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
 		}
 	}
 }