<a-col :span="4" :xs="24" :sm="12" :md="6">
    <a-card title="{{ __('avored::system.total-revenue') }}" class="dashboard-widget mt-1 info">
        <p class="amount">{{ session()->get('default_currency')->symbol }}{{ $value }}</p>
    </a-card>
</a-col>
