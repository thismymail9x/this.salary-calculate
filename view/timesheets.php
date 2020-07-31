<?php

?>
<div class="container m-t-50">
    <form class="form-inline" method="get">
        From:
        <input type="date" name="from" class="form-control" placeholder="From day">
        To:
        <input type="date" name="to" class="form-control" placeholder="To day">
        <input type="text" name="page" value="search-timesheets" hidden>
        <input type="submit" class="form-control m-l-10" value="Search">
    </form>
    <div class="card mt-2">
        <h5 class="card-header"><?php if ($from == $to) {
                echo $to;
            } else {
                echo $from . ' -> ' . $to;
            } ?></h5>
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
                        <td><?php if ($from == $to): ?>
                                <a class="btn badge-warning"
                                   href="./index.php?page=edit-timesheet&employeeNumber=<?php echo $timesheet['employeeNumber'] ?>&day=<?php echo $to ?>">Edit</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

