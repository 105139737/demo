(function ($) {
    $.fn.extend({
        jsonToDatalist: function (options) {
            var defaults = {
                jsonPath: null,
                callback: function() {}
            };
            var options = $.extend(defaults, options);
            this.each(function () {
                var $this = $(this),
                    objData = $this.data(),
                    o = $.extend(true, {}, options, objData);

                var jsonPath = o.jsonPath,
                    $this_list = $this.attr('list');

                if(jsonPath) {
                    $.getJSON(jsonPath, function(data) {
                        // Save option in array
                        var items = [];

                        $.each(data, function(key, val) {
							items.push("<option value='"+val.name+"'>");
							$("#"+val.fld).val(val.sl).trigger("change"); // push Data in hidden field
                        });
                        // Add datalist
                        $( "<datalist/>", {
                            "id": $this_list,
                            html: items.join("")
                        }).insertAfter($this);
                        o.callback.call(this, $this);
                    });
                } else {
                    console.log('JSON path is empty or null.');
                }
            });
        }
    });
})(jQuery);
