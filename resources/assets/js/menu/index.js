

import jQuery from 'jquery';

export default (function () {
    class Menu {

        constructor() {
            jQuery('.left-menu li').on('dragstart', this.navDragStart);

            jQuery('.dropable-menu-tree li').on('drop', this.navDropEvent);
            jQuery('.dropable-menu-tree li').on('dragover', this.navDragOver);
        }
        

        navDragStart(e) {
            e.preventDefault();
            window.x = e;
            e.originalEvent.dataTransfer.setData("draggable_nav_id", e.target.id);
            console.log(e.target.id);
        }

        navDragOver(e) {
            alert('jhere');
            e.preventDefault();
        }
        
        navDropEvent(e) {
            alert('drop event');
            let navId = e.originalEvent.dataTransfer.getData("draggable_nav_id");
            console.log(navId);
        }
      
      
      }
      
      let menu = new Menu();
      


    jQuery('#menu-nav-list li:first-child a').tab('show')

    /*             var frontMenu = jQuery("ul.front-menu").sortable({
                nested: true,
                group: "front-menu",
                onDragStart: function ($item, container, _super) {
                    if (!container.options.drop) {
                        $item.clone().insertAfter($item);
                    }
                    _super($item, container);
                },
                onDrop: function ($item, container, _super) {
                    var data = frontMenu.sortable("serialize").get();
                    var jsonString = JSON.stringify(data, null, ' ');
                    jQuery('#menu-list').val(jsonString);
                    _super($item, container);
                }
            });

            jQuery('.left-menu').sortable({
                group: "front-menu",
                itemSelector: 'li',
                drag: true,
                drop: false
            });

            jQuery(document).on('click', '.destroy-menu', function (e) {
                e.preventDefault();
                jQuery(e.target).parents('li:first').remove();

                var data = frontMenu.sortable("serialize").get();

                var jsonString = JSON.stringify(data, null, ' ');
                jQuery('#menu-list').val(jsonString);
                _super($item, container);
            });

           
            
            //let data = frontMenu.sortable("serialize").get();
            //let current_menu = JSON.stringify(data, null, ' ');
            //jQuery('#menu-list').val(current_menu);
    */
}())
