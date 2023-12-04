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

    <table id="vtable" class="table table-striped table-hover" style="width:100%;">
        <thead>
            <tr>
                <th>VOUCHER ID</th>
                <th>NAME</th>
                <th>DESCRIPTION</th>
                <th>VALUE</th>
                <th>LIMIT</th>
                <th>STATUS</th>
                <th>IMAGE</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody id="vbody">
        </tbody>
    </table>
</div>
</div>    

<div class="modal fade" id="vModal" role="dialog" style="display:none">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            {{-- <button type="button" class="close" data-dismiss="modal">&times;</button> --}}
            {{-- <h4 class="modal-title">Create New Employee</h4> --}}

            <div class="modal-body">
                <form id="vform" action="#" method="#" enctype="multipart/form-data">
                    @csrf
                    <!-- {{-- <input type="hidden" name="itemimage" id="itemimage"> --}} -->

                    <div class="form-group">
                        <input type="hidden" class="form-control id" id="vid" name="vid">
                    </div>

                    <center><h4 id="labels" class="modal-title">CREATE NEW VOUCHER</h4></center>
                    <center><h4 id="ilabels" class="modal-title">EDIT VOUCHER DETAILS</h4></center>

                    <div class="form-group">
                        <label for="name" class="control-label">NAME :</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>

                    <div class="form-group">
                        <label for="description" class="control-label">DESCRIPTION :</label>
                        <textarea type="text" class="form-control" id="description" name="description"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="value" class="control-label" id="lvalue">VALUE :</label>
                        <input type="number" class="form-control " id="value" name="value">
                    </div>

                    <div class="form-group">
                        <label for="limit" class="control-label" id="llimit">LIMIT :</label>
                        <input type="number" class="form-control " id="limit" name="limit">
                    </div>

                    <div class="form-group">
                        <label for="image" class="control-label" id="limage">VOUCHER IMAGE:</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                </form>
            </div>

        </div>

        <div class="modal-footer" id="btnss">
            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
            <button id="vSubmit" type="submit" class="btn btn-primary">Save</button>
            <button id="vUpdate" type="submit" class="btn btn-primary">Update</button>
        </div>

    </div>
</div>
</div>