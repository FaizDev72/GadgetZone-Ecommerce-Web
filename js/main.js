var BASE_URL = "/ecommerce";
// For Trending Carousel
$(document).ready(function () {
  // For Trending-product Owl Carousel
  $(".trending-product-wrapper .owl-carousel").owlCarousel({
    loop: true,
    nav: true,
    dots: false,
    autoplay: true,
    autoplayTimeout: 2600,
    autoplayHoverPause: true,
    responsiveClass: true,
    responsiveClass: true,
    responsive: {
      0: {
        items: 2.5,
      },
      600: {
        items: 3,
      },
      1000: {
        items: 5,
      },
    },
  });
  // For related products carousel
  $(".related-product-wrapper .owl-carousel ").owlCarousel({
    nav: false,
    dots: true,
    autoplay: true,
    // autoplayTimeout:2600,
    // autoplayHoverPause:true,
    // responsiveClass:true,
    // responsiveClass:true,
    responsive: {
      0: {
        items: 2.5,
      },
      600: {
        items: 3,
      },
      1000: {
        items: 5,
      },
    },
  });

  // For Product Gallery Filteration

  // isotope filter
  var $grid = $(".grid").imagesLoaded(function () {
    $grid.isotope({
      itemSelector: ".grid-item",
      // layoutMode : 'fitRows'
    });
  });

  // filter items on button click
  $(".button-group").on("click", "button", function () {
    var filterData = $(this).attr("data-filter");
    $grid.isotope({ filter: filterData });
  });
});

// For Product Gallery Buttons
var button = document.querySelectorAll(".button-group .rect-btn");
button.forEach((btn) => {
  btn.addEventListener("click", () => {
    var activeBtn = document.querySelector(".active-btn");
    if (activeBtn) {
      activeBtn.classList.remove("active-btn");
    }
    btn.classList.add("active-btn");
  });
});

// For Responsive Navigation
var dropDown = document.querySelectorAll(".dropdown-area");
var hasDropdown = document.querySelectorAll(".has-dropdown");
hasDropdown.forEach((e) => {
  e.addEventListener("click", () => {
    e.classList.toggle("showdrop");
  });
});

// For Fixed Navigation and // Back to Top Btn
var navigation = document.querySelector(".header-wrapper");
var nav2 = document.querySelector(".nav-2");
window.onscroll = function () {
  // For Fixed Navigation
  if (nav2) {
    if (document.documentElement.scrollTop > 800) {
      navigation.classList.add("scroll-on");
      nav2.style.display = "none";
    } else {
      navigation.classList.remove("scroll-on");
      nav2.style.display = "initial";
    }
  }

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

if (
  window.location.pathname == BASE_URL + "/signup.php" ||
  window.location.pathname == BASE_URL + "/login.php" ||
  window.location.pathname == BASE_URL + "/change-pass.php"
) {
  // Toggle eye for password
  const togglePassword = document.querySelector("#togglePassword1");
  const password = document.querySelector("#password1");

  togglePassword.addEventListener("click", function () {
    // toggle the type attribute
    const type =
      password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);

    // toggle the icon
    togglePassword.classList.toggle("fa-eye-slash");
  });

  // Toggle eye for password
  const togglePassword1 = document.querySelector("#togglePassword2");
  const password1 = document.querySelector("#password2");

  togglePassword1.addEventListener("click", function () {
    // toggle the type attribute
    const type1 =
      password1.getAttribute("type") === "password" ? "text" : "password";
    password1.setAttribute("type", type1);

    // toggle the icon
    togglePassword1.classList.toggle("fa-eye-slash");
  });
}

// For add to cart page
function updateQty(id, action, quantity) {
  if (document.getElementById(quantity).value >= 5 && action == "increment") {
    return;
  }
  if (document.getElementById(quantity).value <= 1 && action == "decrement") {
    return;
  }
  $.ajax({
    url: "cart-ajax.php",
    type: "POST",
    data: { id, action },
    success: function (res) {
      if (res == "increment") {
        qty = document.getElementById(quantity);
        increment = parseInt(qty.value) + 1;
        qty.value = increment;
      } else if (res == "decrement") {
        qty = document.getElementById(quantity);
        decrement = parseInt(qty.value) - 1;
        qty.value = decrement;
      }
    },
  });
}
