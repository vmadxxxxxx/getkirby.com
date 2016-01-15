// Add section anchors to every <h2> + <h3> within docs

$('.text h2, .text h3').each(function() {
    var anchor = $(this).text().replace(/[\-\[\]\/\{\}\(\)\*\+\?\!\.\,\=\\\^\$\'\&\%\|]/g, '').replace(/\s/g,'-');
    $(this).attr('id',anchor.toLowerCase());
  }
);