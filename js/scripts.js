(function() {
  function setCookie(name, value, days2expire, path) {
    var date = new Date();
    date.setTime(date.getTime() + (days2expire * 24 * 60 * 60 * 1000));
    var expires = date.toUTCString();
    document.cookie = name + '=' + value + ';' +
                     'expires=' + expires + ';' +
                     'path=' + path + ';';
  };

  onComfirmRegionBtnClick = function(evt) {
    evt.preventDefault();
    setCookie('region', evt.target.dataset.region, 366, '/');
    location.reload();
  };

  var regionComfirmBtns = document.querySelectorAll('.btn-region-confirm');

  Array.prototype.forEach.call(regionComfirmBtns, function(it) {
    it.addEventListener('click', onComfirmRegionBtnClick);
  });

})();
