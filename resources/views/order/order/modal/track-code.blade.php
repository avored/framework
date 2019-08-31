<a-modal
      title="{{ __('avored::order.order.index.change_track_code') }}"
      v-model="track_code_modal_visibility"
      @cancel="handleTrackCodeCancel"
      ok-text="{{__('avored::system.btn.save') }}"
      @ok="handleTrackCodeOk">
      
      <a-form-item
      @if ($errors->has('track_code'))
            validate-status="error"
            help="{{ $errors->first('track_code') }}"
      @endif
      label="{{ __('avored::order.order.index.track_code') }}"
      >
      <a-input
            :auto-focus="true"
            name="track_code"
            v-model="track_code"
            v-decorator="[
            'track_code',
            {rules: 
                  [
                  {   required: true, 
                        message: '{{ __('avored::validation.required', ['attribute' => 'track code']) }}' 
                  }
                  ]
            }
            ]"
      ></a-input>
      </a-form-item>

</a-modal>
