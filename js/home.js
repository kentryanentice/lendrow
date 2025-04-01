let wrapper = document.querySelector('.wrapper'),
    signUpLink = document.querySelector('.link .signup-link'),
    signInLink = document.querySelector('.link .signin-link');

signUpLink.addEventListener('click', () => {
    wrapper.classList.add('animated-signin');
    wrapper.classList.remove('animated-signup');
});

signInLink.addEventListener('click', () => {
    wrapper.classList.add('animated-signup');
    wrapper.classList.remove('animated-signin');
});

const passwordInput = document.getElementById('signinpassword');
const togglePassword = document.getElementById('toggle');

togglePassword.addEventListener('click', () => {
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        togglePassword.classList.remove('bxs-lock');
        togglePassword.classList.add('bxs-lock-open');
    } else {
        passwordInput.type = 'password';
        togglePassword.classList.remove('bxs-lock-open');
        togglePassword.classList.add('bxs-lock');
    }
});

document.addEventListener("DOMContentLoaded", function() {
    const toggleIcon = document.getElementById("toggle");

    toggleIcon.addEventListener("click", function() {
        toggleIcon.classList.toggle("active");
    });
});

const passwordInput1 = document.getElementById('pass1');
const togglePassword1 = document.getElementById('toggle1');

togglePassword1.addEventListener('click', () => {
    if (passwordInput1.type === 'password') {
        passwordInput1.type = 'text';
        togglePassword1.classList.remove('bxs-lock');
        togglePassword1.classList.add('bxs-lock-open');
    } else {
        passwordInput1.type = 'password';
        togglePassword1.classList.remove('bxs-lock-open');
        togglePassword1.classList.add('bxs-lock');
    }
});

document.addEventListener("DOMContentLoaded", function() {
    const toggleIcon1 = document.getElementById("toggle1");

    toggleIcon1.addEventListener("click", function() {
        toggleIcon1.classList.toggle("active");
    });
});

const passwordInput2 = document.getElementById('confirmpass');
const togglePassword2 = document.getElementById('toggle2');

togglePassword2.addEventListener('click', () => {
    if (passwordInput2.type === 'password') {
        passwordInput2.type = 'text';
        togglePassword2.classList.remove('bxs-lock');
        togglePassword2.classList.add('bxs-lock-open');
    } else {
        passwordInput2.type = 'password';
        togglePassword2.classList.remove('bxs-lock-open');
        togglePassword2.classList.add('bxs-lock');
    }
});

document.addEventListener("DOMContentLoaded", function() {
    const toggleIcon2 = document.getElementById("toggle2");

    toggleIcon2.addEventListener("click", function() {
        toggleIcon2.classList.toggle("active");
    });
});

function closeError() {
	var errorDiv = document.querySelector('.errors');
	errorDiv.style.display = 'none';

	var currentURL = window.location.href;
	var newURL = currentURL.split('?')[0];
	history.replaceState(null, null, newURL);
}

function validateFirstname() {
    const firstnameInput = document.getElementById('firstname');
    firstnameInput.value = firstnameInput.value.trimStart();
    const firstname = firstnameInput.value;
    const error = document.getElementById('firstname-error');
	
    if (/[^a-zA-Z ]/.test(firstname)) {
        error.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>Invalid Firstname! Please use letters only.</p>";
        error.style.display = 'block';
    } else {
        error.style.display = 'none';
    }
}

function validateMiddlename() {
    const middlenameInput = document.getElementById('middlename');
    middlenameInput.value = middlenameInput.value.trimStart();
    const middlename = middlenameInput.value;
    const error = document.getElementById('middlename-error');
	
    if (/[^a-zA-Z ]/.test(middlename)) {
        error.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>Invalid Middlename! Please use letters only.</p>";
        error.style.display = 'block';
    } else {
        error.style.display = 'none';
    }
}

function validateLastname() {
    const lastnameInput = document.getElementById('lastname');
    lastnameInput.value = lastnameInput.value.trimStart();
    const lastname = lastnameInput.value;
    const error = document.getElementById('lastname-error');
	
    if (/[^a-zA-Z ]/.test(lastname)) {
        error.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>Invalid Lastname! Please use letters only.</p>";
        error.style.display = 'block';
    } else {
        error.style.display = 'none';
    }
}

function validateUsername() {
    const username = document.getElementById('username').value;
    const error = document.getElementById('username-error');
	
    if (/[^a-zA-Z0-9]/.test(username)) {
        error.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>Invalid Username! Please use letters and numbers without spaces.</p>";
        error.style.display = 'block';
    } else if (username.length > 10) {
        error.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>Invalid Username! Please enter 10 characters or less.</p>";
        error.style.display = 'block';
    } else {
        error.style.display = 'none';
    }
}

