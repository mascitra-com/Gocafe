<?php

namespace App\Http\Controllers;

use App\Cafe;
use App\User;
use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class MessagesController extends Controller
{
    /**
     * Show all of the message threads to the user.
     *
     * @return mixed
     */
    public function index()
    {
        // All threads that user is participating in
        $threads = Thread::forUser(Auth::id())->latest('updated_at')->get();
        foreach ($threads as $key => $thread) {
            $users = User::whereIn('id', $thread->participantsUserIds())->get();
            $senderAvatar = str_replace('storage/owner/', 'img/cache/small-avatar/', Storage::url($users[0]->avatar_name));
            $recipientAvatar = str_replace('storage/owner/', 'img/cache/small-avatar/', Storage::url($users[1]->avatar_name));
            $threads[$key]->users = $users;
            $threads[$key]->senderAvatar = $senderAvatar;
            $threads[$key]->recipientAvatar = $recipientAvatar;
        }
        return view('messenger.index', compact('threads'));
    }

    /**
     * Shows a message thread.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');

            return redirect()->route('messages');
        }

        $users = User::whereIn('id', $thread->participantsUserIds())->get();

        // don't show the current user in list
        $senderAvatar = str_replace('storage/owner/', 'img/cache/small-avatar/', Storage::url($users[0]->avatar_name));
        $recipientAvatar = str_replace('storage/owner/', 'img/cache/small-avatar/', Storage::url($users[1]->avatar_name));
        $thread->markAsRead(Auth::id());
        $threads = Thread::forUser(Auth::id())->latest('updated_at')->get();
        foreach ($threads as $key => $thread) {
            $users = User::whereIn('id', $thread->participantsUserIds())->get();
            $senderAvatar = str_replace('storage/owner/', 'img/cache/small-avatar/', Storage::url($users[0]->avatar_name));
            $recipientAvatar = str_replace('storage/owner/', 'img/cache/small-avatar/', Storage::url($users[1]->avatar_name));
            $threads[$key]->users = $users;
            $threads[$key]->senderAvatar = $senderAvatar;
            $threads[$key]->recipientAvatar = $recipientAvatar;
        }
        $recipient = User::whereIn('id', $thread->participantsUserIds())->where('id', '!=', Auth::id())->get();
        return view('messenger.index', compact('thread', 'users', 'recipientAvatar', 'senderAvatar', 'threads', $recipient));
    }

    /**
     * Creates a new message thread.
     *
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
        $cafe = Cafe::where('slug', $request->input('send_to'))->first();
        $recipient = User::findOrfail($cafe->owner->user_id);
        $avatar = str_replace('storage/owner/', 'img/cache/small-avatar/', Storage::url($recipient->avatar_name));
        return view('messenger.index', compact('recipient', 'avatar', 'cafe'));
    }

    /**
     * Stores a new message thread.
     *
     * @return mixed
     */
    public function store()
    {
        $input = Input::all();
        $thread = Thread::create([
            'subject' => $input['subject'],
        ]);

        // Message
        Message::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'body' => $input['message'],
        ]);

        // Sender
        Participant::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'last_read' => new Carbon,
        ]);

        // Recipients
        $thread->addParticipant($input['recipient']);

        return redirect()->route('messages.show', $thread->id);
    }

    /**
     * Adds a new message to a current thread.
     *
     * @param $id
     * @return mixed
     */
    public function update($id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');

            return redirect()->route('messages');
        }

        $thread->activateAllParticipants();

        // Message
        Message::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'body' => Input::get('message'),
        ]);

        // Add replier as a participant
        $participant = Participant::firstOrCreate([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
        ]);
        $participant->last_read = new Carbon;
        $participant->save();

        // Recipients
        if (Input::has('recipients')) {
            $thread->addParticipant(Input::get('recipients'));
        }

        return redirect()->route('messages.show', $id);
    }
}