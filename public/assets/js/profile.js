const nav = document.getElementById('user-menu');
function setActive(id) {
    var thisMenu = document.getElementById(`${id}`);
    if (!thisMenu.classList.contains('.active-menu')) {
        const activeMenu = nav.querySelector('.active-menu');
        activeMenu.classList.remove('active-menu');
        thisMenu.classList.add('active-menu');
        $.ajax({
            type: "GET",
            url: thisMenu.getAttribute('data-bs-value'),
            success: function (response) {
                const main_content = document.getElementById('content-container');
                main_content.innerHTML = response;
            }
        });
    }
}

function enEdit() {
    const btnEdit = document.getElementById('btn-edit');
    btnEdit.classList.add('visually-hidden');

    const btnCancel = document.getElementById('btn-cancel');
    btnCancel.classList.remove('visually-hidden');

    const btnConfirm = document.getElementById('btn-confirm');
    btnConfirm.classList.remove('visually-hidden');

    var all_input = document.querySelectorAll('.form-control');
    console.log(all_input);
    for (let i = 0; i < all_input.length; i++) {
        const element = all_input[i];
        element.removeAttribute('readonly');
        element.classList.remove('bg-dark-subtle');
        
    }
}

function cEdit() {
    const btnCancel = document.getElementById('btn-cancel');
    btnCancel.classList.add('visually-hidden');

    const btnConfirm = document.getElementById('btn-confirm');
    btnConfirm.classList.add('visually-hidden');

    const btnEdit = document.getElementById('btn-edit');
    btnEdit.classList.remove('visually-hidden');

    const btnSave = document.getElementById('btn-save');
    if (!btnSave.classList.contains('visually-hidden')) {
        btnSave.classList.add('visually-hidden');
    }

    const confirmPassword = document.getElementById('confirm-password');
    if (confirmPassword) {
        confirmPassword.remove();
    }

    const formProfile = document.getElementById('form-profile');
    const getAlert = formProfile.lastElementChild;
    if (getAlert.classList.contains("alert")) {
        formProfile.removeChild(formProfile.lastElementChild);
    }

    var all_input = formProfile.querySelectorAll('.form-control');
    for (let i = 0; i < all_input.length; i++) {
        const element = all_input[i];
        if (element.getAttribute('name') != "userPass") {
            const defValue = element.getAttribute('data-bs-default');
            element.value= defValue;
            element.setAttribute("value", defValue);
            element.readOnly = true;
            element.classList.add('bg-dark-subtle');
        }
        
    }
}


function cChanges() {

    var isChanged = false;
    const formProfile = document.getElementById('form-profile');

    var all_input = formProfile.querySelectorAll('.form-control');
    for (let i = 0; i < all_input.length; i++) {
        const element = all_input[i];
        console.log(element.getAttribute('name'), "=", element.value);
        if (element.getAttribute('name') != "userPass") {  
            const defValue = element.getAttribute('data-bs-default');
            if (defValue == element.value) {
                isChanged = false;
            } else {
                isChanged = true;
                break;
            }
        }
    }

    if (isChanged != false) {
        const btnConfirm = document.getElementById('btn-confirm');
        btnConfirm.classList.add('visually-hidden');
    
        const btnSave = document.getElementById('btn-save');
        btnSave.classList.remove('visually-hidden');

        
        const getAlert = formProfile.lastElementChild;
        if (getAlert.classList.contains("alert")) {
            formProfile.removeChild(formProfile.lastElementChild);
        }



        const passDiv = document.createElement("div");
        passDiv.classList.add("col-12", "mt-5", "text-center");
        passDiv.setAttribute("id", "confirm-password")

        const passLabel = document.createElement("label");
        passLabel.setAttribute("for", "userPass");
        passLabel.classList.add("form-label");
        passLabel.innerHTML = "Enter your password to save changes :";


        const passInputDiv = document.createElement("div");
        passInputDiv.classList.add("col-6", "mx-auto");

        const passInput = document.createElement("input");
        passInput.setAttribute("type", "password");
        passInput.classList.add("form-control");
        passInput.setAttribute("name", "userPass");
        passInput.setAttribute("id", "userPass");

        passInputDiv.appendChild(passInput);
        passDiv.appendChild(passLabel);
        passDiv.appendChild(passInputDiv);

        formProfile.insertBefore(passDiv, formProfile.children[formProfile.childElementCount-1]);
        
    } else {

        const checkAlert = formProfile.lastElementChild;
        if (!checkAlert.classList.contains("alert")) {
            const alertDiv = document.createElement("div");
            alertDiv.classList.add("alert", "alert-warning");
            alertDiv.setAttribute("role", "alert");
            alertDiv.innerHTML = "Tidak ada perubahan data !";
            formProfile.appendChild(alertDiv);
        }
    }


}

const payBtn = document.getElementById('finishPaymentBtn');
if (payBtn) {
    var snapToken = payBtn.getAttribute('data-bs-snaptoken');
    payBtn.addEventListener("click", function() {
        snap.pay(snapToken, {
            onSuccess: function(result){
                location.reload(true);
            },
            onPending: function(result){
                
            },
            onError: function(result){
                
            }
        });
    })
}

// if (paymentModal) {
//     paymentModal.addEventListener('show.bs.modal', event => {
//         // Button that triggered the modal
//         const button = event.relatedTarget;
//         const snapToken = button.getAttribute('data-bs-snaptoken');

//     });
// }