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

    <table id="pttable" class="table table-striped table-hover" style="width:100%;">
        <thead>
            <tr>
                <th>PIZZA TOPPINGS ID</th>
                <th>NAME</th>
                <th>DESCRIPTION</th>
                <th>FEE</th>
                <th>IMAGE</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody id="ptbody">
        </tbody>
    </table>
</div>
</div>    

<div class="modal fade" id="ptModal" role="dialog" style="display:none">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            {{-- <button type="button" class="close" data-dismiss="modal">&times;</button> --}}
            {{-- <h4 class="modal-title">Create New Employee</h4> --}}

            <div class="modal-body">
                <form id="ptform" action="#" method="#" enctype="multipart/form-data">
                    @csrf
                    <!-- {{-- <input type="hidden" name="itemimage" id="itemimage"> --}} -->

                    <div class="form-group">
                        <input type="hidden" class="form-control id" id="id" name="id">
                    </div>

                    <center><h4 id="clabels" class="modal-title">CREATE NEW PIZZA TOPPINGS</h4></center>
                    <center><h4 id="elabels" class="modal-title">EDIT PIZZA TOPPINGS DETAILS</h4></center>

                    <div class="form-group">
                        <label for="name" class="control-label">NAME :</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>

                    <div class="form-group">
                        <label for="description" class="control-label">DESCRIPTION :</label>
                        <textarea type="text" class="form-control" id="description" name="description"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="fee" class="control-label">FEE :</label>
                        <input type="number" class="form-control " id="fee" name="fee">
                    </div>

                    <div class="form-group">
                        <label for="img_path" class="control-label" id="limage">PIZZA TOPPINGS IMAGE:</label>
                        <input type="file" class="form-control" id="img_path" name="img_path">
                    </div>
                </form>
            </div>

        </div>

        <div class="modal-footer" id="btnss">
            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
            <button id="ptSubmit" type="submit" class="btn btn-primary">Save</button>
            <button id="ptUpdate" type="submit" class="btn btn-primary">Update</button>
        </div>

    </div>
</div>
</div>