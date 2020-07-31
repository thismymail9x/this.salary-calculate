<?php
?>
<div class="container m-t-50">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 form-div" style="border: 1px solid #e0e0e0; padding: 20px">
            <form method="post" enctype="multipart/form-data">
                <h3 class="text-center text-primary">Timekeeping</h3>
                <div class="form-group">
                    <label for="off-hours">Off hours <span style="color:red;">*</span></label>
                    <input type="text" name="off-hours" class="form-control" id="off-hours"">
                </div>
                <div class="form-group">
                    <label for="overtime-hours">Overtime hours<span style="color:red;">*</span></label>
                    <input type="text" name="overtime-hours" id="overtime-hours" class="form-control">
                </div>
                <div class="form-group">
                    <input type="text" name="day" class="form-control" value="<?php echo date('yy-m-d')?>" hidden>
                </div>
                <div class="form-group">
                    <input type="text" name="id" class="form-control" value="<?php echo $id ?>" hidden>
                </div>
                <button type="submit" class="btn btn-success">Confirm</button>
                <button class="btn btn-secondary" onclick="window.history.go(-1); return false;">Cancel</button>
            </form>
        </div>
    </div>

</div>

