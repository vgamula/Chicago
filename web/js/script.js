jQuery(function () {
    function updateRelatedSelect(select, options, value, label) {
        var data = '<option selected value>Вибір...</option>';
        value = tools.isDefined(value) ? value : 'id';
        label = tools.isDefined(label) ? label : 'title';
        for (var i = 0; i < options.length; i++) {
            data += '<option value="{value}">{label}</option>'.format({
                label: options[i][label],
                value: options[i][value]
            });
        }
        select.empty().append(data).trigger('update');
    }

    var countrySelect = jQuery('select[name$="[countryId]"]'),
        regionSelect = jQuery('select[name$="[regionId]"]'),
        citySelect = jQuery('select[name$="[cityId]"]'),
        countryHandler = function () {
            var val = countrySelect.val();
            regionSelect.val(null);
            citySelect.val(null);
            if (val) {
                jQuery.ajax({
                    url: '/geo/region/list'.addUrlParam('countryId', val),
                    success: function (data) {
                        updateRelatedSelect(regionSelect, data, 'regionId');
                        regionHandler();
                    }
                });
            }
        },
        regionHandler = function () {
            var val = regionSelect.val();
            citySelect.val(null);
            if (val) {
                jQuery.ajax({
                    url: '/geo/city/list'.addUrlParam('regionId', val),
                    success: function (data) {
                        updateRelatedSelect(citySelect, data, 'cityId');
                    }
                });
            }
        };
    countrySelect.change(countryHandler);
    regionSelect.change(regionHandler);

});

informer = {};