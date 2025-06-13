@extends('admin_master')

@section('content')
 <main class="app-main">
  <div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
      <!--begin::Row-->
      <div class="row">
        <div class="col-sm-6"><h3 class="mb-0">All Group</h3></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">All Group</li>
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
               <div class="card-header bg-primary text-light"><div class="card-title">All Group</div></div>
                <div class="card-body">
               
                  <div class="table-responsive">
                    <a href="{{route('groups.create')}}" class="btn btn-success float-end"><i class="fa fa-plus"></i> Add New Group</a><br/><br/>
                  	<table class="table table-striped table-bordered bg-info" id="group-table">
                  	<thead>
                      <tr>
                       <th>Group Name</th>
                       <th>Total Member</th>
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
  	let group_id;
  	var groupTable = $('#group-table').DataTable({
            searching: true,
            processing: true,
            serverSide: true,
            ordering: false,
            responsive: true,
            stateSave: true,
            ajax: {
                url: "{{ route('groups.index') }}"
            },
            columns: [
                { data: 'group_name', name: 'group_name' },
                { data: 'total_member', name: 'total_member' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
    });

  	$(document).on('click', '.delete-group', function(e) {
        e.preventDefault();
        group_id = $(this).data('id');
        if (confirm('Do you want to delete this group?')) {
            $.ajax({
                url: "{{ url('/groups') }}/" + group_id,
                type: "DELETE",
                dataType: "json",
                success: function(data) {
                	console.log(data);
                    groupTable.ajax.reload(null, false);
                    toastr.success(data.message);
                }
            });
        }
    });

    $(document).on('click', '#status-group-update', function(){
       group_id = $(this).data('id');
       var isGroupchecked = $(this).prop('checked');
       status_val = isGroupchecked ? 'Active' : 'Inactive'; 
       $.ajax({

          url: "{{url('group-status-update')}}",
          type:"POST",
          data:{'group_id':group_id, 'status':status_val},
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