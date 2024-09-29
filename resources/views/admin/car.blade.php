<!DOCTYPE html>
<html lang="en">
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Car</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Create a Car</h1>

        <div id="response-message" style="display:none;" class="alert"></div>

        <form id="car-form" action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
               
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
               
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
                <div id="response-messages" style="display:none;" class="alert"></div>
            </div>

           <div class="form-group">
             <label for="description">Description</label>
               <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                 
            </div>


            <div class="form-group">
                <label for="role_id">User Role</label>
                <select name="role_id" class="form-control">
                    <option value="1" >User</option>
                    <option value="2">Seller</option>
                </select>
              
            </div>

            <div class="form-group">
                <label for="profile_image">Profile Image</label>
                <input type="file" name="profile_image" id="profile_image" class="form-control" accept="image/*">
              
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
       $(document).ready(function () {
    $('#car-form').on('submit', function (e) {
        e.preventDefault();

        // Front-end phone number validation for Indian phone numbers
     

        let formData = new FormData(this);
        $.ajax({
            url: "{{ route('cars.store') }}",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $('#response-message')
                    .removeClass('alert-danger')
                    .addClass('alert-success')
                    .html('Car data added successfully!')
                    .show();

                $('#car-form')[0].reset();
                setTimeout(function() {
                    $('#response-message').fadeOut();
                }, 2000);
            },
            error: function (xhr) {
                let errors = xhr.responseJSON.errors;
                let errorMsg = 'An error occurred:<br>';
                $.each(errors, function(key, value) {
                    errorMsg += value + '<br>';
                });
                $('#response-message')
                    .removeClass('alert-success')
                    .addClass('alert-danger')
                    .html(errorMsg)
                    .show();
            }
        });
    });
});

    </script>
	
</body>
</html>

<table>
  <tr>
  <th>Id</th>
   <th>Image</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Role</th>
	
  </tr>
  @foreach($cars as $k=>$car)
  <tr>
  <td>{{++$k}}</td>
  <td>
     @if($car->profile_image)
        <img src="{{ asset('images/profiles/' . $car->profile_image) }}" alt="Image" style="width:200px;height:auto;">
     @else
      <p>No Image</p>
     @endif
        </td>
    <td>{{$car->name ?? ''}}</td>
    <td>{{$car->email ?? ''}}</td>
    <td>{{$car->phone ?? ''}}</td>
	 <td>{{$car->role->name ?? ''}}</td>
	   
  </tr>
  @endforeach

</table>
