@extends('dashboard')
@section('content')
<style>
    .error{
        color:red;
    }
    </style>
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<form id="add_form">
    @csrf
    @method('PUT')
  <div class="mb-3">
    <div class="row">
        <div class="col-sm-6">
            <label for="categoryname" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="categoryname" name="category_name" value="{{$data->category_name}}">
        </div>
    </div>
  </div>


  
  <button type="button" class="btn btn-primary submit">Submit</button>
  <a href="{{route('category.index')}}" class="btn btn-primary">Back</a>
</form>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script>
    $(document).ready(function(){

        $('#add_form').validate({
            rules:{
                category_name:{
                    required:true
                },
             
            },
            messages:{
                category_name:{
                    required:"Please Enter Category Name"
                }
           

            }
        })
$('.submit').on('click',function(){
    if($('#add_form').valid()){
    //    $('.psss').val();
    
    $.ajax({
        type: "post",
        url: "{{route('category.update',$data->id)}}",
        contentType:false,
        processData:false,
        data: new FormData($('#add_form')[0]),
        success: function(data){
            if(data.status === 'success'){
                alert('Data Updated successfully');
                window.location = "{{route('category.index')}}";

            }
        }
    })
}
})
})
</script>
@endsection