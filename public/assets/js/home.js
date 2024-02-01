$('#formBookData').on("submit", function() {
    var bookData = $(this).serializeArray();
    console.log("OLD",bookData);

    $.ajax({
        type: 'POST',
        url: $('#sendDataBtn').attr('value'),
        data: bookData,
        success: function(snapToken) {
            snap.pay(snapToken, {
                onSuccess: function(result){

                    console.log(JSON.stringify(result, null, 2));
                    let dataResult = JSON.stringify(result, null, 2);
                    let resultObj = JSON.parse(dataResult);


                    bookData.push({name: 'status', value: 'PAID'});
                    bookData.push({name: 'payment_type', value: resultObj.payment_type});
                    bookData.push({name: 'bank', value: resultObj.va_numbers[0].bank});
                    bookData.push({name: 'va_number', value: resultObj.va_numbers[0].va_number});
                    bookData.push({name: 'kode_reservasi', value: resultObj.order_id});
                    bookData.push({name: 'timeStamp', value: resultObj.transaction_time});
                    bookData.push({name: 'snapToken', value: snapToken});
                    console.log("new",bookData);

                    $.ajax({
                        type: 'POST',
                        url: $('#sendDataBtn').attr('value')+"/setbook",
                        data: bookData,
                        success: function(data) {
                            const confirmModalContent = document.getElementById('confirmModal').querySelector('.modal-content');
                            confirmModalContent.innerHTML = data;
                            const confirmBtn = document.getElementById('confirmBtn');
                            if (confirmBtn) {
                                confirmBtn.addEventListener('click', function() {
                                    location.reload(true);
                                });
                            }
                
                            $('#bookingModal').modal('hide');
                            $('#confirmModal').modal('toggle');
                        }
                    });
                },
                onPending: function(result){

                    console.log(JSON.stringify(result, null, 2));
                    let dataResult = JSON.stringify(result, null, 2);
                    let resultObj = JSON.parse(dataResult);

                    bookData.push({name: 'status', value: 'PENDING'});
                    bookData.push({name: 'payment_type', value: resultObj.payment_type});
                    bookData.push({name: 'bank', value: resultObj.va_numbers[0].bank});
                    bookData.push({name: 'va_number', value: resultObj.va_numbers[0].va_number});
                    bookData.push({name: 'kode_reservasi', value: resultObj.order_id});
                    bookData.push({name: 'timeStamp', value: resultObj.transaction_time});
                    bookData.push({name: 'snapToken', value: snapToken});
                    console.log("new",bookData);

                    $.ajax({
                        type: 'POST',
                        url: $('#sendDataBtn').attr('value')+"/setbook",
                        data: bookData,
                        success: function(data) {
                            const confirmModalContent = document.getElementById('confirmModal').querySelector('.modal-content');
                            confirmModalContent.innerHTML = data;
                            const confirmBtn = document.getElementById('confirmBtn');
                            if (confirmBtn) {
                                confirmBtn.addEventListener('click', function() {
                                    location.reload(true);
                                });
                            }
                
                            $('#bookingModal').modal('hide');
                            $('#confirmModal').modal('toggle');
                        }
                    });
                },
                onError: function(result){
                    console.log(document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2));
                }
            });
        }
    });
    // $.ajax({
    //     type: 'POST',
    //     url: $('#sendDataBtn').attr('value'),
    //     data: bookData,
    //     success: function(data) {
    //         const confirmModalContent = document.getElementById('confirmModal').querySelector('.modal-content');
    //         confirmModalContent.innerHTML = data;
    //         const confirmBtn = document.getElementById('confirmBtn');
    //         if (confirmBtn) {
    //             confirmBtn.addEventListener('click', function() {
    //                 location.reload(true);
    //             });
    //         }

    //         $('#bookingModal').modal('hide');
    //         $('#confirmModal').modal('toggle');
    //     }
    // });
    return false;
});



