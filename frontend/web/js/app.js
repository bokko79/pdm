
// toggle select/deselect all checkboxes
function checkAllOrNone() {
  $( "[id^='ckbCheckAll']").on('click', function () {    
    $(this).closest('.enclosedCheckboxes').find("input[type='checkbox']").prop('checked', $(this).prop('checked'));
  });
} 

function clearForm(oForm) {
    
  var elements = oForm.elements;
    
  oForm.reset();

  for(i=0; i<elements.length; i++) {
      
  field_type = elements[i].type.toLowerCase();
  
  switch(field_type) {
  
    case "text": 
    case "password": 
    case "textarea":
    //case "hidden": 
    case "number":  
      
      elements[i].value = ""; 
      break;
        
    case "radio":
    case "checkbox":
        if (elements[i].checked) {
          elements[i].checked = false; 
      }
      break;

    case "select-one":
    case "select-multi":
                elements[i].selectedIndex = -1;
      break;

    default: 
      break;
  }
    }
}

$(document).ready(function(){
  $(".search-index").click(function(){
      $(this).closest('.title_holder_home').find('.user-objects-search').toggle();
  });
  // forms and settings divisions titlebars
  $(".settings .wrapper.headline").click(function(){
      $(this).next('.wrapper').toggle();
      $(this).find('i.chevron').toggleClass('fa-chevron-right');
      $(this).find('i.chevron').toggleClass('fa-chevron-down');
      $('html,body').animate({
              scrollTop: $(this).offset().top-80},
              500);
  });
  // settings help on right-sidebar
  $(".show-more").click(function(){
      $(this).closest('.card_container').find('div.hidden-content').toggleClass('hidden');
      $(this).find('i.fa').toggleClass('fa-chevron-down');
      $(this).find('i.fa').toggleClass('fa-chevron-right');
  });

  // Compact order
  $("[id^=card_container]").hover(function(){
      $(this).find('.hidden-widget').toggleClass('hidden');
  });
  //indexed table row is link
  $(".clickable-row").click(function() {
    window.document.location = $(this).data("href");
  });

  
  //checkbox select all/none
  $( "[id^='ckbCheckAll']").on('click', function () {
    $(this).closest('.enclosedCheckboxes').find("input[type='checkbox']").prop('checked', $(this).prop('checked'));
  });
  
  
  $(".button_to_show_secondary").click(function(){
      $(this).closest('.primary-context').next().slideToggle();
      $(this).closest('.primary-context').find('.this-one').toggleClass('fa-caret-right');
      $(this).closest('.primary-context').find('.this-one').toggleClass('fa-caret-down');
  });

  $(".button_to_show_table").click(function(){
      $('.hidden-table').slideToggle();
  });

function showSecondary() {
  $(".button_to_show_secondary").click(function(){
      $(this).closest('.primary-context').next().slideToggle();
      $(this).closest('.card_container').next('.this-one').toggleClass('fa-arrow-circle-right');
      $(this).closest('.card_container').next('.this-one').toggleClass('fa-arrow-circle-down');
  });
} 

  // reset animate !important
  $(window).bind('mousewheel', function() {
      $('html, body').stop();
  });

  $("[id^='storey-parts-modal']").one("show.bs.modal", function(e) {
    var id = $(this).attr('id');
    var lastChar = id.replace('storey-parts-modal', '');
    $(this).find(".modal-body").load('/project-building-storeys/edit-parts?id=' + lastChar, function() {
      checkAllOrNone();
    });
  });

  $("[id^='init-storey-parts-modal']").one("show.bs.modal", function(e) {
    var id = $(this).attr('id');
    var lastChar = id.replace('init-storey-parts-modal', '');
    $(this).find(".modal-body").load('/project-building-storeys/init-parts?id=' + lastChar, function() {
      checkAllOrNone();
    });
  });

  $("[id^='storey-modal']").one("show.bs.modal", function(e) {
    var id = $(this).attr('id');
    var lastChar = id.replace('storey-modal', '');
    $(this).find(".modal-body").load('/project-building-storeys/edit-storeys?id=' + lastChar, function() {
      checkAllOrNone();
    });
  });

  $("[id^='rooms-modal']").one("show.bs.modal", function(e) {
    var id = $(this).attr('id');
    var lastChar = id.replace('rooms-modal', '');
    $(this).find(".modal-body").load('/project-building-storey-parts/edit-rooms?id=' + lastChar, function() {
      checkAllOrNone();
    });
  });
  $("[id^='init-rooms-modal']").one("show.bs.modal", function(e) {
    var id = $(this).attr('id');
    var lastChar = id.replace('init-rooms-modal', '');
    $(this).find(".modal-body").load('/project-building-storey-parts/init-rooms?id=' + lastChar, function() {
      checkAllOrNone();
      selectRooms();
    });
  });
  $("[id^='work-modal']").one("show.bs.modal", function(e) {
    var id = $(this).attr('id');
    var lastChar = id.replace('work-modal', '');
    var word = lastChar.split("_");
    $(this).find(".modal-body").load('/project-qs/init-works?id=' + word[0] + '&project=' + word[1], function() {
      showSecondary();
    });
  });
 
  // Javascript to enable link to tab
  var url = document.location.toString();
  if (url.match('#')) {
      $('.nav-tabs a[href="#' + url.split('#')[1] + '-tab"]').tab('show');
      //e.preventDefault();
  } //add a suffix

  // Change hash for page-reload
  $('.nav-tabs a').on('shown.bs.tab', function (e) {
      window.location.hash = e.target.hash;
  })

  function selectRooms() {
    $(".box1 li").on('click', function(){
      var myClass = $(this).attr("class");
      var myId = $(this).attr("id");
      $(this).closest('.row').find('.box2 select').append('<option value="' + myClass + '" selected><i class="fa fa-arrow-circle-right"></i> ' + myId + '</option>');
    });

    $(".removeAllButton").on('click', function(){
      $(this).closest('.row').find('.box2 select').empty();
    });

    $(".box2 select").on('change', function(){      
      var selectVal = $(this).val();
      $('.box2 select option').each(function() {
          if ( $(this).val() == selectVal ) {
              $(this).remove();
          }
      });
    });
  }

(function ($) {
    $.each(['show', 'hide'], function (i, ev) {
      var el = $.fn[ev];
      $.fn[ev] = function () {
        this.trigger(ev);
        return el.apply(this, arguments);
      };
    });
  })(jQuery);

// editable column autofocus input on click
  $('.kv-editable-popover').on('show',function(){
      $(this).find('input').focus();
  });

// tabs refresh
  $('ul.nav-tabs a').click(function(e) {
    //e.preventDefault();
    //e.stopImmediatePropagation();
    $(this).tab('show');

  });

  // store the currently selected tab in the hash value
  $("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
    var id = $(e.target).attr("href").substr(1);
    window.location.hash = id;

  });

  // on load of the page: switch to the currently selected tab
  var hash = window.location.hash;
  $('ul.nav-tabs a[href="' + hash + '"]').tab('show');

  $('ul.nav-tabs').tabCollapse();


  $("select#work-id").on('change', function(){      
      var selectVal = $(this).val();
      
      if ( selectVal == 'adaptacija' ) {
          $('.adaptacija_part').show('');
      } else {
          $('.adaptacija_part').hide('');
      }
      
    });

   $("select#engineers-expertees_id").on('change', function(){      
      var selectVal = $(this).val();
      
      if ( selectVal != 31 ) {
          $('.expertees_part').show('');
      } else {
          $('.expertees_part').hide('');
      }
      
    });

   $("select#register-form-practice_join").on('change', function(){      
      var selectVal = $(this).val();
      
      if ( selectVal == 0 ) {
          $('.new_practice').show('');
          $('.join_practice').hide('');
      } else {
          $('.join_practice').show('');
          $('.new_practice').hide('');
      }
      
    });

   $('input:radio[name="register-form[practice_join]"]').on('change',
    function(){
        if ($(this).is(':checked') && $(this).val() == 0) {
            $('.new_practice').show('');
            $('.join_practice').hide('');
        } else {
            $('.join_practice').show('');
            $('.new_practice').hide('');
        }
    });


   // show/hide search
  $(".show-search").click(function(){
      $(this).closest('.card_container').find('div.searchContainer').slideToggle(200);
  });


  $('.nav-pills a').click(function() {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top - 75
        }, 1000);
        return false;
      }
    }
  });

  /*Menu-toggle*/
    $(".navbar-toggle-sidebar").click(function(e) {
        e.preventDefault();
        $(".sidebar").toggleClass("navbar-toggle-sidebar-menu");
    });

  $('.dropdown-submenu a.test').on("click", function(e){
    $('.dropdown-submenu ul.dropdown-menu').hide();
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });


  $('button.add-house').on("click", function(e){
    console.log($(this).val());
    var target = $(this).closest('table').find('input[id$="type"]:last');
    
    target.val($(this).val());
    console.log(target.val());
  });

  $('.tree-toggle').click(function () { 
    $(this).parent().children('ul.tree').slideToggle(200);
  });
    $(function(){
      $('.tree-toggle').parent().children('ul.tree').toggle(200);
    });
});

