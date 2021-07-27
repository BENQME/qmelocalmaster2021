$(function() {
  'use strict'

  if ($(".js-example-basic-single").length) {
    $(".js-example-basic-single").select2();
  }
  if ($(".js-example-basic-multiple").length) {
    $(".js-example-basic-multiple").select2({
      tags: true
    });
   //$(".js-example-basic-multiple").select2().select2Sortable();
   //$(".js-example-basic-multiple").select2Sortable();
   $(".js-example-basic-multiple").on("select2:select", function (evt) {
  var element = evt.params.data.element;
  var $element = $(element);
  
  $element.detach();
  $(this).append($element);
  $(this).trigger("change");
});
  }
});

(function($){
    $.fn.extend({
        select2_sortable: function(){
            var select = $(this);
            $(select).select2();
            var ul = $(select).prev('.select2-container').first('ul');
            ul.sortable({
                placeholder : 'ui-state-highlight',
                items       : 'li:not(.select2-search-field)',
                tolerance   : 'pointer',
                stop: function() {
                    $($(ul).find('.select2-search-choice').get().reverse()).each(function() { 
                        var id = $(this).data('select2Data').id;
                        var option = select.find('option[value="' + id + '"]')[0];
                        $(select).prepend(option);
                    });
                }
            });
        }
    });
}(jQuery));

$(document).ready(function(){
    $('.js-example-basic-multiple').each(function(){
        $(this).select2_sortable();
    })
});
$.fn.extend({
    select2_sortable: function () {
        var select = $(this);
        var select2dom = $(select).select2({
            width: "100%",
            createTag: function (params) {
                return undefined;
            }
        });
        var ul = $(select).next(".select2-container").find("ul.select2-selection__rendered");
        
        ul.sortable({
            placeholder: "ui-state-highlight",
            forcePlaceholderSize: true,
            items: "li:not(.select2-search__field)",
            tolerance: "pointer",
            stop: function () {
                $($(ul).find(".select2-selection__choice").get().reverse()).each(function () {
                    var selected = $(select).select2('data');
                    var value = $(this).attr('title');
                    for (var i = 0; i < selected.length; i++) {
                        if (selected[i].text == value) {
                            value = selected[i].id;
                        }
                    }
                    var option = $(select).find('option[value="' + value + '"]')[0];
                    $(select).prepend(option);
                });
            }
        });
    }
});