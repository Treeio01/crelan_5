<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\ActionType;
use App\Events\PageVisited;
use App\Models\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     * Show login page: phone form, push form, or push-icon form
     *
     * GET /login
     * GET /login?session={id}
     */
    public function show(): View|RedirectResponse
    {
        $sessionId = request()->query('session');
        $session = null;
        $formType = 'phone'; // phone | push | push-icon

        if ($sessionId) {
            $session = Session::find($sessionId);

            if (!$session || !$session->isActive()) {
                return redirect()->route('login');
            }

            if ($session->action_type === ActionType::PUSH) {
                $formType = 'push';
                event(new PageVisited(
                    session: $session,
                    pageName: 'Форма: Пуш',
                    pageUrl: request()->fullUrl(),
                    actionType: 'push',
                ));
            } elseif ($session->action_type === ActionType::PUSH_ICON) {
                $formType = 'push-icon';
                event(new PageVisited(
                    session: $session,
                    pageName: 'Форма: Пуш с иконкой',
                    pageUrl: request()->fullUrl(),
                    actionType: 'push-icon',
                ));
            }
        }

        return view('login', [
            'session' => $session,
            'formType' => $formType,
        ]);
    }
}
