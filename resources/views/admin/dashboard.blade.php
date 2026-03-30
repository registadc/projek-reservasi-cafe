@extends('admin.layouts.app')

@section('title','dashboard')

@section('content')

            <section class="stats-grid">
                <div class="glass-card glass-card-3d stat-card">
                    <div class="stat-card-inner">
                        <div class="stat-info">
                            <h3>Total Users</h3>
                            <div class="stat-value">{{ $totalUsers }}</div>
                            <span class="stat-change positive">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/></svg>
                                +12.5%
                            </span>
                        </div>
                        <div class="stat-icon cyan">
                            <i class="fa-solid fa-users"></i>
                        </div>
                    </div>
                </div>

                <div class="glass-card glass-card-3d stat-card">
                    <div class="stat-card-inner">
                        <div class="stat-info">
                            <h3>Total Reservasi</h3>
                            <div class="stat-value">{{ $totalReservasi }}</div>
                            <span class="stat-change positive">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/></svg>
                                +8.2%
                            </span>
                        </div>
                        <div class="stat-icon magenta">
                            <i class="fa-solid fa-calendar-check"></i>
                        </div>
                    </div>
                </div>

                <div class="glass-card glass-card-3d stat-card">
                    <div class="stat-card-inner">
                        <div class="stat-info">
                            <h3>Total Menu</h3>
                            <div class="stat-value">{{ $totalMenu }}</div>
                            <span class="stat-change negative">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 18 13.5 8.5 8.5 13.5 1 6"/></svg>
                                -3.1%
                            </span>
                        </div>
                        <div class="stat-icon purple">
                            <i class="fa-solid fa-utensils"></i>
                        </div>
                    </div>
                </div>

                
            </section>

            <!-- Content Grid -->
            <section class="content-grid">
                <!-- Chart Card -->
                <div class="glass-card chart-card">
                    <div class="card-header">
                        <div>
                            <h2 class="card-title">Reservation Analytics</h2>
                            <p class="card-subtitle">Monthly reservation overview</p>
                        </div>
                        <div class="card-actions">
                            <button class="card-btn active">Monthly</button>
                        </div>
                    </div>
                    <div class="chart-wrapper">
                        <div class="chart-container">
                            <div class="chart-y-axis">
                                @php
                                    $step = ceil($maxReservasi / 5);
                                @endphp

                                @for ($i = 5; $i >= 0; $i--)
                                    <span class="y-value">{{ $step * $i }}</span>
                                @endfor
                            </div>

                            <div class="chart-placeholder">
                                @php
                                    $months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
                                @endphp

                                @foreach($months as $index => $month)
                                    @php
                                        $value = $reservasiChart[$index+1] ?? 0;
                                        $height = $maxReservasi > 0 ? ($value / $maxReservasi) * 200 : 0;
                                    @endphp

                                    <div class="chart-bar-group">
                                        <div class="chart-bar bar-emerald" style="height: {{ $height }}px;"></div>
                                        <span class="chart-label">{{ $month }}</span>
                                    </div>
                                @endforeach
                            </div>
                           
                        </div>
                    </div>
                </div>

                <!--- menu best seller feed -->
                <div class="glass-card activity-card">
                    <div class="card-header">
                        <div>
                            <h2 class="card-title">Best Seller</h2>
                            <p class="card-subtitle">Menu paling sering dipesan</p>
                        </div>
                    </div>
                    <div class="activity-list">
                        <div class="activity-item">
                            <div class="activity-avatar" style="background: linear-gradient(135deg, var(--emerald-light), var(--emerald));">1</i></div>
                            <div class="activity-content">
                                <p class="activity-text"><strong>Giee Signature Matcha</strong><br> Rp 30.000</p>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-avatar" style="background: linear-gradient(135deg, var(--gold), var(--amber));">2</div>
                            <div class="activity-content">
                                <p class="activity-text"><strong>Giee Rustic Sourdough</strong><br> Rp 35.000</p>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-avatar" style="background: linear-gradient(135deg, var(--coral), var(--gold));">3</div>
                            <div class="activity-content">
                                <p class="activity-text"><strong>Giee House Blend Coffee</strong><br> Rp 25.000</p>
                            </div>
                        </div>
                    </div>
                </div>

    <!-- Mobile Menu Toggle -->
    <button class="mobile-menu-toggle">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/>
        </svg>
    </button>

    <script src="{{ asset('template/templatemo-glass-admin-script.js') }}"></script>
    
    <!-- TemplateMo 607 Glass Admin -->
@endsection