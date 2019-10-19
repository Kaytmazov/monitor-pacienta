(function() {
  var regionComfirmBtns = document.querySelectorAll('.btn-region-confirm');

  onComfirmRegionBtnClick = function(evt) {
    evt.preventDefault();

    Cookies.set('region', evt.target.dataset.region, { expires: 366 });
    location.reload();
  };

  Array.prototype.forEach.call(regionComfirmBtns, function(it) {
    it.addEventListener('click', onComfirmRegionBtnClick);
  });

  // When the user scrolls the page, execute myFunction
  window.onscroll = function() {
    myFunction();
  };

  window.onload = function() {
    myFunction();
  };

  // Get the header
  var header = document.querySelector('.site-header');

  // Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
  function myFunction() {
    if (window.pageYOffset > header.offsetTop) {
      header.classList.add('sticked');
    } else {
      header.classList.remove('sticked');
    }
  };


  // Плавный скролл к якорю при клике
  jQuery('body').on('click', '[href*="#"]', function(evt){
    jQuery('html,body').stop().animate({ scrollTop: jQuery(this.hash).offset().top - 100 }, 800);
    evt.preventDefault();
  });

  // Остановить видео при закрытии модального окна
  jQuery('#videoModal').on('hide.bs.modal', function (evt) {
    var iframe = jQuery(this).find('iframe');
    iframe.attr('src', iframe.attr('src'));
  })

})();

