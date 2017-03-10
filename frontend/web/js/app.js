
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
      $(this).closest('.card_container').next('.this-one').toggleClass('fa-arrow-circle-right');
      $(this).closest('.card_container').next('.this-one').toggleClass('fa-arrow-circle-down');
  });

 

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
    console.log(lastChar);
    $(this).find(".modal-body").load('/project-building-storey-parts/init-rooms?id=' + lastChar, function() {
      checkAllOrNone();
      selectRooms();
    });
  });
 
  // Javascript to enable link to tab
  var url = document.location.toString();
  if (url.match('#')) {
      $('.nav-tabs a[href="#' + url.split('#')[1] + '-tab"]').tab('show');
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
    e.preventDefault();
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

});


