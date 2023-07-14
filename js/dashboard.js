let menutoggle = document.querySelector('.toggle');
		menutoggle.onclick = function(){
			menutoggle.classList.toggle('active');
		}

// Get DOM elements
const toggle = document.querySelector('.toggle');
const sidebar = document.querySelector('.sidebar');
const body = document.querySelector('body');
const modeSwitch = document.querySelector('.toggle-switch');
const modeText = document.querySelector('.mode-text');
// Toggle sidebar
toggle.addEventListener('click', () => {
  sidebar.classList.toggle('close');
});

// Toggle dark mode
modeSwitch.addEventListener('click', () => {
  body.classList.toggle('dark');

  if(body.classList.contains("dark")){
  	modeText.innerText = "Light Mode"
  }
  else{
  	modeText.innerText = "Dark Mode"
  }

});