const bookingModal = document.getElementById('bookingModal');
function formLooper(roomType, value) {
    const modalBody = bookingModal.querySelector('.modal-body');
    if (parseInt(roomType) == 3) {  
        var setMaxInputJumKamar = document.getElementById('prajurit-counter');
        if (!value) {
            var currentValue = 1;
        } else if (parseInt(value) > parseInt(setMaxInputJumKamar.max)) {
            var currentValue = setMaxInputJumKamar.max;
        } else {
            var currentValue = value;
        }
        var previousValue = modalBody.childElementCount-1;
        setMaxInputJumKamar.value = currentValue;
        setMaxInputJumKamar.setAttribute("value", currentValue);

        const durasiInap = bookingModal.querySelector('.durasi-inap').value;

        const hargaKamar = bookingModal.querySelector('.roomprice').value;
        const newTotalHarga = (hargaKamar * currentValue) * durasiInap;

        const setTotalHarga = bookingModal.querySelector('.totalprice');
        const newValue = parseInt(newTotalHarga);
        setTotalHarga.value = newValue;
        setTotalHarga.setAttribute("value", newValue);
        
        let htmlFormLooper = ``;

        if (previousValue <= currentValue) {
            for (let i = previousValue; i < currentValue; i++) {
                htmlFormLooper += `
                <div>
                    <label class="mt-3" class="form-label">Room ${i+1} :</label>
                    <div class="input-group">
                        <span class="input-group-text">NIK :</span>
                        <input type="text" name="bookArray[prajurit][${i+1}][nik]" aria-label="NIK" class="form-control" required>
                        <span class="input-group-text">Nama :</span>
                        <input type="text" name="bookArray[prajurit][${i+1}][name]" aria-label="Name" class="form-control" required>
                    </div>
                </div>
                `;
            }
            modalBody.innerHTML += htmlFormLooper;

        } else if ((previousValue > currentValue) && (previousValue+1 > 2)) {
            for (let i = previousValue; i > currentValue; i--) {
                modalBody.removeChild(modalBody.children[i]);
            }
        }
    } else if (parseInt(roomType) == 2) {
        var setMaxInputJumKamar = document.getElementById('panglima-counter');
        if (!value) {
            var currentValue = 1;
        } else if (parseInt(value) > parseInt(setMaxInputJumKamar.max)) {
            var currentValue = setMaxInputJumKamar.max;
        } else {
            var currentValue = value;
        }
        var previousValue = modalBody.childElementCount-1;
        setMaxInputJumKamar.value = currentValue;
        setMaxInputJumKamar.setAttribute("value", currentValue);

        const durasiInap = bookingModal.querySelector('.durasi-inap').value;

        const hargaKamar = bookingModal.querySelector('.roomprice').value;
        const newTotalHarga = (hargaKamar * currentValue) * durasiInap;

        const setTotalHarga = bookingModal.querySelector('.totalprice');
        const newValue = parseInt(newTotalHarga);
        setTotalHarga.value = newValue;
        setTotalHarga.setAttribute("value", newValue);


        let htmlFormLooper = ``;

        if (previousValue <= currentValue) {
            for (let i = previousValue; i < currentValue; i++) {
                htmlFormLooper += `
                <div>
                    <label class="mt-3" class="form-label">Room ${i+1} :</label>
                    <div class="ms-md-2">
                        <label class="mt-3" class="form-label">Guest 1 :</label>
                        <div class="input-group">
                            <span class="input-group-text">NIK :</span>
                            <input type="text" name="bookArray[panglima][${i+1}][guest1][nik]" aria-label="NIK" class="form-control" required>
                            <span class="input-group-text">Nama :</span>
                            <input type="text" name="bookArray[panglima][${i+1}][guest1][name]" aria-label="Name" class="form-control" required>
                        </div>
                        <label class="mt-3" class="form-label">Guest 2 :</label>
                        <div class="input-group mb-4">
                            <span class="input-group-text">NIK :</span>
                            <input type="text" name="bookArray[panglima][${i+1}][guest2][nik]" aria-label="NIK" class="form-control">
                            <span class="input-group-text">Nama :</span>
                            <input type="text" name="bookArray[panglima][${i+1}][guest2][name]" aria-label="Name" class="form-control">
                        </div>
                    </div>
                </div>
                `;
            }
            modalBody.innerHTML += htmlFormLooper;
        } else if ((previousValue > currentValue) && (previousValue+1 > 2)) {
            for (let i = previousValue; i > currentValue; i--) {
                modalBody.removeChild(modalBody.children[i]);
            }
        }

    } else if (parseInt(roomType) == 1) {
        var setMaxInputJumKamar = document.getElementById('baginda-counter');
        if (!value) {
            var currentValue = 1;
        } else if (parseInt(value) > parseInt(setMaxInputJumKamar.max)) {
            var currentValue = setMaxInputJumKamar.max;
        } else {
            var currentValue = value;
        }
        var previousValue = modalBody.childElementCount-1;
        setMaxInputJumKamar.value = currentValue;
        setMaxInputJumKamar.setAttribute("value", currentValue);

        const durasiInap = bookingModal.querySelector('.durasi-inap').value;

        const hargaKamar = bookingModal.querySelector('.roomprice').value;
        const newTotalHarga = (hargaKamar * currentValue) * durasiInap;

        const setTotalHarga = bookingModal.querySelector('.totalprice');
        const newValue = parseInt(newTotalHarga);
        setTotalHarga.value = newValue;
        setTotalHarga.setAttribute("value", newValue);


        let htmlFormLooper = ``;

        if (previousValue <= currentValue) {
            for (let i = previousValue; i < currentValue; i++) {
                htmlFormLooper += `
                <div>
                    <label class="mt-3" class="form-label">Room ${i+1} :</label>
                    <div class="ms-md-2">
                        <label class="mt-3" class="form-label">Guest 1 :</label>
                        <div class="input-group">
                            <span class="input-group-text">NIK :</span>
                            <input type="text" name="bookArray[baginda][${i+1}][guest1][nik]" aria-label="NIK" class="form-control" required>
                            <span class="input-group-text">Nama :</span>
                            <input type="text" name="bookArray[baginda][${i+1}][guest1][name]" aria-label="Name" class="form-control" required>
                        </div>
                        <label class="mt-3" class="form-label">Guest 2 :</label>
                        <div class="input-group mb-4">
                            <span class="input-group-text">NIK :</span>
                            <input type="text" name="bookArray[baginda][${i+1}][guest2][nik]" aria-label="NIK" class="form-control">
                            <span class="input-group-text">Nama :</span>
                            <input type="text" name="bookArray[baginda][${i+1}][guest2][name]" aria-label="Name" class="form-control">
                        </div>
                    </div>
                </div>
                `;
            }
            modalBody.innerHTML += htmlFormLooper;

        } else if ((previousValue > currentValue) && (previousValue+1 > 2)) {
            for (let i = previousValue; i > currentValue; i--) {
                modalBody.removeChild(modalBody.children[i]);
            }
        }
    }
}

