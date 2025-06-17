@extends('admin_master')

@section('content')
 <main class="app-main">
  <div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
      <!--begin::Row-->
      <div class="row">
        <div class="col-sm-6"><h3 class="mb-0">All Password</h3></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">All Password</li>
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
               <div class="card-header bg-primary text-light"><div class="card-title">All Password</div></div>
                <div class="card-body">
               
                  <div class="table-responsive">
                    <a href="{{route('passwords.create')}}" class="btn btn-success float-end"><i class="fa fa-plus"></i> Add New Password</a><br/><br/>
                  	<table class="table table-striped table-bordered bg-info" id="password-table">
                  	<thead>
                      <tr>
                       <th>Title</th>
                       <th>Category</th>
                       <th>Status</th>	
                       <th>Action</th>
                      </tr>		
                  	</thead>
                  	<tbody class="conts"></tbody>
                  </table>
                  </div>

                </div>
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

@push('scripts')
 <script>
  $(document).ready(function(){
  	let password_id;
  	var passwordTable = $('#password-table').DataTable({
            searching: true,
            processing: true,
            serverSide: true,
            ordering: false,
            responsive: true,
            stateSave: true,
            ajax: {
                url: "{{ route('passwords.index') }}"
            },
            columns: [
                { data: 'title', name: 'title' },
                { data: 'category', name: 'category' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
    });

  	$(document).on('click', '.delete-password', function(e) {
        e.preventDefault();
        password_id = $(this).data('id');
        if (confirm('Do you want to delete this password?')) {
            $.ajax({
                url: "{{ url('/passwords') }}/" + password_id,
                type: "DELETE",
                dataType: "json",
                success: function(data) {
                	console.log(data);
                    passwordTable.ajax.reload(null, false);
                    toastr.success(data.message);
                }
            });
        }
    });

    $(document).on('click', '#status-password-update', function(){
       password_id = $(this).data('id');
       var isGroupchecked = $(this).prop('checked');
       status_val = isGroupchecked ? 'Active' : 'Inactive'; 
       $.ajax({

          url: "{{url('password-status-update')}}",
          type:"POST",
          data:{'password_id':password_id, 'status':status_val},
          dataType:"json",
          success:function(data) {

              toastr.success(data.message);

              $('.data-table').DataTable().ajax.reload(null, false);

          },
                          
      });
    });

  });	
 </script>
@endpush