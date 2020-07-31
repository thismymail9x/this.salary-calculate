<form method="post">
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-5" style="margin: auto">
                <label>Current Password</label>
                <div class="form-group pass_show">
                    <input type="password" name="current-password" class="form-control" placeholder="Current Password">
                </div>
                <div>
                    <span style="color: red">
                       <?php if (isset($_SESSION['current-password-err'])) {
                           echo $_SESSION['current-password-err'];
                           unset($_SESSION['current-password-err']);
                       } ?>
                    </span>
                </div>

                <label>New Password</label>
                <div class="form-group pass_show">
                    <input type="password" name="new-password" class="form-control" placeholder="New Password">
                </div>
                <div>
                    <span style="color: red" class="">
                       <?php if (isset($_SESSION['new-password-err'])) {
                           echo $_SESSION['new-password-err'];
                           unset($_SESSION['new-password-err']);
                       } ?>
                    </span>
                </div>

                <label>Confirm Password</label>
                <div class="form-group pass_show">
                    <input type="password" name="confirm-password" class="form-control" placeholder="Confirm Password">
                </div>
                <div>
                    <span style="color: red">
                       <?php if (isset($_SESSION['confirm-password-error'])) {
                           echo $_SESSION['confirm-password-error'];
                           unset($_SESSION['confirm-password-error']);
                       } ?>
                    </span>
                </div>
                <input type="submit" class="btn btn-primary" value="Confirm" name="submit">
                <a href="index.php" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </div>
</form>
