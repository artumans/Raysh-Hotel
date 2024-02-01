<?php echo session()->getFlashdata('f_si'); ?>
<div class="row mb-3">
    <label for="userEmail" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
        <input type="email" class="form-control" name="userEmail" id="userEmail" required>
    </div>
</div>
<div class="row mb-3">
    <label for="userPassword" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
        <input type="password" class="form-control" name="userPass" id="userPass" required>
    </div>
</div>
<button type="submit" class="btn w-100 mt-5" formaction="<?=base_url('/signin')?>" formmethod="post">Sign in</button>