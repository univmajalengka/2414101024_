## 1. Syntax Error (Kesalahan Penulisan)
- **Pesan Error:** `Parse error: syntax error, unexpected token "=" in ... on line 13`
- **Lokasi File:** `proses-pendaftaran-2.php` (Baris 13)
- **Penyebab:** Variabel `sekolah` ditulis tanpa tanda dolar (`$`) di depannya (`sekolah = ...`).



## 2. Logic Error (Kesalahan Logika/Typo)
- **Gejala:** Muncul halaman "Not Found" atau browser gagal mengalihkan halaman setelah data tersimpan.
- **Lokasi File:** `proses-pendaftaran-2.php` (Bagian `else` di bawah pengecekan query).
- **Penyebab:** Kesalahan penulisan nama file tujuan redirect. Tertulis `header('Location: indek.ph?status=gagal');`.
- **Solusi:** Memperbaiki penulisan menjadi `index.php`.


## 3. Security Vulnerability (Celah Keamanan)
security: 
**Masalah:** Kode awal menggunakan metode *string interpolation* langsung ke dalam query SQL (`VALUES ('$nama', ...)`). Ini sangat rentan terhadap serangan **SQL Injection**.
- **Solusi Best Practice:** Mengubah metode penyimpanan data menggunakan **Prepared Statements** (`mysqli_stmt_prepare`, `mysqli_stmt_bind_param`) untuk memisahkan query SQL dari data yang diinput user.