function validateMobile() {
    const mobile = document.getElementById('mobile').value;
    const error = document.getElementById('mobile-error');
	
    if (mobile.length > 0 && (!/^09/.test(mobile) || mobile.length !== 11)) {
        error.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>Invalid Mobile No.! Please use Philippine Mobile No. only.</p>";
        error.style.display = 'block';
    } else {
        error.style.display = 'none';
    }
}

function validatePassword() {
    const pass = document.getElementById('pass1').value;
    const confirmPass = document.getElementById('confirmpass').value;
    const error = document.getElementById('password-error');
	const error2 = document.getElementById('password-error2');

	if (/\s/.test(pass)) {
      error.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>Password should not contain spaces.</p>";
      error.style.display = 'block';
	} else {
		error.style.display = 'none';
	}

	if (confirmPass.length > 0 && pass !== confirmPass) {
		error2.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>Your passwords didn't match, please try again!</p>";
		error2.style.display = 'block';
	} else {
		error2.style.display = 'none';
	}
}

function validateFormDynamically() {
    const requiredFields = ['firstname', 'middlename', 'lastname', 'username', 'mobile', 'pass1', 'confirmpass'];
    const error = document.getElementById('empty-error');
    let isValid = true;

    requiredFields.forEach((fieldId) => {
        const field = document.getElementById(fieldId);
        if (!field.value.trim()) {
            isValid = false;
        }
    });

   const hasValidationError =
        /[^a-zA-Z ]/.test(document.getElementById('firstname').value) ||
        /[^a-zA-Z ]/.test(document.getElementById('middlename').value) ||
        /[^a-zA-Z ]/.test(document.getElementById('lastname').value) ||
        /[^a-zA-Z0-9]/.test(document.getElementById('username').value) ||
        document.getElementById('username').value.length > 10 ||
        (!/^09/.test(document.getElementById('mobile').value) || document.getElementById('mobile').value.length !== 11) ||
        document.getElementById('pass1').value !== document.getElementById('confirmpass').value ||
        /\s/.test(document.getElementById('pass1').value);
		
	if (!isValid) {
        error.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>There are empty fields, please fill in all fields!";
        error.style.display = 'block';
    } else if (hasValidationError) {
        error.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>There are incorrect fields, please adjust them properly.</p>";
        error.style.display = 'block';
        isValid = false;
    } else {
        error.style.display = 'none';
    }

    return isValid;
}

document.addEventListener("DOMContentLoaded", () => {
    const formFields = document.querySelectorAll('#signup-form input');
    const form = document.getElementById('signup-form');

    formFields.forEach((field) => {
        field.addEventListener('input', validateFormDynamically);
    });

    form.addEventListener('submit', (e) => {
        const isFormValid = validateFormDynamically();
        if (!isFormValid) {
            e.preventDefault();
        }
    });
});


function validateSigninUsername() {
    const username = document.getElementById('signinusername').value;
    const error = document.getElementById('signinusername-error');
	
    if (/[^a-zA-Z0-9]/.test(username)) {
        error.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>Invalid Username! Please use letters and numbers without spaces.</p>";
        error.style.display = 'block';
    } else {
        error.style.display = 'none';
    }
}

function validateSigninPassword() {
    const pass = document.getElementById('signinpassword').value;
    const error = document.getElementById('signinpassword-error');

	if (/\s/.test(pass)) {
      error.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>Password should not contain spaces.</p>";
      error.style.display = 'block';
	} else {
		error.style.display = 'none';
	}
}

function validateSigninFormDynamically() {
    const requiredFields = ['signinusername', 'signinpassword'];
    const error = document.getElementById('signin-empty-error');
    let isValid = true;

    requiredFields.forEach((fieldId) => {
        const field = document.getElementById(fieldId);
        if (!field.value.trim()) {
            isValid = false;
        }
    });

   const hasValidationError =
        /[^a-zA-Z0-9]/.test(document.getElementById('signinusername').value) ||
        /\s/.test(document.getElementById('signinpassword').value);
		
	if (!isValid) {
        error.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>There are empty fields, please fill in all fields!</p>";
        error.style.display = 'block';
    } else if (hasValidationError) {
        error.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>There are incorrect fields, please adjust them properly.</p>";
        error.style.display = 'block';
        isValid = false;
    } else {
        error.style.display = 'none';
    }

    return isValid;

}

document.addEventListener("DOMContentLoaded", () => {
    const formFields = document.querySelectorAll('#signin-form input');
    const form = document.getElementById('signin-form');

    formFields.forEach((field) => {
        field.addEventListener('input', validateSigninFormDynamically);
    });

    form.addEventListener('submit', (e) => {
        const isFormValid = validateSigninFormDynamically();
        if (!isFormValid) {
            e.preventDefault();
        }
    });
});