if (bookingModal) {
    bookingModal.addEventListener('show.bs.modal', event => {
        // Button that triggered the modal
        const button = event.relatedTarget;
        // Extract info from data-bs-* attributes
        const roomName = button.getAttribute('data-bs-roomname');
        const roomType = button.getAttribute('data-bs-roomtype');
        const roomPrice = button.getAttribute('data-bs-roomprice');
        var availRoom = parseInt(button.getAttribute('data-bs-roomavail'));
        // If necessary, you could initiate an Ajax request here
        // and then do the updating in a callback.

        // Update the modal's content.
        const modalTitle = bookingModal.querySelector('.modal-title');
        const spanRoomType = bookingModal.querySelector('.span-roomType');


        const checkInDate = document.getElementById('dp_checkIn_2').value;
        const checkOutDate = document.getElementById('dp_checkOut_2').value;
        const date1 = new Date(checkInDate);
        const date2 = new Date(checkOutDate);
        const diffTime = Math.abs(date2 - date1);
        const durasiInap = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

        
        const modalBody = bookingModal.querySelector('.modal-body');
        
        modalTitle.textContent = `Booking form : ${roomName} room`;
        spanRoomType.textContent = `${roomType}`;


        if (parseInt(roomType) == 3) {
            modalBody.innerHTML = `
            <div class="row g-2">
                <input class="visually-hidden" type="date" value="${checkInDate}" name="dp_checkIn">
                <input class="visually-hidden" type="date" value="${checkOutDate}" name="dp_checkOut">
                <div class="col-md-6 mb-1">
                    <label>Check In :</label>
                    <input type="text" class="form-control bg-body-secondary" value="${checkInDate}" readonly>
                </div>
                <div class="col-md-6 mb-1">
                    <label>Check Out :</label>
                    <input type="text" class="form-control bg-body-secondary" value="${checkOutDate}" readonly>
                </div>
                <div class="col-md-6 mb-1">
                    <label>Harga<sub>/malam</sub></label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" class="form-control roomprice bg-body-secondary" name="bookArray[prajurit][hargaPerMalam]" value="${roomPrice}" readonly>
                    </div>
                </div>
                <div class="col-md-6 mb-1">
                    <label>Total Harga :</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" class="form-control totalprice bg-body-secondary" name="bookArray[prajurit][totalHarga]" value="${roomPrice * durasiInap}" readonly>
                    </div>
                </div>
                <div class="col-md-6 mb-1">
                    <label>Durasi Inap :</label>
                    <div class="input-group mb-3 counter">
                        <input type="text" class="form-control durasi-inap bg-body-secondary" name="bookArray[prajurit][durasiInap]" value="${durasiInap}" readonly>
                        <span class="input-group-text">malam</span>
                    </div>
                </div>
                <div class="col-md-6 mb-1">
                    <label>Jumlah Kamar :</label>
                    <div class="input-group mb-3 counter">
                        <input id="prajurit-counter" type="number" name="bookArray[prajurit][jumKamar]" class="form-control input-jumKamar text-center" min="1">
                    </div>
                </div>
            </div>
            <div>
                <label class="mt-3" class="form-label">Room 1 :</label>
                <div class="input-group">
                    <span class="input-group-text">NIK :</span>
                    <input type="text" name="bookArray[prajurit][1][nik]" aria-label="NIK" class="form-control" required>
                    <span class="input-group-text">Nama :</span>
                    <input type="text" name="bookArray[prajurit][1][name]" aria-label="Name" class="form-control" required>
                </div>
            </div>
            `;

            var setMaxInputJumKamar = document.getElementById('prajurit-counter');
            setMaxInputJumKamar.max = availRoom;
            setMaxInputJumKamar.value = 1;
            setMaxInputJumKamar.setAttribute("maxlength", 1);
            setMaxInputJumKamar.setAttribute("onchange", "formLooper(3, this.value)");

        } else if (parseInt(roomType) == 2) {
            modalBody.innerHTML = `
            <div class="row g-2">
                <input class="visually-hidden" type="date" value="${checkInDate}" name="dp_checkIn">
                <input class="visually-hidden" type="date" value="${checkOutDate}" name="dp_checkOut">
                <div class="col-md-6 mb-1">
                    <label>Check In :</label>
                    <input type="text" class="form-control bg-body-secondary" value="${checkInDate}" readonly>
                </div>
                <div class="col-md-6 mb-1">
                    <label>Check Out :</label>
                    <input type="text" class="form-control bg-body-secondary" value="${checkOutDate}" readonly>
                </div>
                <div class="col-md-6 mb-1">
                    <label>Harga<sub>/malam</sub></label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" class="form-control roomprice bg-body-secondary" name="bookArray[panglima][hargaPerMalam]" value="${roomPrice}" readonly>
                    </div>
                </div>
                <div class="col-md-6 mb-1">
                    <label>Total Harga :</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" class="form-control totalprice bg-body-secondary" name="bookArray[panglima][totalHarga]" value="${roomPrice * durasiInap}" readonly>
                    </div>
                </div>
                <div class="col-md-6 mb-1">
                    <label>Durasi Inap :</label>
                    <div class="input-group mb-3 counter">
                        <input type="text" class="form-control durasi-inap bg-body-secondary" name="bookArray[panglima][durasiInap]" value="${durasiInap}" readonly>
                        <span class="input-group-text">malam</span>
                    </div>
                </div>
                <div class="col-md-6 mb-1">
                    <label>Jumlah Kamar :</label>
                    <div class="input-group mb-3 counter">
                        <input id="panglima-counter" type="number" name="bookArray[panglima][jumKamar]" class="form-control input-jumKamar text-center" min="1">
                    </div>
                </div>
            </div>
            <div>
                <label class="mt-3" class="form-label">Room 1 :</label>
                <div class="ms-md-2">
                    <label class="mt-3" class="form-label">Guest 1 :</label>
                    <div class="input-group">
                        <span class="input-group-text">NIK :</span>
                        <input type="text" name="bookArray[panglima][1][guest1][nik]" aria-label="NIK" class="form-control" required>
                        <span class="input-group-text">Nama :</span>
                        <input type="text" name="bookArray[panglima][1][guest1][name]" aria-label="Name" class="form-control" required>
                    </div>
                    <label class="mt-3" class="form-label">Guest 2 :</label>
                    <div class="input-group mb-4">
                        <span class="input-group-text">NIK :</span>
                        <input type="text" name="bookArray[panglima][1][guest2][nik]" aria-label="NIK" class="form-control">
                        <span class="input-group-text">Nama :</span>
                        <input type="text" name="bookArray[panglima][1][guest2][name]" aria-label="Name" class="form-control">
                    </div>
                </div>
            </div>`;

            var setMaxInputJumKamar = document.getElementById('panglima-counter');
            setMaxInputJumKamar.max = availRoom;
            setMaxInputJumKamar.value = 1;
            setMaxInputJumKamar.setAttribute("maxlength", 1);
            setMaxInputJumKamar.setAttribute("onchange", "formLooper(2, this.value)");

        } else if (parseInt(roomType) == 1) {
            modalBody.innerHTML = `
            <div class="row g-2">
                <input class="visually-hidden" type="date" value="${checkInDate}" name="dp_checkIn">
                <input class="visually-hidden" type="date" value="${checkOutDate}" name="dp_checkOut">
                <div class="col-md-6 mb-1">
                    <label>Check In :</label>
                    <input type="text" class="form-control bg-body-secondary" value="${checkInDate}" readonly>
                </div>
                <div class="col-md-6 mb-1">
                    <label>Check Out :</label>
                    <input type="text" class="form-control bg-body-secondary" value="${checkOutDate}" readonly>
                </div>
                <div class="col-md-6 mb-1">
                    <label>Harga<sub>/malam</sub></label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" class="form-control roomprice bg-body-secondary" name="bookArray[baginda][hargaPerMalam]" value="${roomPrice}" readonly>
                    </div>
                </div>
                <div class="col-md-6 mb-1">
                    <label>Total Harga :</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" class="form-control totalprice bg-body-secondary" name="bookArray[baginda][totalHarga]" value="${roomPrice * durasiInap}" readonly>
                    </div>
                </div>
                <div class="col-md-6 mb-1">
                    <label>Durasi Inap :</label>
                    <div class="input-group mb-3 counter">
                        <input type="text" class="form-control durasi-inap bg-body-secondary" name="bookArray[baginda][durasiInap]" value="${durasiInap}" readonly>
                        <span class="input-group-text">malam</span>
                    </div>
                </div>
                <div class="col-md-6 mb-1">
                    <label>Jumlah Kamar :</label>
                    <div class="input-group mb-3 counter">
                        <input id="baginda-counter" type="number" name="bookArray[baginda][jumKamar]" class="form-control input-jumKamar text-center" min="1">
                    </div>
                </div>
            </div>
            <div>
                <label class="mt-3" class="form-label">Room 1 :</label>
                <div class="ms-md-2">
                    <label class="mt-3" class="form-label">Guest 1 :</label>
                    <div class="input-group">
                        <span class="input-group-text">NIK :</span>
                        <input type="text" name="bookArray[baginda][1][guest1][nik]" aria-label="NIK" class="form-control" required>
                        <span class="input-group-text">Nama :</span>
                        <input type="text" name="bookArray[baginda][1][guest1][name]" aria-label="Name" class="form-control" required>
                    </div>
                    <label class="mt-3" class="form-label">Guest 2 :</label>
                    <div class="input-group mb-4">
                        <span class="input-group-text">NIK :</span>
                        <input type="text" name="bookArray[baginda][1][guest2][nik]" aria-label="NIK" class="form-control">
                        <span class="input-group-text">Nama :</span>
                        <input type="text" name="bookArray[baginda][1][guest2][name]" aria-label="Name" class="form-control">
                    </div>
                </div>
            </div>`;

            var setMaxInputJumKamar = document.getElementById('baginda-counter');
            setMaxInputJumKamar.max = availRoom;
            setMaxInputJumKamar.value = 1;
            setMaxInputJumKamar.setAttribute("onchange", "formLooper(1, this.value)");
            setMaxInputJumKamar.setAttribute("maxlength", 1);
        }
    });
    
}


