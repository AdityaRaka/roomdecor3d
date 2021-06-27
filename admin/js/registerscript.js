const fullname = document.getElementById('fullname');
const birth = document.getElementById('birth');
const datepicker = document.getElementById('datepicker');
const email = document.getElementById('email');
const password = document.getElementById('password');
const password2 = document.getElementById('password2');
const address = document.getElementById('address');
const phone = document.getElementById('phone');

form.addEventListener('input', e => {
	e.preventDefault();
	
	checkInputs();
});

function checkInputs() {
	// trim to remove the whitespaces
	const fullnameValue = fullname.value.trim();
	const birthValue = birth.value.trim();
	const datepickerValue = datepicker.value.trim();
    const emailValue = email.value.trim();
	const passwordValue = password.value.trim();
	const password2Value = password2.value.trim();
	const addressValue = address.value.trim();

	if(fullnameValue === '') {
		setErrorFor(fullname, 'Fullname cannot be blank');
	} else {
		setSuccessFor(fullname);
	}
	if(birthValue === '') {
		setErrorFor(birth, 'Place of Birth cannot be blank');
	} else {
		setSuccessFor(birth);
	}
	if(datepickerValue === '') {
		setErrorFor(datepicker, 'Date of Birth cannot be blank');
	} else {
		setSuccessFor(datepicker);
	}
	if(emailValue === '') {
		setErrorFor(email, 'Email cannot be blank');
	} else if (!isEmail(emailValue)) {
		setErrorFor(email, 'Not a valid email');
	} else {
		setSuccessFor(email);
	}
	if(passwordValue === '') {
		setErrorFor(password, 'Password cannot be blank');
	} else {
		setSuccessFor(password);
	}
    if(password2Value === '') {
		setErrorFor(password2, 'Retype Password cannot be blank');
	} else if(passwordValue !== password2Value) {
		setErrorFor(password2, 'Retype Password does not match');
	} else{
		setSuccessFor(password2);
	}
	if(addressValue === '') {
		setErrorFor(address, 'Address cannot be blank');
	} else {
		setSuccessFor(address);
	}
}

function setErrorFor(input, message) {
	const formControl = input.parentElement;
	const small = formControl.querySelector('small');
	formControl.className = 'mb-3 error';
	small.innerText = message;
}

function setSuccessFor(input) {
	const formControl = input.parentElement;
	formControl.className = 'mb-3 success';
}
	
function isEmail(email) {
	return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}

