@include('layouts.main')
<style>
    body{margin-top:20px;
background-color:#f2f6fc;
color:#69707a;
}
.img-account-profile {
    height: 10rem;
}
.rounded-circle {
    border-radius: 50% !important;
}
.card {
    box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
}
.card .card-header {
    font-weight: 500;
}
.card-header:first-child {
    border-radius: 0.35rem 0.35rem 0 0;
}
.card-header {
    padding: 1rem 1.35rem;
    margin-bottom: 0;
    background-color: rgba(33, 40, 50, 0.03);
    border-bottom: 1px solid rgba(33, 40, 50, 0.125);
}
.form-control, .dataTable-input {
    display: block;
    width: 100%;
    padding: 0.875rem 1.125rem;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1;
    color: #69707a;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #c5ccd6;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.35rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.nav-borders .nav-link.active {
    color: #0061f2;
    border-bottom-color: #0061f2;
}
.nav-borders .nav-link {
    color: #69707a;
    border-bottom-width: 0.125rem;
    border-bottom-style: solid;
    border-bottom-color: transparent;
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
    padding-left: 0;
    padding-right: 0;
    margin-left: 1rem;
    margin-right: 1rem;
}
/* Custom style to set icon size */
.alert i[class^="bi-"]{
  font-size: 1.5em;
  line-height: 1;
}
</style>

<link href="https://maxcdn.bootstrapcdn.com/.../css/bootstrap.min.css" rel="stylesheet"> 
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/.../js/bootstrap.min.js" ></script>
<script src="https://kit.fontawesome.com/c88097f817.js" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300i,400" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<div class="container">

<div>
    <br />
    @if ( Session::has('success'))
      <div class="alert alert-success alert-dismissible d-flex align-items-center fade show">
        <i class="bi-check-circle-fill"></i>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <p>{{ Session::get('success') }}</p>
      </div><br />
     @endif
  </div>

{{ Form::model($employee,['route' => ['employee.eupdateprofile',$employee->id],'method'=> 'PUT','enctype'=>'multipart/form-data']) }}

<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
    {{-- <nav class="nav nav-borders">
        <a class="nav-link active ms-0" href="https://www.bootdey.com/snippets/view/bs5-edit-profile-account-details" target="__blank">Profile</a>
        <a class="nav-link" href="https://www.bootdey.com/snippets/view/bs5-profile-billing-page" target="__blank">Billing</a>
        <a class="nav-link" href="https://www.bootdey.com/snippets/view/bs5-profile-security-page" target="__blank">Security</a>
        <a class="nav-link" href="https://www.bootdey.com/snippets/view/bs5-edit-notifications-page"  target="__blank">Notifications</a>
    </nav> --}}
    <hr class="mt-0 mb-4">
    <div class="row">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Profile Picture</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    <img class="img-account-profile rounded-circle mb-2" src="{{ asset('storage/'.$employee->image) }}" alt="">

                    <div class="mb-3">
                        <label class="small mb-1" for="inputUsername">Image</label>
                        {{ Form::file('image',null,array('class'=>'form-control','id'=>'image')) }}
                        @if($errors->has('image'))
                          <small>{{ $errors->first('image') }}</small>
                        @endif  
                        {{-- <input class="form-control" id="inputUsername" type="text" placeholder="Enter your username" value="username"> --}}
                    </div>

                    <!-- Profile picture help block-->
                    {{-- <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div> --}}
                    <!-- Profile picture upload button-->
                    {{-- <button class="btn btn-primary" type="button">Upload new image</button> --}}
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Account Details</div>
                <div class="card-body">
                    <form>
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Name</label>
                            {{ Form::text('name',null,array('class'=>'form-control','id'=>'name')) }}
                            @if($errors->has('name'))
                              <small>{{ $errors->first('name') }}</small>
                            @endif  
                            {{-- <input class="form-control" id="inputUsername" type="text" placeholder="Enter your username" value="username"> --}}
                        </div>

                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (first name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">Gender</label>
                                <select class="form-control validate @error('gender') is-invalid @enderror" name="gender" id="gender" required autocomplete="gender">
                                        @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <option selected disabled hidden>{{ $employee->gender }}</option>
                                        <option value="Male"> Male </option>
                                        <option value="Female"> Female </option>      
                                </select>
                                        

                                {{-- <input class="form-control" id="inputFirstName" type="text" placeholder="Enter your first name" value="Valerie"> --}}
                            </div>
                            <!-- Form Group (last name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Phone</label>
                                {{ Form::number('phone',null,array('class'=>'form-control','id'=>'phone')) }}
                                @if($errors->has('phone'))
                                    <small>{{ $errors->first('phone') }}</small>
                                @endif
                                {{-- <input class="form-control" id="inputLastName" type="text" placeholder="Enter your last name" value="Luna"> --}}
                            </div>
                        </div>
                        <!-- Form Row        -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (organization name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputOrgName">Address</label>
                                {{ Form::text('address',null,array('class'=>'form-control','id'=>'address')) }}
                                @if($errors->has('address'))
                                    <small>{{ $errors->first('address') }}</small>
                                @endif
                                {{-- <input class="form-control" id="inputOrgName" type="text" placeholder="Enter your organization name" value="Start Bootstrap"> --}}
                            </div>
                            <!-- Form Group (location)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLocation">Birthdate</label>
                                {{ Form::date('birthdate',null,array('class'=>'form-control','id'=>'birthdate')) }}
                                @if($errors->has('birthdate'))
                                <small>{{ $errors->first('birthdate') }}</small>
                                @endif
                                {{-- <input class="form-control" id="inputLocation" type="text" placeholder="Enter your location" value="San Francisco, CA"> --}}
                            </div>
                        </div>
                        <!-- Save changes button-->
                        <button class="btn btn-primary" type="submit">Save changes</button>
                        <a class="btn btn-primary" href="{{url()->previous()}}" role="button">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{!! Form::close() !!} 

</div>

@include('layouts.footer')