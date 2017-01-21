(function($) {
  $youtubeVideos = $('.youtube-video');

  function resizeVideos() {
    $youtubeVideos.each(function() {
      var $video = $(this);
      var ratio = $video.data('ratio') || (16/9);
      if(typeof(ratio) === 'string') {
        ratio = parseFloat(ratio, 10);
      }
      $video.height($video.width() / ratio);
    });
  }

  $(function() {
    resizeVideos();
    $(window).resize(function() {
      resizeVideos();
    });
  });
})(jQuery);
