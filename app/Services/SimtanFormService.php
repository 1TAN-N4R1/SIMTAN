<?php

namespace App\Services;

use App\Imports\DetailArealImport;
use App\Imports\DetailRekapImport;
use App\Imports\KomposisiLahanImport;
use App\Imports\LokasiKebunImport;
use App\Imports\LinkKebunTBMImport;
use App\Mail\MailboxNotification;
use App\Models\MailboxMessage;
use App\Models\SimtanForm;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class SimtanFormService
{
    public static function handleUpload(array $validated, $file)
    {
        // ✅ Simpan file ke storage publik
        $path = $file->store('uploads/simtan', 'public');

        // ✅ Simpan metadata ke simtan_forms
        $form = SimtanForm::create([
            'kode_upload'    => $validated['kode_upload'],
            'diupload_oleh'  => $validated['diupload_oleh'],
            'judul_file'     => $validated['judul_file'],
            'tanggal_upload' => $validated['tanggal_upload'],
            'kategori_file'  => $validated['kategori_file'],
            'periode_data'   => $validated['periode_data'],
            'notes'          => $validated['notes'] ?? null,
            'file_path'      => $path,
        ]);

        // ✅ Import Excel sesuai kategori dan sertakan kode_upload
        if ($validated['kategori_file'] === 'Lokasi Kebun') {
            Excel::import(new LokasiKebunImport($validated['kode_upload']), $file);
        } elseif ($validated['kategori_file'] === 'Rekap TBM') {
            Excel::import(new DetailRekapImport($validated['kode_upload']), $file);
        } elseif ($validated['kategori_file'] === 'Komposisi Lahan') {
            Excel::import(new KomposisiLahanImport($validated['kode_upload']), $file);
        } elseif ($validated['kategori_file'] === 'Rincian TBM') {
            Excel::import(new DetailArealImport($validated['kode_upload']), $file);
        } elseif ($validated['kategori_file'] === 'Link Youtube') {
            Excel::import(new LinkKebunTBMImport($validated['kode_upload']), $file);
        }

        // ✅ Buat body email menggunakan Blade View
        $bodyView = view('components.mailbox.message-template', [
            'judul_file'    => $form->judul_file,
            'kategori_file' => $form->kategori_file,
            'periode_data'  => $form->periode_data,
            'notes'         => $form->notes,
            'file_path'     => $form->file_path,
        ])->render();

        // ✅ Simpan ke Mailbox
        $message = MailboxMessage::create([
            'title'     => '📥 Data ' . $form->kategori_file . ' berhasil diunggah',
            'body'      => $bodyView,
            'sender'    => 'Sistem',
            'recipient' => $form->diupload_oleh ?? 'User',
            'file_path' => $form->file_path,
        ]);

        // ✅ Kirim notifikasi email (opsional)
        $recipientEmail = $validated['diupload_oleh_email'] ?? 'user@example.com';
        Mail::to($recipientEmail)->send(new MailboxNotification($message));

        return $form;
    }
}
