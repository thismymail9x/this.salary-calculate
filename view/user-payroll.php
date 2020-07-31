<?php

?>
<div class="container mt-5">
    <form class="form-inline" method="get">
        <input type="month" name="day" class="form-control">
        <input type="text" name="page" value="search-payroll" hidden>
        <input type="submit" class="form-control m-l-10" value="Search">
    </form>
    <div class="card mt-2">
        <h5 class="card-header"><?php echo $day; ?></h5>
        <div class="card-body">
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th scope="col">Basic salary</th>
                    <th scope="col">Insurance</th>
                    <th scope="col">Overtime money</th>
                    <th scope="col">Fine</th>
                    <th scope="col">Total salary</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?php echo $payroll['basicSalary'] ?></td>
                    <td><?php echo $payroll['insurance'] ?></td>
                    <td><?php echo $payroll['overtimeMoney'] ?></td>
                    <td><?php echo $payroll['fine'] ?></td>
                    <td><?php echo $payroll['totalSalary'] ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

