@extends('admin_master')

@section('content')
 <main class="app-main">
  <div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
      <!--begin::Row-->
      <div class="row">
        <div class="col-sm-6"><h3 class="mb-0">Edit Group</h3></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Group</li>
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
               <div class="card-header bg-primary text-light"><div class="card-title">Edit Group</div></div>
              <form action="{{route('groups.update',$group->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="card-body">
                  <div class="mb-3">
                    <label for="group_name" class="form-label">Group Name <span class="required">*</span></label>
                    <input
                      type="text"
                      class="form-control"
                      name="group_name"
                      id="group_name"
                      placeholder="Group Name"
                      required=""
                      value="{{old('group_name',$group->group_name)}}"
                    />
                    @error('group_name')
                      <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                  </div>


                  <div class="mb-3">
                    <label for="user_ids" class="form-label">Select Users <span class="required">*</span></label>
                    <select class="form-control select2multiple" name="user_ids[]" multiple="" id="user_ids" required>
                      @foreach(users() as $user)  
                        <option value="{{$user->id}}" {{  in_array($user->id, userGroups($group)) ? 'selected' : '' }}>{{$user->name}}-{{$user->email}}</option>
                      @endforeach 
                    </select>
                    @error('user_ids')
                      <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                  </div>


                  <div class="mb-3">
                    <label for="status" class="form-label">Status <span class="required">*</span></label>
                    <select class="form-control select2bs4" name="status" id="status" required>
                      <option value="" selected="" disabled="">Select Status</option>
                      <option value="Active" <?php if($group->status == 'Active'){echo "selected";} ?>>Active</option>
                      <option value="Inactive" <?php if($group->status == 'Inactive'){echo "selected";} ?>>Inactive</option>
                    </select>
                    @error('status')
                      <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
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
