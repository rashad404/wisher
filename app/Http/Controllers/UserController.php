<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Contact;
use App\Models\Message;
use App\Models\Activity;
use App\Models\Conversation;
use App\Models\UserEvent;

class UserController extends Controller
{
    public function index()
    {
        // Get the authenticated user
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Fetch user's first and last name from profile
        $firstName = $user->profile->first_name ?? '';
        $lastName = $user->profile->last_name ?? '';

        // Retrieve dashboard data
        $contactsCount = Contact::where('user_id', $user->id)->count();
        $eventsCount = UserEvent::where('user_id', $user->id)->count();

        // Fetch all conversations the user is part of
        $conversations = Conversation::where('user1_id', $user->id)
            ->orWhere('user2_id', $user->id)
            ->pluck('id');
        // Count outgoing messages (sent by the user)
        $sentMessagesCount = Message::whereIn('conversation_id', $conversations)
            ->where('sender_id', $user->id)
            ->count();

        // Count incoming messages (not sent by the user)
        $receivedMessagesCount = Message::whereIn('conversation_id', $conversations)
            ->where('sender_id', '!=', $user->id)
            ->count();

        // Total message count
        $messagesCount = $sentMessagesCount + $receivedMessagesCount;

        // Fetch recent activities (example activity log model or similar)
        $recentActivities = Activity::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5) // Limit to the latest 5 activities
            ->get();

        // Fetch upcoming events
        $upcomingEvents = UserEvent::where('user_id', $user->id)
            ->where('date', '>=', now())
            ->orderBy('date', 'asc')
            ->take(5) // Limit to the next 5 events
            ->get();

        // Fetch all conversations the user is part of
        $conversations = Conversation::where('user1_id', $user->id)
            ->orWhere('user2_id', $user->id)
            ->pluck('id');

        // Fetch recent messages in those conversations
        $recentMessages = Message::whereIn('conversation_id', $conversations)
            ->orderBy('created_at', 'desc')
            ->take(5) // Limit to the latest 5 messages
            ->get();

        // Pass all the data to the view
        return view('user.index', compact(
            'firstName',
            'lastName',
            'contactsCount',
            'eventsCount',
            'messagesCount',
            'recentActivities',
            'upcomingEvents',
            'recentMessages'
        ));
    }
}
