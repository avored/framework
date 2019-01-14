<div class="widget">
    <div class="card card-statistics" style="cursor: move;">        
    	<div class="card-body">
    		<div class="clearfix">
    			<div class="float-left">
    				<span class="text-primary">
    					<i class="fa fa-bank highlight-icon" aria-hidden="true"></i>
    				</span>
    			</div>

    			<div class="float-right text-right">
    				<p class="card-text text-dark">&nbsp;</p>
    				<h4>{{ $currencySymbol }} {{ $monthlyRevenue }}</h4>
    			</div>
    		</div>

    		<p class="text-muted mt-3 pt-3 border-top">
    			<i class="fa fa-bookmark-o mr-1" aria-hidden="true"></i> {{ __('avored-framework::lang.admin-dashboard-monthly-revenue-title') }}
    		</p>
    	</div>
    </div>
</div>