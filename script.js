const dashboardSection = document.querySelector('#dashboard');
const attendanceReportsSection = document.querySelector('#attendancereports');
const attendanceReportsLink = document.querySelector('a[href="#attendancereports"]');

attendanceReportsLink.addEventListener('click', function(event) {
  event.preventDefault();
  dashboardSection.style.display = 'none';
  attendanceReportsSection.style.display = 'block';
});

function toggleDarkMode() {
	var body = document.getElementsByTagName('body')[0];
	var modeText = document.getElementsByClassName('mode-text')[0];
	var sticky = document.getElementsByClassName('sticky')[0];
	var footer = document.getElementsByTagName('footer')[0];
	var navLinks = document.querySelectorAll('nav ul li a');
	var footerLinks = document.querySelectorAll('.footer-links a');
	var dropdownLinks = document.querySelectorAll('.dropdown-content a');
  
	if (body.classList.contains('dark-mode')) {
	  body.classList.remove('dark-mode');
	  modeText.innerHTML = 'Light Mode';
	  sticky.style.backgroundColor = '#fff';
	  sticky.style.color = '#333';
	  footer.style.backgroundColor = '#fff';
	  footer.style.color = '#333';
	  for (var i = 0; i < navLinks.length; i++) {
		navLinks[i].style.color = '#333';
	  }
	  for (var i = 0; i < footerLinks.length; i++) {
		footerLinks[i].style.color = '#333';
	  }
	  for (var i = 0; i < dropdownLinks.length; i++) {
		dropdownLinks[i].style.color = '#000';
	  }
	} else {
	  body.classList.add('dark-mode');
	  modeText.innerHTML = 'Dark Mode';
	  sticky.style.backgroundColor = '#333';
	  sticky.style.color = '#fff';
	  footer.style.backgroundColor = '#333';
	  footer.style.color = '#fff';
	  for (var i = 0; i < navLinks.length; i++) {
		navLinks[i].style.color = '#fff';
	  }
	  for (var i = 0; i < footerLinks.length; i++) {
		footerLinks[i].style.color = '#fff';
	  }
	  for (var i = 0; i < dropdownLinks.length; i++) {
		dropdownLinks[i].style.color = '#000';
	  }
	}
  }
  