<a-modal
      title="{{ __('avored::order.order.index.order_status') }}"
      v-model="change_status_modal_visibility"
      @cancel="handleChangeStatusCancel"
      ok-text="{{__('avored::system.btn.save') }}"
      @ok="handleChangeStatusOk">
      <a-row>
            <a-col :span="24">
                  <a-form-item
                  @if ($errors->has('order_status_id'))
                        validate-status="error"
                        help="{{ $errors->first('order_status_id') }}"
                  @endif
                  label="{{ __('avored::order.order.index.order_status') }}">
                        <a-select :style="{'width':'100%'}" @change="changeStatusDropdown">
                              @foreach ($orderStatuses as $orderStatus)                                
                              <a-select-option value="{{ $orderStatus->id }}">{{ $orderStatus->name }}</a-select-option>
                              @endforeach
                        </a-select>
                        <input type="hidden" v-model="changeStatusId" />
                  </a-form-item>
            </a-col>
      </a-row>

</a-modal>
