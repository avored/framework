import PageSave from './PageSave.vue'
import { EventBus } from '../../../js/app'

export const Widget = {
    click: function (toolbar) {
        window.x = EventBus;
        EventBus.$emit('widgetClick', toolbar)
    }
}
