import PageSave from './PageSave.vue'

export const Widget = {
    click: function (toolbar) {
        window.x = window.EventBus;
        window.EventBus.$emit('widgetClick', toolbar)
    }
}
