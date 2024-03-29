$(document).ready(function () {
  var hotelSlider = new Swiper('.hotel-slider', {
    // Optional parameters
    loop: true,

    // Navigation arrows
    navigation: {
      nextEl: '.hotel-slider__button--next',
      prevEl: '.hotel-slider__button--prev',
    },
    keyboard: {
      enabled: true,
      pageUpDown: true,
    },
  });
  var reviewsSlider = new Swiper('.reviews-slider', {
    // Optional parameters
    loop: true,

    // Navigation arrows
    navigation: {
      nextEl: '.reviews-slider__button--next',
      prevEl: '.reviews-slider__button--prev',
    },
    keyboard: {
      enabled: true,
      pageUpDown: true,
    },
  });

  var menuButton = document.querySelector(".menu-button");
  menuButton.addEventListener("click", function () {
    console.log("Клик по кнопке меню");
    document.querySelector(".navbar-bottom").classList.toggle("navbar-bottom--visible");
  });

  var modalButton = $("[data-toggle=modal]");
  var closeModalButton = $(".modal__close");
  var closeModalBackground = $(".modal__overlay");

  modalButton.on("click", openModal);
  closeModalButton.on("click", closeModal);
  closeModalBackground.on("click", closeModal);

  function openModal() {
    var modalOverlay = $(".modal__overlay");
    var modalDialog = $(".modal__dialog");
    modalOverlay.addClass("modal__overlay--visible");
    modalDialog.addClass("modal__dialog--visible");
  }
  function closeModal(event) {
    event.preventDefault();
    var modalOverlay = $(".modal__overlay");
    var modalDialog = $(".modal__dialog");
    modalOverlay.removeClass("modal__overlay--visible");
    modalDialog.removeClass("modal__dialog--visible");
  }
  $(document).on('keydown', function (e) {
    if (e.which === 27) {
      var modalOverlay = $(".modal__overlay");
      var modalDialog = $(".modal__dialog");
      modalOverlay.removeClass("modal__overlay--visible");
      modalDialog.removeClass("modal__dialog--visible");
    }
  });
  // Закрытие модального окна при клике вне его контентной области
  $('.modal').mouseup(function (e) {
   let  modalDialog = $(".modal__dialog");
   if (!modalDialog.is(e.target) && modalDialog.has(e.target).length === 0) {
     $(this).removeClass('modal__dialog--visible');
   }
  });
    $('.modal').mouseup(function (e) {
   let  modalDialog = $(".modal__dialog");
   if (!modalDialog.is(e.target) && modalDialog.has(e.target).length === 0) {
     $(this).removeClass('modal__dialog--visible');
   }
  });




  //обработка форм
  $(".form").each(function () {
    $(this).validate({
      errorClass: "invalid",
      messages: {
        name: {
          required: "Please specify your name",
          minlength: "Please enter your real name",
        },
        email: {
          required: "We need your email address to contact you",
          email: "Your email address must be in the format of name@domain.com",
        },
        subscribe: {
          required: "Need email address",
          email: "Format of name@domain.com",
        },
        phone: {
          required: "Phone number required",
          minlength: "Incorrect number"
        },
      },
    });
  });

  //обработка форм
  $(".newsletter__subscribe").each(function () {
    $(this).validate({
      errorClass: "invalide",
      messages: {
        name: "Please specify your name",
        email: {
          required: "We need your email address to contact you",
          email: "Your email address must be in the format of name@domain.com",
        },
        subscribe: {
          required: "Need email address",
          email: "Format of name@domain.com",
        },
        phone: {
          required: "Phone number required",
        },
      },
    });
  });

  $(".form").ready(function () {
    $('.footer__input--phone').mask('+7 (ZZZ) ZZZ-ZZ-ZZ', {
      translation: {
        'Z': {
          pattern: /[0-9]/, optional: true
        }
      }
    });
  });
  $(".form").ready(function () {
    $('.modal__input--phone').mask('+7 (ZZZ) ZZZ-ZZ-ZZ', {
      translation: {
        'Z': {
          pattern: /[0-9]/, optional: true
        }
      }
    });
  });

  AOS.init();
});