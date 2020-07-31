<?php

?>
<div class="container m-t-50">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 form-div" style="border: 1px solid #e0e0e0; padding: 20px">
            <form method="post" enctype="multipart/form-data">
                <h3 class="text-center text-primary"><?php echo $day?></h3>
                <div class="form-group">
                    <label>Working</label>
                    <div class="form-check form-check-inline">
                        <input type="radio" id="yes" name="working" class="form-check-input" value="1" checked>
                        <label class="form-check-label" for="yes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="no" name="working" value="0">
                        <label for="no" class="form-check-label">No</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="off-hours">Off hours</label>
                    <input type="text" name="off-hours" class="form-control" id="off-hours"  value="<?php echo $timesheet['offHours']?>">
                </div>
                <div class="form-group">
                    <label for="overtime-hours">Overtime hours</label>
                    <input type="text" name="overtime-hours" class="form-control" id="overtime-hours" value="<?php echo $timesheet['overtimeHours']?>">
                </div>
                <input type="text" name="id" value="<?php echo $timesheet['id']?>" hidden>
                <button type="submit" class="btn btn-success">Confirm</button>
                <button class="btn btn-secondary" onclick="window.history.go(-1); return false;">Cancel</button>
            </form>
        </div>
    </div>
</div>
