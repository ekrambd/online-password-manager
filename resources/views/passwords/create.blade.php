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
            <li class="breadcrumb-item active" aria-current="page">Add Password</li>
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
               <div class="card-header bg-primary text-light"><div class="card-title">Add Password</div></div>
              <form action="{{route('passwords.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                <div class="row">
                 <div class="col-md-4">
                   <div class="mb-3">
                    <label for="title" class="form-label">Title <span class="required">*</span></label>
                    <input
                      type="text"
                      class="form-control"
                      name="title"
                      id="title"
                      placeholder="Title"
                      required=""
                      value="{{old('title')}}"
                    />
                    @error('title')
                      <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                  </div>
                 </div>	

                 <div class="col-md-4">
                 	<div class="mb-3">
                    <label for="category_id" class="form-label">Select Category <span class="required">*</span></label>
                    <select class="form-control select2bs4" name="category_id" id="category_id" required>
                      <option value="" selected="" disabled="">Select Category</option>
                      @foreach(categories() as $category)
                       <option value="{{$category->id}}">{{$category->category_name}}</option>
                      @endforeach
                    </select>
                    @error('category_id')
                      <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                  </div>
                 </div>

                 <div class="col-md-4">
                 	<div class="mb-3">
                    <label for="group_id" class="form-label">Select Group</label>
                    <select class="form-control select2bs4" name="group_id" id="group_id">
                      <option value="" selected="" disabled="">Select Group</option>
                      @foreach(groups() as $group)
                       <option value="{{$group->id}}">{{$group->group_name}}</option>
                      @endforeach
                    </select>
                    @error('group_id')
                      <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                  </div>
                 </div>

                 

                 <div class="col-md-4">
	                   <div class="mb-3">
	                    <label for="password" class="form-label">Password <span class="required">*</span></label>
	                    <input
	                      type="password"
	                      class="form-control"
	                      name="password"
	                      id="password"
	                      placeholder="Password"
	                      required=""
	                      value="{{old('password')}}"
	                    />
	                    @error('password')
	                      <p class="alert alert-danger">{{ $message }}</p>
	                    @enderror
	                  </div>	
                 </div>

                 <div class="col-md-4">
	                   <div class="mb-3">
	                    <label for="confirm_password" class="form-label">Confirm Password <span class="required">*</span></label>
	                    <input
	                      type="password"
	                      class="form-control"
	                      name="confirm_password"
	                      id="confirm_password"
	                      placeholder="Confirm Password"
	                      required=""
	                      value="{{old('confirm_password')}}"
	                    />
	                    @error('confirm_password')
	                      <p class="alert alert-danger">{{ $message }}</p>
	                    @enderror
	                  </div>
	               	
                 </div>

                 <div class="col-md-4">
                 	<div class="mb-3">
                    <label for="status" class="form-label">Status <span class="required">*</span></label>
                    <select class="form-control select2bs4" name="status" id="status" required>
                      <option value="" selected="" disabled="">Select Status</option>
                      <option value="Active">Active</option>
                      <option value="Inactive">Inactive</option>
                    </select>
                    @error('status')
                      <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                  </div>
                 </div>

                 <div class="col-md-12">
                   	<div class="mb-3">
                    <label for="remarks" class="form-label">Remarks</label>
                    <textarea class="form-control" name="remarks" id="remarks" placeholder="Remarks">{!!old('remarks')!!}</textarea>
                    @error('remarks')
                      <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                  </div>
                 </div>

                </div>

                  <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
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