$(function(){

  $(document).scroll(function(){
      var top=$(this).scrollTop();
      if(top<180){
        var dif=0.45-top/180;
        $(".navbar-image").css({opacity:dif});
        $(".navbar-image").show();
        $(".navbar-material-blog .navbar-wrapper").css({'padding-top': '180px'});
        $(".navbar-material-blog").removeClass("navbar-fixed-top");
        $(".navbar-material-blog").addClass("navbar-absolute-top");
      }
      else {
        $(".navbar-image").css({opacity:0});
        $(".navbar-image").hide();
        $(".navbar-material-blog .navbar-wrapper").css({'padding-top': 0});
        $(".navbar-material-blog").removeClass("navbar-absolute-top");
        $(".navbar-material-blog").addClass("navbar-fixed-top");
      }
  });

  $(document).scroll(function() {
        0 !== $('#header[data-fixed-top="true"]').length && $(window).on("scroll", function() {
            $("body").scrollTop() >= 40 ? ($("body").css("padding-top", "60px"), $("#header").addClass("header-fixed")) : ($("#header").removeClass("header-fixed"), $("body").css("padding-top", "0"))
        })
    });

  $(document).scroll(function(){
      var top=$(this).scrollTop();
      if(top<71){
        $(".navbar-custom").removeClass("navbar-fixed-top");
        $(".navbar-custom").addClass("transparent");
        $(".navbar-custom .navbar-brand.logo.light").show();
        $(".navbar-custom .navbar-brand.logo.dark").hide();
      }
      else {
        $(".navbar-custom").removeClass("transparent");
        $(".navbar-custom").addClass("navbar-fixed-top");
        
        $(".navbar-custom .navbar-brand.logo.light").hide();
        $(".navbar-custom .navbar-brand.logo.dark").show();
      }
  });
  

  $('a').each(function(index, value) { 
    if ($(this).prop("href") === window.location.href) {
        $(this).closest('li').addClass("active");
    } 
  });


});



