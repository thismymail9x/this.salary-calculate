<?php if (isset($_SESSION['message'])): ?>
    <script>
        alert("<?php echo $_SESSION['message'];
            unset($_SESSION['message'])?>")
    </script>
<?php endif; ?>

<div class="container m-t-50">
    <form class="form-inline" method="get">
        <input type="month" name="month" class="form-control" placeholder="From day">
        <input type="text" name="page" value="search-timesheets-by-month" hidden>
        <input type="submit" class="form-control m-l-10" value="Search">
    </form>
    <div class="card mt-2">
        <h5 class="card-header"><?php if (isset($month)) {
                echo $month;
            } else {
                echo date('yy-m');
            }
            ?></h5>

        <div class="card-body">
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Employee number</th>
                    <th scope="col">Full name</th>
                    <th scope="col">Working Days</th>
                    <th scope="col">Off hours</th>
                    <th scope="col">Overtime hours</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($timesheets as $key => $timesheet): ?>
                    <tr>
                        <th scope="row"><?php echo ++$key ?></th>
                        <td><?php echo $timesheet['employeeNumber'] ?></td>
                        <td><?php echo $timesheet['name'] ?></td>
                        <td><?php echo $timesheet['workingDays'] ?></td>
                        <td><?php echo $timesheet['offHours'] ?></td>
                        <td><?php echo $timesheet['overtimeHours'] ?></td>
                        <td style="text-align: center"><?php if (isExist($timesheet['employeeNumber'], $salaryCountedEmployees)) {
                                echo "<i style='color: green' class=\"fas fa-check-circle\"></i>";
                            } ?></td>
                        <td>
                            <a class="btn btn-primary"
                               href="./index.php?page=count-salary&employeeNumber=<?php echo $timesheet['employeeNumber'] ?>&workingDays=<?php echo $timesheet['workingDays'] ?>&offHours=<?php echo $timesheet['offHours'] ?>&overtimeHours=<?php echo $timesheet['overtimeHours'] ?>">Count
                                salary</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

