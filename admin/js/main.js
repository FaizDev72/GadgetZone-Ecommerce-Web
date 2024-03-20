BASE_URL = "ecommerce/admin"
window.onscroll = function () {
  // Back to Top Btn
  var backtoTopEl = document.querySelector(".back-to-top");
  if (document.documentElement.scrollTop > 500) {
    backtoTopEl.style.visibility = "visible";
    backtoTopEl.style.opacity = "1";
  } else {
    backtoTopEl.style.visibility = "hidden";
    backtoTopEl.style.opacity = "0";
  }
};

// Toggle Button on/off
function updatestatus(tableName, colName, id, status){
  $.ajax({
      url: './toggle.php',
      type: "POST",
      data: {tableName, colName, id, status},
      success: function(response){
      }
  })
}

// Update List
function updateList(){
  selectedBrand = document.getElementById('brand').value;
  $.ajax({
    url:'../toggle.php',
    type: 'POST',
    data: {selectedBrand},
    success: function(response){
      console.log(response)
      document.getElementById('catg').innerHTML = response
    }
  })

}

function  updateListOnce() {
  var executed = false;
  return function() {
    if (!executed) {
      executed = true;
      selectedBrand = document.getElementById('brand').value;
      $.ajax({
        url:'../toggle.php',
        type: 'POST',
        data: {selectedBrand},
        success: function(response){
          console.log(response)
          document.getElementById('catg').innerHTML = response
        }
      })
    }
  };
}

function loadHighlights(id, colName, tableName){
  var action = 'display';
  $.ajax({
    url: 'toggle.php',
    type:'POST',
    data: {id, colName, tableName, action},
    success: function(response){
      console.log(response)
      document.querySelector('#displayModal .modal-body').innerHTML = response;
    }
  })
}

// Toggle eye for password
if(window.location.pathname == BASE_URL + "login.php"){


const togglePassword = document.querySelector("#togglePassword1");
  const password = document.querySelector("#password1");

  togglePassword.addEventListener("click", function () {
    console.log("hell")
      // toggle the type attribute
      const type = password.getAttribute("type") === "password" ? "text" : "password";
      password.setAttribute("type", type);
      
      // toggle the icon
      togglePassword.classList.toggle("fa-eye-slash");
});
}


