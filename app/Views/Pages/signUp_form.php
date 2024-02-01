<?php echo session()->getFlashdata('f_su'); ?>
<div class="row g-3">
    <div class="col-md-6">
        <label for="userEmail" class="form-label">Email</label>
        <input type="email" class="form-control" name="userEmail" id="userEmail" required>
    </div>
    <div class="col-md-6">
        <label for="userName" class="form-label">Username</label>
        <input type="text" class="form-control" name="userName" id="userName" required>
    </div>
    <div class="col-md-6">
        <label for="userPhone" class="form-label">Phone number</label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1">+62</span>
            <input type="number" class="form-control" name="userPhone" id="userPhone" required>
        </div>
    </div>
    <div class="col-md-6">
        <label for="userPass" class="form-label">Password</label>
        <input type="password" class="form-control" name="userPass" id="userPass" required>
    </div>
    <div class="col-12">
        <label for="userAddr" class="form-label">Address</label>
        <input type="text" class="form-control" name="userAddr" id="userAddr" required>
    </div>
    <div class="col-12 mt-5">
        <button type="submit" class="btn w-100" formaction="<?=base_url('/signup')?>" formmethod="post">Sign Up</button>
    </div>
</div>