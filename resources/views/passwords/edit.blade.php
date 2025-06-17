@extends('admin_master')

@section('content')
 <main class="app-main">
  <div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
      <!--begin::Row-->
      <div class="row">
        <div class="col-sm-6"><h3 class="mb-0">Add Password</h3></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Password</li>
          </ol>
        </div>
      </div>
      <!--end::Row-->
    </div>
    <!--end::Container-->

    <!--begin::App Content-->
    <div class="app-content">
      <!--begin::Container-->
       <div class="container-fluid">
         <!--begin::Row-->
          <div class="row g-4">
            <div class="col-md-12">
             <div class="card">
               <div class="card-header bg-primary text-light"><div class="card-title">Edit Password</div></div>
              <form action="{{route('passwords.update',$password->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="card-body">
                <div class="row">
                 <div class="col-md-6">
                   <div class="mb-3">
                    <label for="title" class="form-label">Title <span class="required">*</span></label>
                    <input
                      type="text"
                      class="form-control"
                      name="title"
                      id="title"
                      placeholder="Title"
                      required=""
                      value="{{old('title',$password->title)}}"
                    />
                    @error('title')
                      <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                  </div>
                 </div>	

                 <div class="col-md-6">
                 	<div class="mb-3">
                    <label for="category_id" class="form-label">Select Category <span class="required">*</span></label>
                    <select class="form-control select2bs4" name="category_id" id="category_id" required>
                      <option value="" selected="" disabled="">Select Category</option>
                      @foreach(categories() as $category)
                       <option value="{{$category->id}}" <?php if($password->category_id == $category->id){echo "selected";} ?>>{{$category->category_name}}</option>
                      @endforeach
                    </select>
                    @error('category_id')
                      <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                  </div>
                 </div>

                 <div class="col-md-6">
                 	<div class="mb-3">
                    <label for="group_id" class="form-label">Select Group</label>
                    <select class="form-control select2bs4" name="group_id" id="group_id">
                      <option value="" selected="" disabled="">Select Group</option>
                      @foreach(groups() as $group)
                       <option value="{{$group->id}}" <?php if($password->group_id == $group->id){echo "selected";} ?>>{{$group->group_name}}</option>
                      @endforeach
                    </select>
                    @error('group_id')
                      <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                  </div>
                 </div>

                 

                 <div class="col-md-6">
                 	<div class="mb-3">
                    <label for="status" class="form-label">Status <span class="required">*</span></label>
                    <select class="form-control select2bs4" name="status" id="status" required>
                      <option value="" selected="" disabled="">Select Status</option>
                      <option value="Active" <?php if($password->status == 'Active'){echo "selected";} ?>>Active</option>
                      <option value="Inactive" <?php if($password->status == 'Inactive'){echo "selected";} ?>>Inactive</option>
                    </select>
                    @error('status')
                      <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                  </div>
                 </div>

                 <div class="col-md-12">
                   	<div class="mb-3">
                    <label for="remarks" class="form-label">Remarks</label>
                    <textarea class="form-control" name="remarks" id="remarks" placeholder="Remarks">{!!old('remarks',$password->remarks)!!}</textarea>
                    @error('remarks')
                      <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                  </div>
                 </div>

                </div>

                  <div class="mb-3">
                    <button type="submit" class="btn btn-success">Save Changes</button>
                  </div>

                </div>
              </form>
             </div> 
              
            </div>
          </div>
        <!--end::Row--> 
       </div>
      <!--end::Container-->
    </div>

  </div>
 </main>
@endsection
