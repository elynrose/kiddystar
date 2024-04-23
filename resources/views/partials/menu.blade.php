<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }} {{ request()->is("admin/configurations*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('configuration_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.configurations.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/configurations") || request()->is("admin/configurations/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.configuration.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('card_batch_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.card-batches.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/card-batches") || request()->is("admin/card-batches/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-archive c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.cardBatch.title') }}
                </a>
            </li>
        @endcan
        @can('card_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.cards.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/cards") || request()->is("admin/cards/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-address-card c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.card.title') }}
                </a>
            </li>
        @endcan
        @can('user_card_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.user-cards.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/user-cards") || request()->is("admin/user-cards/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-retweet c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userCard.title') }}
                </a>
            </li>
        @endcan
        @can('point_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.points.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/points") || request()->is("admin/points/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-star c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.point.title') }}
                </a>
            </li>
        @endcan
        @can('claim_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.claims.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/claims") || request()->is("admin/claims/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-hand-holding-usd c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.claim.title') }}
                </a>
            </li>
        @endcan
        @can('user_alert_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.user-alerts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-bell c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userAlert.title') }}
                </a>
            </li>
        @endcan
        @can('reward_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.rewards.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/rewards") || request()->is("admin/rewards/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-box-open c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.reward.title') }}
                </a>
            </li>
        @endcan
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>