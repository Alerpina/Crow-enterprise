<div class="row">
    <div class="col-lg-12">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link {{request()->is('admin/page-settings/best-seller') ? 'active' : ''}}" href="{{ route('admin-ps-best-seller') }}" role="tab">{{ __('Best Seller') }}</a>
                <a class="nav-item nav-link {{request()->is('admin/page-settings/big-save') ? 'active' : ''}}" href="{{ route('admin-ps-big-save') }}" role="tab">{{ __('Big Save') }}</a>
                <a class="nav-item nav-link {{request()->is('admin/top/small/banner') ? 'active' : ''}}" href="{{ route('admin-sb-index') }}" role="tab">{{ __('Top Small') }}</a>
                <a class="nav-item nav-link {{request()->is('admin/bottom/small/banner') ? 'active' : ''}}" href="{{ route('admin-sb-bottom') }}" role="tab">{{ __('Bottom Small') }}</a>
                <a class="nav-item nav-link {{request()->is('admin/large/banner') ? 'active' : ''}}" href="{{ route('admin-sb-large') }}" role="tab">{{ __('Large') }}</a>
            </div>
        </nav>
    </div>
</div>