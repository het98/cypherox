@extends('dashboard')
@section('content')
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

<a href="{{route('category.create')}}">Add</a>
<a href="{{route('home')}}">Home</a>
<table class="table" id="data-table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Category Name</th>
     
      <th scope="col">Action</th>
    </tr>
  </thead>

</table>

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script type="text/javascript">
  $(function () {
    
    var table = $('#data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('category.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'category_name', name: 'category_name'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
  });
</script>
<script>


function onBtSave($id) {
    var id = $id;
    var token = "{{csrf_token()}}";

  
        swal({
  title: "Are you sure?",
  text: "Are You sure you want to delete this one??.",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes, delete it!",
  cancelButtonText: "No, cancel please!",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm){
  if (isConfirm) {
    $.ajax(
    {
        url: "{{ route('category.delete') }}",
        type: 'POST',
        data: {
            "id": id,
            "_token": token,
        },
        success: function (data){
            if(data.status === 'success'){
            swal({
                    title: "Success!",
                    type: "success",
                    text: "deleted",
                    icon: "success",
                    confirmButtonClass: "btn btn-outline-info",
                            });
                        }
                            window.location.reload();
        }
    });      
  } else {
    swal("Cancelled", "Your imaginary file is safe :)", "error");
  }
});
}

$('.delete').on('click',function(){
    var id = $(this).data('id');
    var token = "{{csrf_token()}}";
    // alert(id);

    $.ajax(
    {
        url: "{{ route('category.delete') }}",
        type: 'POST',
        data: {
            "id": id,
            "_token": token,
        },
        success: function (data){
            if(data.status === 'success'){
                alert('Data Deleted Successfully');
                window.location.reload();
            }
        }
    });
})
</script>
@endsection