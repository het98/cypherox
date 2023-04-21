@extends('dashboard')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
            <label for="title" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$data->name}}">
        </div>
        <div class="col-sm-6">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{$data->description}}</textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label for="title" class="form-label">Image</label>
            <img src = "{{asset('ProductImage/'.$data->image)}}" height = "50px" width="50px">
            <input type="file" class="form-control" id="image" name="image" value="{{$data->image}}">
        </div>

        <div class="col-sm-6">
            <label for="category" class="form-label">Select Category</label>
           
            <select class="form-select" id="main_category" name="categories_id">
            <option selected> select </option>
            @foreach($category as $cat)
            <option value="{{$cat->id}}" @if($cat->id == $data->categories_id) selected @endif>{{$cat->category_name}}</option>
            @endforeach
         
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <label for="title" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" name="price" value="{{$data->price}}">
        </div>
      
    </div>
  </div>


  
  <button type="button" class="btn btn-primary submit">Submit</button>
  <a href="{{route('product.index')}}" class="btn btn-primary">Back</a>
</form>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() { 
 $("#main_category").select2();
});
    $(document).ready(function(){

        $('#add_form').validate({
            rules:{
                name:{
                    required:true
                },
                price:{
                    required:true
                },
             
            },
          
        })
$('.submit').on('click',function(){
    if($('#add_form').valid()){
    //    $('.psss').val();
    
    $.ajax({
        type: "post",
        url: "{{route('product.update',$data->id)}}",
        contentType:false,
        processData:false,
        data: new FormData($('#add_form')[0]),
        success: function(data){
            if(data.status === 'success'){
                alert('Data updated successfully');
                window.location = "{{route('product.index')}}";

            }else if(data.status === 'error'){
                alert('Something went wrong');
                window.location.reload();
            }
        }
    })
}
})
})
</script>
@endsection