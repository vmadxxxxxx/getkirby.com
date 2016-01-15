var Slider = function(element) {

  var element = $(element);
  var images  = element.find('figure');
  var nav     = element.find('.slider-nav');
  var prev    = nav.find('.slider-prev');
  var next    = nav.find('.slider-next');
  var index   = 0;

  var methods = {
    go : function(n) {

      images.removeClass('slider-index-left');
      images.removeClass('slider-index');
      images.removeClass('slider-index-right');

      var index = images.eq(n).addClass('slider-index');
      var prev  = index.prev();
      var next  = index.next();

      if(!prev.length) prev = images.last();
      if(!next.length) next = images.first();

      prev.addClass('slider-index-left');
      next.addClass('slider-index-right');

      index = n;

    },
    prev : function() {
      index = (index > 0) ? index-1 : images.length-1;
      methods.go(index);
    },
    next : function() {
      index = (index < images.length-1) ? index+1 : 0;
      methods.go(index);
    }
  };

  prev.on('click', function() {
    methods.prev();
    return false;
  });

  next.on('click', function() {
    methods.next();
    return false;
  });

  return {
    element : element,
    go      : methods.go,
    prev    : methods.prev,
    next    : methods.next
  };

};

if($('.slider').length) {
  var slider = new Slider('.slider');
  slider.go(0);
}
