+ function ($) {
   $(document).ready(function () {
      var scrollcontroll;
      scrollcontroll = 0;
      var total_page = '<?php echo $total_pg; ?>';
      $(window).scroll(function () {
         if ($(this).scrollTop() >= $('.bsns_loop:last').offset().top && scrollcontroll == 0) {
            scrollcontroll = 1;
            var x = $('.pg:last').val();

            if (x <= total_page - 1) {
               $(".loader_pic").show();
            } else {
               $(".loader_pic").hide();
            }


            var data = {
               'action': 'ajax_wdgmedia_policy_project',
               'page': x
            };
            jQuery.post(ajaxurl, data, function (response) {
               $('.rw').append(response);
               $(".loader_pic").hide();
               console.log(scrollcontroll);
               scrollcontroll = 0;
            });
         }

      });
   });
}(jQuery);
