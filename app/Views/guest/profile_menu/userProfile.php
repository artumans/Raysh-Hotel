<div id="main-content">
    <h3 class="mb-4">Profile :</h3>
    <form id="form-profile" class="row g-3">
        <div class="col-md-6">
            <label for="userEmail" class="form-label">Email</label>
            <input type="email" class="form-control bg-dark-subtle" name="userEmail" id="userEmail" data-bs-default="<?=$_SESSION['user']['email']?>" value="<?=$_SESSION['user']['email']?>" readonly>
        </div>
        <div class="col-md-6">
            <label for="userName" class="form-label">Username</label>
            <input type="text" class="form-control bg-dark-subtle" name="userName" id="userName" data-bs-default="<?=$_SESSION['user']['nama']?>" value="<?=$_SESSION['user']['nama']?>" readonly>
        </div>
        <div class="col-md-6">
            <label for="userPhone" class="form-label">Phone number</label>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1">+62</span>
                <input type="number" class="form-control bg-dark-subtle" name="userPhone" id="userPhone" data-bs-default="<?= ($_SESSION['user']['no_telepon'][0] == '0')? substr($_SESSION['user']['no_telepon'], 1) : $_SESSION['user']['no_telepon'] ?>" value="<?= ($_SESSION['user']['no_telepon'][0] == '0')? substr($_SESSION['user']['no_telepon'], 1) : $_SESSION['user']['no_telepon'] ?>" readonly>
            </div>
        </div>
        <div class="col-md-6">
            <label for="userAddr" class="form-label">Address</label>
            <input type="text" class="form-control bg-dark-subtle" name="userAddr" id="userAddr" data-bs-default="<?=$_SESSION['user']['alamat']?>" value="<?=$_SESSION['user']['alamat']?>" readonly>
        </div>
        <div class="col-12 mt-5 text-center">
            <button type="button" id="btn-edit" onclick="enEdit()" class="col-4">Edit Profile</button>
            <button type="button" id="btn-cancel" onclick="cEdit()" class="btn col-4 btn-danger visually-hidden">Cancel</button>
            <button type="button" id="btn-confirm" onclick="cChanges()" class="btn col-4 btn-primary visually-hidden">Confirm changes</button>
            <button type="submit" id="btn-save" class="btn col-4 btn-success visually-hidden" formaction="<?=base_url('profile/updateuser/'.$_SESSION['user']['id_tamu'])?>" formmethod="post">Save changes</button>
        </div>
    </form>
</div>