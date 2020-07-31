<?php
?>
<div class="container m-t-50">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 form-div" style="border: 1px solid #e0e0e0; padding: 20px">
            <form method="post">
                <h3 class="text-center text-primary">Count salary</h3>
                <div class="form-group">
                    <h5>Name : <?php echo $employee['name']?></h5>
                    <h5>Employee number : <?php echo $employee['employeeNumber']?></h5>
                    <h6>Working days : <?php echo $workingDays?></h6>
                    <h6>Off hours : <?php echo $offHours?></h6>
                    <h6>Overtime hours : <?php echo $overtimeHours?></h6>
                </div>
                <div class="form-group">
                    <label for="basic-salary">Basic salary($)</label>
                    <input type="text" name="basic-salary" id="basic-salary" class="form-control" value="<?php echo $employee['salary']?>">
                </div>
                <div class="form-group">
                    <label for="working-days">Working days</label>
                    <input type="text" name="working-days" class="form-control" id="working-days"  value="<?php echo $workingDays?>">
                </div>
                <div class="form-group">
                    <label for="fine">Fine($)</label>
                    <input type="text" name="fine" class="form-control" id="fine"  value="<?php echo ($offHours + 29 - $workingDays) * 15?>">
                </div>
                <div class="form-group">
                    <label for="overtime-money">Overtime money($)</label>
                    <input type="text" name="overtime-money" class="form-control" id="overtime-money" value="<?php echo $overtimeHours * 20?>">
                </div>
                <div class="form-group">
                    <label for="insurance">Insurance($)</label>
                    <input type="text" name="insurance" class="form-control" id="insurance" value="<?php echo $employee['salary'] * 5 / 100?>">
                </div>
                <div class="form-group">
                    <label for="total-salary">Total salary($)</label>
                    <input type="text" name="total-salary" class="form-control" id="total-salary" value="">
                </div>
                <input type="month" name="day" value="<?php echo date('yy-m')?>" hidden>
                <input type="text" name="employee-number" value="<?php echo $employee['employeeNumber']?>" hidden>
                <button type="submit" onclick="window.history.go(-2); return true" class="btn btn-success">Confirm</button>
                <button class="btn btn-secondary" onclick="window.history.go(-1); return false;">Cancel</button>
            </form>
        </div>
    </div>
</div>
<script>
    function getTotalSalary() {
        document.getElementById('total-salary').value = getValue('basic-salary') + getValue('overtime-money') - getValue('fine') - getValue('insurance');
    }

    function getValue(id) {
        return +document.getElementById(id).value;
    }
    getTotalSalary();
</script>
