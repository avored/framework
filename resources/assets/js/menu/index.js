

import jQuery from 'jquery';

export default (function () {
    jQuery('#menu-nav-list li:first-child a').tab('show')

            var frontMenu = jQuery("ul.front-menu").sortable({
                nested: true,
                group: "front-menu",
                onDragStart: function ($item, container, _super) {
                    if (!container.options.drop)
                        $item.clone().insertAfter($item);
                    _super($item, container);
                },
                onDrop: function ($item, container, _super) {
                    var data = frontMenu.sortable("serialize").get();

                    var jsonString = JSON.stringify(data, null, ' ');


                    jQuery('#menu-list').val(jsonString);
                    _super($item, container);
                }
            });

            jQuery(document).on('click', '.destroy-menu', function (e) {
                e.preventDefault();
                jQuery(e.target).parents('li:first').remove();

                var data = frontMenu.sortable("serialize").get();

                var jsonString = JSON.stringify(data, null, ' ');
                jQuery('#menu-list').val(jsonString);
                _super($item, container);
            });

            jQuery("ul.left-menu").sortable({
                nested: false,
                group: "front-menu",
                drag: true,
                drop: false
            });
            
            let data = frontMenu.sortable("serialize").get();
            let current_menu = JSON.stringify(data, null, ' ');
            jQuery('#menu-list').val(current_menu);
}())
