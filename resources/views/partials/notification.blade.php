<div
	x-data="noticesHandler()"
	class="fixed inset-0 flex flex-col-reverse items-end justify-start h-screen w-screen"
	x-on:notification.window="add($event.detail)"
	style="pointer-events:none">


        <template x-for="notice of notices" x-bind:key="notice.id">
		<div
			x-show="visible.includes(notice)"
			x-transition:enter="transition ease-in duration-200"
			x-transition:enter-start="transform opacity-0 translate-y-2"
			x-transition:enter-end="transform opacity-100"
			x-transition:leave="transition ease-out duration-500"
			x-transition:leave-start="transform translate-x-0 opacity-100"
			x-transition:leave-end="transform translate-x-full opacity-0"
			x-on:click="remove(notice.id)"
			class="rounded mb-4 px-6 mr-6  w-auto  h-16 flex items-center justify-center text-white shadow-lg font-bold text-lg cursor-pointer"
			x-bind:class="{
				'bg-green-500': notice.type === 'success',
				'bg-blue-500': notice.type === 'info',
				'bg-orange-500': notice.type === 'warning',
				'bg-red-500': notice.type === 'error',
			 }"
			style="pointer-events:all"
			x-text="notice.text">
		</div>
	</template>
</div>


@if (session('successNotification'))
    <div x-data="sessionNotification()" x-init="init($dispatch, 'success', '{{ session()->get('successNotification') }}')"></div>
@endif

@push('bottom-scripts')
<script>
    function sessionNotification() {
        return {
            test: 0,
            init(dispatch, type, text) {
                console.log(type, text)
                this.test++
                window.x = dispatch
                dispatch('notification', {type: type, text: text})
            }
        }
    }
    function noticesHandler() {
        return {
            notices: [],
            visible: [],
            add(notice) {
                notice.id = Date.now()
                this.notices.push(notice)
                this.fire(notice.id)
            },
            fire(id) {
                this.visible.push(this.notices.find(notice => notice.id == id))
                const timeShown = 3000 * this.visible.length
                setTimeout(() => {
                    this.remove(id)
                }, timeShown)
            },
            remove(id) {
                const notice = this.visible.find(notice => notice.id == id)
                const index = this.visible.indexOf(notice)
                this.visible.splice(index, 1)
            }
        }
    }

</script>
@endpush