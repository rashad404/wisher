<?php
namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $conversations = Conversation::where('user1_id', Auth::id())
                        ->orWhere('user2_id', Auth::id())
                        ->with(['user1', 'user2', 'messages' => function ($query) {
                            $query->orderBy('created_at', 'desc')->limit(1);
                        }])
                        ->get();
    
        // Get all users except the authenticated user
        $users = User::where('id', '!=', Auth::id())->get();
    
        return view('chat.index', compact('conversations', 'users'));
    }
    

    public function show(Conversation $conversation)
    {
        $this->authorize('view', $conversation);

        $messages = $conversation->messages()->orderBy('created_at', 'asc')->get();

        return view('chat.show', compact('conversation', 'messages'));
    }

    public function storeMessage(Request $request, Conversation $conversation)
    {
        $this->authorize('view', $conversation);

        $message = $conversation->messages()->create([
            'sender_id' => Auth::id(),
            'body' => $request->body,
            'is_seen' => false,
        ]);

        return redirect()->back();
    }

    public function deleteMessage(Message $message)
    {
        $this->authorize('delete', $message);

        $message->delete();

        return redirect()->back();
    }

    public function deleteConversation(Conversation $conversation)
    {
        $this->authorize('delete', $conversation);

        $conversation->delete();

        return redirect()->route('chat.index');
    }

    public function create(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        // Find or create a conversation between the two users
        $conversation = Conversation::firstOrCreate([
            'user1_id' => Auth::id(),
            'user2_id' => $request->user_id,
        ], [
            'user1_id' => Auth::id(),
            'user2_id' => $request->user_id,
        ]);

        return redirect()->route('chat.show', $conversation);
    }
}
