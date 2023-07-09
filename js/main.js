
// Resposive nav bar
const hamburger = document.querySelector(".menu-icon");
const navLinks = document.querySelector(".nav-links");
const links = document.querySelectorAll(".nav-links li");

hamburger.addEventListener("click", () => {
	navLinks.classList.toggle("open");
	links.forEach(link => {
		link.classList.toggle("fade");
	});
});
// Sign in Register alert control close button
var close = document.getElementsByClassName("closebtn");
var i;

for (i = 0; i < close.length; i++) {
  close[i].onclick = function(){
    var div = this.parentElement;
    div.style.opacity = "0";
    setTimeout(function(){ div.style.display = "none"; }, 600);
  }
}

// Show hide user panel
var userPanel = document.getElementsByClassName("user-panel")[0];
var signInLink = document.getElementsByClassName("sign-in-link")[0];
var signinBtnDesktop = document.getElementsByClassName("signin-btn-desktop")[0];
var closeBtn = document.getElementsByClassName("close-btn")[0];

signInLink.addEventListener('click', openUserPanel);
signinBtnDesktop.addEventListener('click', openUserPanel);
closeBtn.addEventListener('click', closeUserPanel);
window.addEventListener('click', closeOuside);

function openUserPanel() {
	userPanel.style.display = "block";
}
function closeUserPanel() {
	userPanel.style.display = "none";
}
function closeOuside(e) {
	if (e.target == userPanel) {
		userPanel.style.display = "none";
	}
}


// Allow user sign in when click a movie
var allowSignIn = document.getElementsByClassName("allow-sign-in");
for (var i; 0 < allowSignIn.length; i++) {
	allowSignIn[i].addEventListener('click', openUserPanel);
}