<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\MailboxMessage;

class MailboxController extends Controller
{
    /**
     * Menampilkan semua pesan dalam satu view (list + detail).
     */
    public function index()
    {
        $mails = MailboxMessage::latest()->get();

        // Siapkan data untuk JavaScript dan komponen Blade
        $mailList = $mails->map(function ($mail) {
            return [
                'id' => $mail->id,
                'title' => $mail->title,
                'sender' => $mail->sender,
                'created_at' => $mail->created_at->format('d M Y H:i'),
                'displayDescription' => Str::limit(strip_tags($mail->body), 100),
                'is_read' => $mail->is_read,
            ];
        });

        return view('apps.mailbox', [
            'mailList' => $mails,
            'mailListJson' => $mailList->toJson(),
        ]);
    }

    /**
     * Tandai pesan sebagai sudah dibaca (opsional untuk AJAX).
     */
    public function markAsRead($id)
    {
        $message = MailboxMessage::findOrFail($id);
        $message->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }
}
