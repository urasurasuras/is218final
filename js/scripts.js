
/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function toggleNav() {
    document.getElementById("settings-dropdown").classList.toggle("show");
  }
  
  // Close the dropdown menu if the user clicks outside of it
  window.onclick = function(event) {
    if (!event.target.matches('.settings-btn')) {
      var dropdowns = document.getElementsByClassName("settings-content");
      var i;
      for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  }
/*================================
 *Add Task Toggle
 *===============================*/
  // Get the modal
var modal = document.getElementById("task-creation");

// Get the button that opens the modal
var btn = document.getElementById("add-task");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
/*================================
 *Edit Task Toggle
 *===============================*/
  // Get the modal
  var modal = document.getElementById("task-edit");

  // Get the button that opens the modal
  var btn = document.getElementById("edit-task");
  
  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];
  
  // When the user clicks on the button, open the modal
  btn.onclick = function() {
    modal.style.display = "block";
  }
  
  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    modal.style.display = "none";
  }
  
  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
/*==========================================
 * Code for Tabs
 *==========================================*/
function openTab(evt, tabName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " active";
}
/*==========================================
 * Display Edit
 *==========================================*/
function handleEdit(title,description,due_date,urgency){
  console.log(title);
  var btn=document.getElementById('task-edit').style.display='block';
  var formTitle=document.getElementById('title');
  formTitle.value="";
  var description=document.getElementById('description');
  
  var due_date=document.getElementById('due');

  var urgency=document.getElementById('urgency');




}