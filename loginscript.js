// Select login and signup forms
const loginForm = document.querySelector('.login-form');
const signupForm = document.querySelector('.signup-form');

// Select login and signup links
const loginLink = document.querySelector('.login-link a');
const signupLink = document.querySelector('.signup-link a');

// Function to switch to login form
function showLoginForm() {
loginForm.classList.remove('hidden');
signupForm.classList.add('hidden');
}

// Function to switch to signup form
function showSignupForm() {
loginForm.classList.add('hidden');
signupForm.classList.remove('hidden');
}

// Event listeners for login and signup links
loginLink.addEventListener('click', showLoginForm);
signupLink.addEventListener('click', showSignupForm);