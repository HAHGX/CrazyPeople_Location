(function( $ ) {    
    $.fn.location = function(options) {
        
        var settings = $.extend( {
            'regions': {},
            'cities': {}
        }, options);
        
        var regions = settings.regions;
        var cities = settings.cities;
        var el = {};
    
        $(this).each(function(){
            el[parseClass($(this))] = $(this);
        });
        
        $(this).each(function(){
            $(this).change(function(){
                switch(parseClass($(this))) {
                    case 'country':
                        var country = $(this).find('option:selected').val();
                        el['region'].find('option[value!=""]').remove();
                        el['city'].find('option[value!=""]').remove();
                        for(key in regions[country]) {                            
                            el['region'].append('<option value="'+regions[country][key]['code']+'">'+regions[country][key]['name']+'</option>');
                        }
                        checkRegion(el);
                        checkCity(el);
                    break;
                
                    case 'region':                        
                        var region = $(this).find('option:selected').val();
                        el['city'].find('option[value!=""]').remove();
                        for(key in cities[region]) {
                            if(cities[region][key]['code']) {
                                el['city'].append('<option value="'+cities[region][key]['code']+'">'+cities[region][key]['name']+'</option>');
                            }
                        }
                        checkCity(el);
                    break;
                }
            });
        });
    };
})( jQuery );

function parseClass(el) {
    if(el.hasClass('location_country')) {
        return 'country';
    }
    if(el.hasClass('location_region')) {
        return 'region';
    }
    if(el.hasClass('location_city')) {
        return 'city';
    }
}

function checkRegion(el) {
    if(el['region'].find('option').size() <= 1) {
        if(jQuery('#'+el['region'].attr('id')+'_text').attr('name')) {
            jQuery('#'+el['region'].attr('id')+'_text').show();
        } else {
            var name = el['region'].attr('name').replace('_id', '');
            el['region'].hide();
            el['region'].parent().append('<input type="text" id="'+el['region'].attr('id')+'_text" name="'+name+'" class="input-text location_region" value="" />');
        }        
    } else {
        try {
            jQuery('#'+el['region'].attr('id')+'_text').remove();
            el['region'].show();
        } catch(Ex) {
            
        }
    }
}

function checkCity(el) {
    if(el['city'].find('option').size() <= 1) {
        if(jQuery('#'+el['city'].attr('id')+'_text').attr('name')) {
            jQuery('#'+el['city'].attr('id')+'_text').show();
        } else {
            var name = el['city'].attr('name').replace('_id', '');
            el['city'].hide();
            el['city'].parent().append('<input type="text" id="'+el['city'].attr('id')+'_text" name="'+name+'" class="input-text location_city" value="" />');
        }        
    } else {
        try {
            jQuery('#'+el['city'].attr('id')+'_text').remove();
            el['city'].show();
        } catch(Ex) {
            
        }
    }
}

