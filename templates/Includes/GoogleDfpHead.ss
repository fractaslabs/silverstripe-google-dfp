<% if GoogleDfpEnabled %>
<% if GoogleDfpSlotList %>
<script type="text/javascript">
  var googletag = googletag || {};
  googletag.cmd = googletag.cmd || [];
  (function() {
    var gads = document.createElement('script');
    gads.async = true;
    gads.type = 'text/javascript';
    var useSSL = 'https:' == document.location.protocol;
    gads.src = (useSSL ? 'https:' : 'http:') + '//www.googletagservices.com/tag/js/gpt.js';
    var node = document.getElementsByTagName('script')[0];
    node.parentNode.insertBefore(gads, node);
  })();
  function getBannersBreakpoint() {
      var windowWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
      var breakpoints = [640, 768, 960, 1200, 1366, 1440, 1600, 1920];
      var bannersResolution = [640];
      for (i = 0; i < breakpoints.length; i++) {
          if (windowWidth >= breakpoints[i]) { bannersResolution = [breakpoints[i]]; }
      }
      return bannersResolution;
  }
  var bannersBreakpoint = getBannersBreakpoint();
  googletag.cmd.push(function() {
  <% loop GoogleDfpSlotList %>
  <% if OutOfPage %>
    googletag.defineOutOfPageSlot('{$AdUnitPath}', '{$ID}').addService(googletag.pubads());
  <% else %>
    googletag.defineSlot('{$AdUnitPath}', $Size, '{$ID}').addService(googletag.pubads());
  <% end_if %>
  <% if Last %>
    googletag.pubads().setTargeting('Page', '{$DfpTargetPage}');
    googletag.pubads().setTargeting('Category', '{$DfpTargetCategory}');
    googletag.pubads().setTargeting('FrontPage', '{$DfpTargetCategoryParent}');
  <% end_if %>
  <% end_loop %>
    googletag.pubads().setTargeting('WindowSize', bannersBreakpoint);
    googletag.pubads().enableSingleRequest();
    googletag.pubads().collapseEmptyDivs();
    googletag.enableServices();
  });
</script>
<% end_if %>
<% end_if %>