function setCheckOut_dp2() {
    var getCheckIn = document.getElementById('dp_checkIn').value;
    var checkIn = new Date(getCheckIn);
    var checkOut = checkIn.setDate(checkIn.getDate() + 1);
    var maxCheckOut = checkIn.setMonth(checkIn.getMonth() + 1);
    var setCheckOut = new Date(checkOut);
    var setMaxCheckOut = new Date(maxCheckOut);

    var tahun = new String(setCheckOut.getFullYear());
    var bulan = new String(setCheckOut.getMonth() + 1);
    var hari = new String(setCheckOut.getDate());

    var tahunMax = new String(setMaxCheckOut.getFullYear());
    var bulanMax = new String(setMaxCheckOut.getMonth() + 1);
    var hariMax = new String(setMaxCheckOut.getDate());
    console.log(setMaxCheckOut);
    if (bulan.length == 1) {
        if (hari.length == 1) {
            var final = tahun + '-0' + bulan + '-0' + hari;
            var finalMax = tahunMax + '-0' + bulanMax + '-0' + hariMax;
        } else {
            var final = tahun + '-0' + bulan + '-' + hari;
            var finalMax = tahunMax + '-0' + bulanMax + '-' + hariMax;
        }
    } else {
        if (hari.length == 1) {
            var final = tahun + '-' + bulan + '-0' + hari;
            var finalMax = tahunMax + '-' + bulanMax + '-0' + hariMax;
        } else {
            var final = tahun + '-' + bulan + '-' + hari;
            var finalMax = tahunMax + '-' + bulanMax + '-' + hariMax;
        }
    }
    console.log(finalMax);

    document.getElementById('dp_checkOut').value = final;
    document.getElementById('dp_checkOut').min = final;
    document.getElementById('dp_checkOut').max = finalMax;

    document.getElementById('dp_checkIn_2').value = getCheckIn;
    document.getElementById('dp_checkOut_2').value = final;
    document.getElementById('dp_checkOut_2').min = final;
    document.getElementById('dp_checkOut_2').max = finalMax;
}

