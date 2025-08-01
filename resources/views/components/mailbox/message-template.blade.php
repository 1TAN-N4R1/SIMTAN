<div style="font-family: Arial, sans-serif; font-size: 14px; color: #333;">
    <h2 style="color: #4CAF50; margin-bottom: 10px;">📂 Data Baru Telah Diupload</h2>
    
    <p style="margin: 8px 0;">
        <strong>Judul File:</strong> {{ $judul_file }}
    </p>
    <p style="margin: 8px 0;">
        <strong>Kategori:</strong> {{ $kategori_file }}
    </p>
    <p style="margin: 8px 0;">
        <strong>Periode Data:</strong> {{ $periode_data }}
    </p>
    <p style="margin: 8px 0;">
        <strong>Keterangan:</strong> {{ $notes ?? '-' }}
    </p>

    <p style="margin: 15px 0;">
        <a href="{{ asset('storage/' . $file_path) }}" 
           style="display: inline-block; padding: 10px 15px; background: #4CAF50; color: #fff; text-decoration: none; border-radius: 4px;">
           📥 Unduh File
        </a>
    </p>

    <hr style="margin-top: 20px; border: 0; border-top: 1px solid #ddd;">

    <p style="font-size: 12px; color: #777;">
        Email ini dikirim otomatis oleh Sistem SIMTAN.<br>
        Mohon jangan balas email ini.
    </p>
</div>
