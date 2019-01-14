

import jQuery from 'jquery';

export default (function () {
    jQuery(document).ready(function() {
        var simplemde = new SimpleMDE(
            { 
                element: document.getElementById('content'),
                toolbar: [
                    'bold', 'italic', 'heading', '|',
                    'quote', 'unordered-list' , 'ordered-list', '|',
                    'link', 'image',  '|',
                    'preview',
                    {
                        name: 'avored_widget',
                        action: function() {
                           
                            jQuery('#widget-list-modal').modal();
                            simplemde.codemirror.refresh();
                        },
                        className: 'ti-menu',
                        title: 'AvoRed Widget',
                    },
                    'guide'
                ],
            }
        );

        jQuery('#content').data('SimpleMDEInstance', simplemde);
        jQuery(document).on("click", "#widget-insert-button", function(e) {  
            e.preventDefault();
            var widgetIdentifier = jQuery('#widget_list').val();
            var cm = jQuery('#content').data('SimpleMDEInstance').codemirror;
            var output = '%%% ' + widgetIdentifier + ' %%%';
            cm.replaceSelection(output); 
            
            jQuery('#widget-list-modal').modal('hide');
        });
    });
}());
