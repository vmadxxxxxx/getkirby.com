<div id="disqus_thread"></div>
<script type="text/javascript">
  var disqus_shortname  = '<?php echo $shortname ?>'; // required: replace example with your forum shortname
  var disqus_title      = '<?php echo html($title, false) ?>';
  var disqus_developer  = '<?php echo $developer ?>'; // developer mode
  var disqus_identifier = '<?php echo $identifier ?>';
  var disqus_url        = '<?php echo $url ?>';

  (function() {
    var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
    dsq.src = 'https://' + disqus_shortname + '.disqus.com/embed.js';
    (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
  })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
<a href="https://disqus.com" class="dsq-brlink">blog comments powered by <span class="logo-disqus">Disqus</span></a>