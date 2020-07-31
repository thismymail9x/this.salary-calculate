<div class="container m-t-50">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 form-div" style="border: 1px solid #e0e0e0; padding: 20px">
            <form method="post" enctype="multipart/form-data">
                <h3 class="text-center text-primary">Add employee</h3>
                <div class="form-group">
                    <label for="name">Full name <span style="color:red;">*</span></label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Full name">
                </div>
               <div class="form-group">
                   <label>Gender <span style="color:red;">*</span></label>
                   <div class="form-check form-check-inline">
                       <input type="radio" id="male" name="gender" class="form-check-input" value="Male" checked>
                       <label class="form-check-label" for="male">Male</label>
                   </div>
                   <div class="form-check form-check-inline">
                       <input type="radio" class="form-check-input" id="female" name="gender" value="Female">
                       <label for="female" class="form-check-label">Female</label>
                   </div>
               </div>
                <div class="form-group">
                    <label for="date-of-birth">Date of birth <span style="color:red;">*</span></label>
                    <input type="date" name="date-of-birth" id="date-of-birth">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Email address <span style="color:red;">*</span></label>
                    <input type="email" name="email" class="form-control" id="exampleFormControlInput1"
                           placeholder="name@example.com">
                </div>
                <div class="form-group">
                    <label for="phone">Phone<span style="color:red;">*</span></label>
                    <input type="text" name="phone" id="employee-number" class="form-control">
                </div>
                <div class="form-group">
                    <label for="address">Address <span style="color:red;">*</span></label>
                    <input type="text" name="address" id="address" class="form-control">
                </div>
                <div class="form-group">
                    <label for="position">Job Title <span style="color:red;">*</span></label>
                    <select name="position" id="position" class="form-control">
                        <?php foreach ($positionList as $position):?>
                        <option value="<?php echo $position['positionId']?>"><?php echo $position['name']?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="avatar">Avatar</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="avatar" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">
                            <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Confirm</button>
                <button class="btn btn-secondary" onclick="window.history.go(-1); return false;">Cancel</button>
            </form>
        </div>
    </div>

</div>
