<a-modal
      title="{{ __('avored::order.order.index.order_status') }}"
      v-model="change_status_modal_visibility"
      @cancel="handleChangeStatusCancel"
      ok-text="{{__('avored::system.btn.save') }}"
      @ok="handleChangeStatusOk">
      <div class="block">

            <avored-select
                  label-text="{{ __('avored::order.order.index.order_status') }}"
                  field-name="order_status_id"
                  error-text="{{ $errors->first('order_status_id') }}"
                  :options="{{ json_encode($orderStatuses) }}"
                  {{-- init-value="{{ $property->data_type ?? '' }}" --}}
                  v-model="changeStatusId"
            >
            </avored-select>
      </div>
</a-modal>
