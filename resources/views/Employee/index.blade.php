@include('layouts.header')
<style>
    * {
        margin-top: 10px;
    }

    .left-col {
        float: left;
        width: 25%;
    }

    .center-col {
        float: left;
        width: 50%;
    }

    .right-col {
        float: left;
        width: 25%;
    }
</style>

<div class="container-fluid">

    <table id="etable" class="table table-striped table-hover" style="width:100%;">
        <thead>
            <tr>
                <th>EMPLOYEE ID</th>
                <th>NAME</th>
                <th>GENDER</th>
                <th>PHONE</th>
                <th>ADDRESS</th>
                <th>BIRTHDATE</th>
                <th>EMAIL</th>
                <th>IMAGE</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody id="ebody">
        </tbody>
    </table>
</div>
</div>    

<div class="modal fade" id="eModal" role="dialog" style="display:none">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            {{-- <button type="button" class="close" data-dismiss="modal">&times;</button> --}}
            {{-- <h4 class="modal-title">Create New Employee</h4> --}}

            <div class="modal-body">
                <form id="eform" action="#" method="#" enctype="multipart/form-data">
                    @csrf
                    <!-- {{-- <input type="hidden" name="itemimage" id="itemimage"> --}} -->

                    <div class="form-group">
                        <input type="hidden" class="form-control id" id="eid" name="eid">
                    </div>

                    <center><h4 id="labels" class="modal-title">CREATE NEW EMPLOYEE</h4></center>
                    <center><h4 id="ilabels" class="modal-title">EDIT EMPLOYEE PROFILE</h4></center>

                    <div class="form-group">
                        <label for="name" class="control-label">NAME :</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>

                    {{-- <div class="form-group">
                        <label for="gender" class="control-label">GENDER :</label>
                        <input type="text" class="form-control" id="gender" name="gender">
                    </div> --}}

                    <div class="form-group">
                        <label for="gender" class="control-label">GENDER :</label>
                        <select class="form-select" id="gender" name="gender" type="text">
                            <option value="" disabled selected>SELECT YOUR GENDER</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                          </select>
                    </div>

                    <div class="form-group">
                        <label for="phone" class="control-label">PHONE :</label>
                        <input type="number" class="form-control " id="phone" name="phone">
                    </div>

                    <div class="form-group">
                        <label for="address" class="control-label">ADDRESS :</label>
                        <input type="text" class="form-control " id="address" name="address">
                    </div>

                    <div class="form-group">
                        <label for="birthdate" class="control-label">BIRTHDATE :</label>
                        <input type="date" class="form-control " id="birthdate" name="birthdate">
                    </div>

                    <div class="form-group">
                        <label for="email" class="control-label" id="lemail">EMAIL :</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>

                    <div class="form-group">
                        <label for="password" class="control-label" id="lpassword">PASSWORD :</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>

                    <div class="form-group">
                        <label data-error="wrong" data-success="right" for="password-confirm" id="llpassword">CONFIRM PASSWORD :</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div class="form-group">
                        <label for="image" class="control-label" id="limage">CUSTOMER IMAGE:</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                </form>
            </div>

        </div>

        <div class="modal-footer" id="btnss">
            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
            <button id="eSubmit" type="submit" class="btn btn-primary">Save</button>
            <button id="eUpdate" type="submit" class="btn btn-primary">Update</button>
        </div>

    </div>
</div>
</div>