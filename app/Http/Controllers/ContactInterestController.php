<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Interest;
use Illuminate\Http\Request;

class ContactInterestController extends Controller
{
    public function index(Contact $contact)
    {
        $likes = $contact->interests()->where('contact_interests.type', 'like')->get();
        $dislikes = $contact->interests()->where('contact_interests.type', 'dislike')->get();

        return view('user.contacts.interests', compact('contact', 'likes', 'dislikes'));
    }

    public function store(Request $request, Contact $contact)
    {
        $data = $request->validate([
            'interest_id' => 'required|exists:interests,id',
            'type' => 'required|in:like,dislike',
        ]);

        $interestId = $data['interest_id'];
        $type = $data['type'];

        // Check if the interest is already added as a like or dislike
        $existing = $contact->interests()->where('interest_id', $interestId)->first();

        if ($existing) {
            // If it's already in the other type (like vs dislike), remove it from that type
            if ($existing->pivot->type !== $type) {
                $contact->interests()->updateExistingPivot($interestId, ['type' => $type]);
            } else {
                // If it's already in the same type, do nothing or show an error
                return redirect()->route('contacts.interests.index', $contact)->withErrors(['interest_id' => 'This interest is already added as a ' . $type . '.']);
            }
        } else {
            // Attach the interest with the specified type (like/dislike)
            $contact->interests()->attach($interestId, ['type' => $type]);
        }

        return redirect()->route('contacts.interests.index', $contact)->with('success', 'Interest added successfully.');
    }

    public function destroy(Contact $contact, Interest $interest, $type)
    {
        // Remove the interest from the specified type (like/dislike)
        $contact->interests()->wherePivot('type', $type)->detach($interest->id);

        return redirect()->route('contacts.interests.index', $contact)->with('success', 'Interest removed successfully.');
    }
}
