@extends('admin_master')

@section('content')
 <main class="app-main">
  <div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
      <!--begin::Row-->
      <div class="row">
        <div class="col-sm-6"><h3 class="mb-0">All Category</h3></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">All Category</li>
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
               <div class="card-header bg-primary text-light"><div class="card-title">All Category</div></div>
                <div class="card-body">
               
                  <div class="table-responsive">
                    <a href="{{route('categories.create')}}" class="btn btn-success float-end"><i class="fa fa-plus"></i> Add New Category</a><br/><br/>
                  	<table class="table table-striped table-bordered bg-info" id="category-table">
                  	<thead>
                      <tr>
                       <th>Category Name</th>
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
  	let category_id;
  	var categoryTable = $('#category-table').DataTable({
            searching: true,
            processing: true,
            serverSide: true,
            ordering: false,
            responsive: true,
            stateSave: true,
            ajax: {
                url: "{{ route('categories.index') }}"
            },
            columns: [
                { data: 'category_name', name: 'category_name' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
    });

  	$(document).on('click', '.delete-category', function(e) {
        e.preventDefault();
        category_id = $(this).data('id');
        if (confirm('Do you want to delete this category?')) {
            $.ajax({
                url: "{{ url('/categories') }}/" + category_id,
                type: "DELETE",
                dataType: "json",
                success: function(data) {
                	console.log(data);
                    categoryTable.ajax.reload(null, false);
                    toastr.success(data.message);
                }
            });
        }
    });

    $(document).on('click', '#status-category-update', function(){
       category_id = $(this).data('id');
       var isCategorychecked = $(this).prop('checked');
       status_val = isCategorychecked ? 'Active' : 'Inactive'; 
       $.ajax({

          url: "{{url('category-status-update')}}",
          type:"POST",
          data:{'category_id':category_id, 'status':status_val},
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