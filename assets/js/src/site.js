/* Site js */
$(function(){

  /** Smooth Scrolling **/
  $('.to-top').click(function(event){
    event.preventDefault();
    var offset = $($(this).attr('href')).offset().top;
    $('html, body').animate({scrollTop:offset}, 700);
  });

  /** Dynamic to-top link **/
  $('.to-top').hide();
  $(window).scroll(function(){
    if($(this).scrollTop() > 200) {
      $('.to-top').show();
    } else {
      $('.to-top').hide();
    }
  });

  /** Search **/
  var client    = algoliasearch('S7OGBIAJTV', 'd161a2f4cd2d69247c529a3371ad3050')
  var index     = client.initIndex('getkirby');
  var lastValue = '';
  var list      = [];
  var awesome   = new Awesomplete(document.querySelector('.quicksearch input'), {
    list: [], 
    filter: function() {
      return true;
    },
    item: function(text, input) {
      return $('<li><strong>' + text.label + '</strong> <small>' + text.value + '</small></li>')[0];
    }
  });

  var delay = (function(){
    var timer = 0;
    return function(callback, ms){
      clearTimeout (timer);
      timer = setTimeout(callback, ms);
    };
  })();

  $('.quicksearch input').on('focus', function() {
    $('.quicksearch').addClass('has-focus');
    $('.quicksearch label').text('Search:');
    $(this).attr('placeholder', '…');
  }).on('blur', function() {
    $('.quicksearch').removeClass('has-focus');
    $('.quicksearch label').text('Search');
    $(this).val('').attr('placeholder', '');
  }).on('keyup', function() {

    var input = $(this);
    var value = $.trim(input.val());

    if(value === lastValue) {
      return true;
    } else if(value === '') {
      lastValue = '';
      list      = [];
      awesome.list = list;
      awesome.evaluate();
      return true;
    } else {
      lastValue = value;
    }

    // don't search for very short words  
    if(value.length <= 2) {
      return true;
    }

    delay(function(){

      index.search(value, {hitsPerPage: 5}, function(err, content) {  

        list = [];

        $.each(content.hits, function(i, item) {
          list.push({
            label : item.title,
            value : item.objectID
          });
        });

        awesome.list = list;
        awesome.evaluate();
        awesome.open();

      });

    }, 250);

  }).on('awesomplete-select', function(e, item) {
    window.location.href = $('.logo').attr('href') + '/' + e.originalEvent.text.value;
    e.originalEvent.preventDefault();
  });

});