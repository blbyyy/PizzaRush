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

    <table id="atable" class="table table-striped table-hover" style="width:100%;">
        <thead>
            <tr>
                <th>ANNOUNCEMENT ID</th>
                <th>TITLE</th>
                <th>INFORMATION</th>
                <th>IMAGE</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody id="abody">
        </tbody>
    </table>
</div>
</div>    

<div class="modal fade" id="aModal" role="dialog" style="display:none">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            {{-- <button type="button" class="close" data-dismiss="modal">&times;</button> --}}
            {{-- <h4 class="modal-title">Create New Employee</h4> --}}

            <div class="modal-body">
                <form id="aform" action="#" method="#" enctype="multipart/form-data">
                    @csrf
                    <!-- {{-- <input type="hidden" name="itemimage" id="itemimage"> --}} -->

                    <div class="form-group">
                        <input type="hidden" class="form-control id" id="aid" name="aid">
                    </div>

                    <center><h4 id="labels" class="modal-title">CREATE NEW ANNOUNCEMENT</h4></center>
                    <center><h4 id="ilabels" class="modal-title">EDIT ANNOUNCEMENT PROFILE</h4></center>

                    <div class="form-group">
                        <label for="title" class="control-label">TITLE :</label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>

                    <div class="form-group">
                        <label for="info" class="control-label">INFORMATION :</label>
                        <textarea type="text" class="form-control" id="info" name="info"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="image" class="control-label" id="limage">INFORMATION IMAGE:</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                </form>
            </div>

        </div>

        <div class="modal-footer" id="btnss">
            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
            <button id="aSubmit" type="submit" class="btn btn-primary">Save</button>
            <button id="aUpdate" type="submit" class="btn btn-primary">Update</button>
        </div>

    </div>
</div>
</div>