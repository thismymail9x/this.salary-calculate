<?php if (isset($_SESSION['message'])): ?>
    <script>
        alert("<?php echo $_SESSION['message'];
            unset($_SESSION['message'])?>")
    </script>
<?php endif; ?>
<div class="container m-t-50">
    <div class="card">
        <h5 class="card-header">Staffs</h5>
        <div class="card-body">
            <form class="form-inline" method="get">
                <a href="./index.php?page=add-employee" class="btn btn-success mb-2 m-r-10" >Add staff</a>
                <label class="sr-only" for="inlineFormInputName2">Name</label>
                <input name="keyword" size="30" type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Search">
                <input name="page" type="text" hidden value="search-list">
                <button type="submit" class="btn btn-primary mb-2">Search</button>
            </form>
            <table class="table" style="text-align: center">
                <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID</th>
                    <th scope="col">Avatar</th>
                    <th scope="col">Full name</th>
                    <th scope="col">Today worked</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($employees as $key => $employee): ?>
                    <tr>
                        <th scope="row"><?php echo ++$key ?></th>
                        <td><?php echo $employee->getEmployeeNumber() ?></td>
                        <td><img src="img/<?php echo $employee->getAvatar() ?>" width="100" height="100"></td>
                        <td>
                            <button type="button" class="btn btn-link" data-toggle="modal"
                                    data-target="#myModal-<?php echo $employee->getEmployeeNumber() ?>"><?php echo $employee->getName()?>
                            </button>
                        </td>
                        <td style="text-align: center"><?php if (isExist($employee->getEmployeeNumber(), $checkedEmployees)) {
                                echo "<i style='color: green' class=\"fas fa-check-circle\"></i>";
                            } ?></td>
                        <td><a href="./index.php?page=timekeeping&id=<?php echo $employee->getEmployeeNumber() ?>"
                               class="btn btn-success">Timekeeping</a>
                        </td>

                    </tr>
                    <div id="myModal-<?php echo $employee->getEmployeeNumber() ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><img src="img/<?php echo $employee->getAvatar() ?>" width="100" height="100" style="border-radius: 50%"></h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <h5><span>Gender:</span> <?php echo $employee->getGender() ?></h5>
                                    <h5><span>Date of birth: </span> <?php echo $employee->getDateOfBirth() ?></h5>
                                    <h5><span>Email: </span><?php echo $employee->getEmail() ?></h5>
                                    <h5><span>Phone: </span><?php echo $employee->getPhone() ?></h5>
                                    <h5><span>Address: </span><?php echo $employee->getAddress() ?></h5>
                                    <h5><span>Position: </span><?php echo $employee->getPosition() ?></h5>
                                </div>
                                <div class="modal-footer">
                                    <a type="button"  class="btn btn-warning" href="./index.php?page=edit-employee&id=<?php echo $employee->getEmployeeNumber() ?>">Edit</a>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?php echo $employee->getEmployeeNumber() ?>">Delete</button>
                                    <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="exampleModal<?php echo $employee->getEmployeeNumber() ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure ?
                                </div>
                                <div class="modal-footer">
                                    <form method="post">
                                        <input type="text" name="id" value="<?php echo $employee->getEmployeeNumber() ?>" hidden>
                                        <input type="text" name="page" value="delete-employee" hidden>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>

</script>