function setCheckOut_dp1() {
    var getCheckIn = document.getElementById('dp_checkIn_2').value;
    var checkIn = new Date(getCheckIn);
    var checkOut = checkIn.setDate(checkIn.getDate() + 1);
    var maxCheckOut = checkIn.setMonth(checkIn.getMonth() + 1);
    var setCheckOut = new Date(checkOut);
    var setMaxCheckOut = new Date(maxCheckOut);

    var tahun = new String(setCheckOut.getFullYear());
    var bulan = new String(setCheckOut.getMonth() + 1);
    var hari = new String(setCheckOut.getDate());

    var tahunMax = new String(setMaxCheckOut.getFullYear());
    var bulanMax = new String(setMaxCheckOut.getMonth() + 1);
    var hariMax = new String(setMaxCheckOut.getDate());
    console.log(setMaxCheckOut);
    if (bulan.length == 1) {
        if (hari.length == 1) {
            var final = tahun + '-0' + bulan + '-0' + hari;
            var finalMax = tahunMax + '-0' + bulanMax + '-0' + hariMax;
        } else {
            var final = tahun + '-0' + bulan + '-' + hari;
            var finalMax = tahunMax + '-0' + bulanMax + '-' + hariMax;
        }
    } else {
        if (hari.length == 1) {
            var final = tahun + '-' + bulan + '-0' + hari;
            var finalMax = tahunMax + '-' + bulanMax + '-0' + hariMax;
        } else {
            var final = tahun + '-' + bulan + '-' + hari;
            var finalMax = tahunMax + '-' + bulanMax + '-' + hariMax;
        }
    }
    console.log(final);
    document.getElementById('dp_checkOut_2').value = final;
    document.getElementById('dp_checkOut_2').min = final;
    document.getElementById('dp_checkOut_2').max = finalMax;

    document.getElementById('dp_checkIn').value = getCheckIn;
    document.getElementById('dp_checkOut').value = final;
    document.getElementById('dp_checkOut').min = final;
    document.getElementById('dp_checkOut').max = finalMax;
}

document.addEventListener("DOMContentLoaded", function() {
    new TypeIt("#heading-hero", {
        strings: ["Affordable, Quality, and Comfort."],
    }).go();
});