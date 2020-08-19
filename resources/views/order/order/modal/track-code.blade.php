<a-modal title="{{ __('avored::system.change_track_code') }}" v-model="track_code_modal_visibility"
      @cancel="handleTrackCodeCancel" ok-text="{{__('avored::system.btn.save') }}" @ok="handleTrackCodeOk">

      <avored-input
            label-text="Tracking Code"
            field-name="track_code"
            :init-value="track_code"
            v-model="track_code"
          >
          </avored-input>

</a-modal>
