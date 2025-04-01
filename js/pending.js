function signOut() {
	document.getElementById('overlayBg').classList.add('active');
    document.getElementById('signOutForm').classList.add('active');
}

function cancelSignOut() {
	document.getElementById('overlayBg').classList.remove('active');
    document.getElementById('signOutForm').classList.remove('active');
}

function showUpdateForm() {
	document.getElementById('overlayBg').classList.add('active');
    document.getElementById('updateForm').classList.add('active');
}

function hideUpdateForm() {
    document.getElementById('overlayBg').classList.remove('active');
    document.getElementById('updateForm').classList.remove('active');
}

function validatePrimaryID() {
    const fileInput = document.getElementById('primaryid');
    const error = document.getElementById('primaryid-error');
    const allowedFormats = ["image/jpeg", "image/png", "image/gif"];
    const maxSize = 2 * 1024 * 1024;
    if (fileInput.files.length === 0) {
        error.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>Please insert an image to upload!</p>";
        error.style.display = 'block';
        return false;
    }

    const file = fileInput.files[0];

    if (!allowedFormats.includes(file.type)) {
        error.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>Invalid file format! Only JPG, PNG, and GIF are allowed.</p>";
        error.style.display = 'block';
        return false;
    }

    if (file.size > maxSize) {
        error.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>Please insert an image below 2MB!</p>";
        error.style.display = 'block';
        return false;
    }

    error.style.display = 'none';
    return true;
}

function validatePrimaryID2() {
    const fileInput = document.getElementById('primaryid2');
    const error = document.getElementById('primaryid2-error');
    const allowedFormats = ["image/jpeg", "image/png", "image/gif"];
    const maxSize = 2 * 1024 * 1024;
    if (fileInput.files.length === 0) {
        error.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>Please insert an image to upload!</p>";
        error.style.display = 'block';
        return false;
    }

    const file = fileInput.files[0];

    if (!allowedFormats.includes(file.type)) {
        error.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>Invalid file format! Only JPG, PNG, and GIF are allowed.</p>";
        error.style.display = 'block';
        return false;
    }

    if (file.size > maxSize) {
        error.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>Please insert an image below 2MB!</p>";
        error.style.display = 'block';
        return false;
    }

    error.style.display = 'none';
    return true;
}

function validateUpdateFormDynamically() {
    const requiredFields = ['primaryid', 'primaryid2'];
    const error = document.getElementById('empty-error');
    let isValid = true;

    requiredFields.forEach((fieldId) => {
        const field = document.getElementById(fieldId);
        if (field.type === "file" && field.files.length === 0) {
            isValid = false;
        }
    });

    const primaryIdValid = validatePrimaryID();
    const primaryId2Valid = validatePrimaryID2();

    if (!isValid) {
        error.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>There are empty fields, please fill in all fields!</p>";
        error.style.display = 'block';
    } else if (!primaryIdValid || !primaryId2Valid) {
        error.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>There are incorrect fields, please adjust them properly.</p>";
        error.style.display = 'block';
        isValid = false;
    } else {
        error.innerHTML = "";
        error.style.display = 'none';
    }

    return isValid;
}

document.addEventListener("DOMContentLoaded", () => {
    const formFields = document.querySelectorAll('#pending-form input');
    const form = document.getElementById('pending-form');

    formFields.forEach((field) => {
        field.addEventListener('input', validateUpdateFormDynamically);
    });

    form.addEventListener('submit', (e) => {
        const isFormValid = validateUpdateFormDynamically();
        if (!isFormValid) {
            e.preventDefault();
        }
    });
});

function showPrimaryID(id) {
	document.getElementById("overlayBg").classList.add('active');
	document.getElementById("primaryID" + id).classList.add('active');
}

function hidePrimaryID(id) {
	document.getElementById("overlayBg").classList.remove('active');
	document.getElementById("primaryID" + id).classList.remove('active');
}

function showPrimaryID2(id) {
	document.getElementById("overlayBg").classList.add('active');
	document.getElementById("primaryID2" + id).classList.add('active');
}

function hidePrimaryID2(id) {
	document.getElementById("overlayBg").classList.remove('active');
	document.getElementById("primaryID2" + id).classList.remove('active');
}

$(document).ready(function () {
    function loadUsersVerification() {
        $.ajax({
            url: 'functions/load-users-verification.php',
            type: 'GET',
            cache: false,
            success: function (response) {
                if (response.includes('<html') || response.includes('<!DOCTYPE')) {
                    console.error('Unexpected HTML response (possible redirect).');
                    return;
                }
                $('#usersErrorAndButton').html(response);
            },
            error: function () {
                $('#usersErrorAndButton').html('<p class="error-message">No notifications.</p>');
            }
        });
    }

    loadUsersVerification();

    setInterval(loadUsersVerification, 30000);
});