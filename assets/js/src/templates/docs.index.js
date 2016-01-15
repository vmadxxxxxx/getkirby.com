// Add section anchors to every <h2> + <h3> within docs

$('#q').autocomplete().on('autocomplete:add', function(e, item) {
  window.location.href = item.uri;
});