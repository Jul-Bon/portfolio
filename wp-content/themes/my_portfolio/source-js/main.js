jQuery(document).ready(function () {
  jQuery('.menu_toggle').on('click', function (event) {
    jQuery('.fa').toggleClass('on_active')
    jQuery('#primary-menu').slideToggle(500)
    event.preventDefault()
  });

});
