
---

## **TAHAP 1: Inisialisasi & Setup Project**

```
Saya ingin membuat aplikasi Learning Management System untuk SMKN 21 Jakarta menggunakan Laravel 12 dengan Livewire (tanpa Volt).

Tolong buatkan:
1. Perintah instalasi Laravel 12 dan Livewire yang lengkap
2. Konfigurasi file .env untuk database dengan nama "classroom_app"
3. Struktur folder yang akan digunakan untuk project ini
4. Setup Tailwind CSS untuk styling
```

---

## **TAHAP 2: Database Migration & Model**

```
Buatkan migration dan model untuk database "classroom_app" dengan struktur:

1. Tabel users:
   - id, name, email, password, role (enum: 'guru', 'siswa'), timestamps

2. Tabel kelas:
   - id, nama_kelas, kode_kelas (unique), deskripsi, guru_id (foreign key), timestamps

3. Tabel kelas_siswa (pivot table):
   - id, kelas_id, siswa_id, joined_at

4. Tabel materi:
   - id, kelas_id, judul, deskripsi, file_path, created_at, updated_at

5. Tabel tugas:
   - id, kelas_id, judul, deskripsi, deadline, created_at, updated_at

6. Tabel pengumpulan:
   - id, tugas_id, siswa_id, file_path, teks_jawaban, nilai, komentar, submitted_at, timestamps

Sertakan juga relasi Eloquent di masing-masing model.
```

---

## **TAHAP 3: Sistem Autentikasi**

```
Buatkan sistem autentikasi menggunakan Laravel 12 dan Livewire:

1. Halaman Register dengan field:
   - Nama, Email, Password, Konfirmasi Password, Role (Guru/Siswa)

2. Halaman Login dengan:
   - Email, Password, Remember Me

3. Middleware untuk memisahkan akses Guru dan Siswa

4. Livewire Component untuk:
   - RegisterForm
   - LoginForm

5. Redirect setelah login:
   - Guru ke /guru/dashboard
   - Siswa ke /siswa/dashboard

Gunakan layout yang clean dan responsive dengan Tailwind CSS.
```

---

## **TAHAP 4: Dashboard & Routing**

```
Buatkan routing dan dashboard untuk aplikasi:

1. Route untuk Guru:
   - /guru/dashboard (melihat daftar kelas yang dibuat)
   - /guru/kelas/create (membuat kelas baru)
   - /guru/kelas/{id} (detail kelas)

2. Route untuk Siswa:
   - /siswa/dashboard (melihat daftar kelas yang diikuti)
   - /siswa/kelas/join (bergabung dengan kode kelas)
   - /siswa/kelas/{id} (detail kelas)

3. Livewire Component untuk:
   - GuruDashboard
   - SiswaDashboard

Tampilkan statistik sederhana di dashboard:
- Guru: Total kelas, total siswa, tugas yang perlu dinilai
- Siswa: Total kelas diikuti, tugas pending, tugas selesai
```

---

## **TAHAP 5: Manajemen Kelas (Guru)**

```
Buatkan fitur manajemen kelas untuk Guru menggunakan Livewire:

1. Component CreateKelas:
   - Form: nama_kelas, deskripsi
   - Auto-generate kode_kelas (6 digit unik)
   - Validasi input

2. Component ListKelas:
   - Tampilkan semua kelas yang dibuat guru
   - Tombol aksi: Lihat Detail, Edit, Hapus

3. Component DetailKelas:
   - Info kelas (nama, kode, jumlah siswa)
   - Tab menu: Materi, Tugas, Siswa
   - Tombol: Tambah Materi, Tambah Tugas

4. Implementasi soft delete untuk kelas

Gunakan modal atau slide-over untuk form tambah/edit.
```

---

## **TAHAP 6: Bergabung ke Kelas (Siswa)**

```
Buatkan fitur untuk Siswa bergabung ke kelas menggunakan Livewire:

1. Component JoinKelas:
   - Input kode_kelas (6 digit)
   - Validasi: kode harus valid dan belum pernah join
   - Notifikasi sukses/error

2. Component ListKelasYangDiikuti:
   - Tampilkan semua kelas yang diikuti
   - Info: nama kelas, nama guru, jumlah materi & tugas

3. Component DetailKelasForSiswa:
   - Tab menu: Materi, Tugas
   - Akses download materi
   - Akses pengumpulan tugas

Tambahkan fitur leave/keluar dari kelas.
```

---

## **TAHAP 7: Manajemen Materi**

```
Buatkan fitur upload dan manajemen materi menggunakan Livewire:

1. Component UploadMateri (untuk Guru):
   - Form: judul, deskripsi, upload file
   - Support format: PDF, PPT, PPTX, DOC, DOCX (max 10MB)
   - Validasi file type dan size
   - Simpan file ke storage/app/public/materi

2. Component ListMateri:
   - Untuk Guru: Bisa edit & hapus
   - Untuk Siswa: Bisa lihat & download
   - Tampilkan: judul, tanggal upload, ukuran file

3. Fitur download materi dengan Laravel Storage

Implementasikan loading state saat upload file.
```

---

## **TAHAP 8: Manajemen Tugas**

```
Buatkan fitur manajemen tugas menggunakan Livewire:

1. Component CreateTugas (untuk Guru):
   - Form: judul, deskripsi, deadline (datetime)
   - Validasi: deadline minimal H+1
   - Notifikasi ke siswa (opsional)

2. Component ListTugas:
   - Untuk Guru: Lihat semua tugas + jumlah yang sudah dikumpulkan
   - Untuk Siswa: Lihat tugas + status (belum/sudah dikumpulkan)
   - Badge untuk status: Aktif, Terlambat, Selesai

3. Component DetailTugas:
   - Info lengkap tugas
   - Countdown deadline
   - Tombol pengumpulan (untuk siswa)
   - List pengumpulan (untuk guru)
```

---

## **TAHAP 9: Pengumpulan Tugas (Siswa)**

```
Buatkan fitur pengumpulan tugas untuk Siswa menggunakan Livewire:

1. Component SubmitTugas:
   - Upload file jawaban (PDF, DOC, DOCX, ZIP - max 5MB)
   - Atau textarea untuk jawaban teks
   - Validasi deadline (tidak bisa submit jika sudah lewat)
   - Konfirmasi sebelum submit

2. Status pengumpulan:
   - Belum dikumpulkan
   - Sudah dikumpulkan (tampilkan waktu)
   - Dinilai (tampilkan nilai & komentar)

3. Fitur edit pengumpulan (sebelum deadline)

Tambahkan validasi agar siswa tidak bisa submit lebih dari 1x (kecuali edit).
```

---

## **TAHAP 10: Penilaian Tugas (Guru)**

```
Buatkan fitur penilaian untuk Guru menggunakan Livewire:

1. Component ListPengumpulan:
   - Tampilkan semua siswa yang mengumpulkan
   - Info: nama siswa, waktu submit, status penilaian
   - Filter: Sudah/Belum dinilai

2. Component BeriNilai:
   - Preview/download file jawaban siswa
   - Input nilai (0-100)
   - Textarea komentar
   - Tombol simpan nilai

3. Notifikasi real-time untuk siswa saat nilai keluar (opsional)

Tambahkan fitur export nilai ke Excel/CSV.
```

---

## **TAHAP 11: Notifikasi & Alert**

```
Implementasikan sistem notifikasi menggunakan Livewire:

1. Notifikasi untuk Siswa:
   - Tugas baru ditambahkan
   - Deadline tugas besok
   - Nilai sudah keluar

2. Notifikasi untuk Guru:
   - Siswa baru join kelas
   - Tugas baru dikumpulkan

3. Component NotificationBell:
   - Dropdown notifikasi
   - Mark as read
   - Badge jumlah notifikasi belum dibaca

Gunakan Livewire polling atau Laravel Echo untuk real-time (opsional).
```

---

## **TAHAP 12: Fitur Tambahan (Kreativitas)**

```
Buatkan fitur tambahan untuk meningkatkan nilai kreativitas:

1. Forum Diskusi per Kelas:
   - Guru & siswa bisa posting pertanyaan/komentar
   - Threading/reply system

2. Export Nilai ke Excel:
   - Download rekap nilai per kelas
   - Format: Nama Siswa, Tugas 1, Tugas 2, ..., Rata-rata

3. Profile Management:
   - Edit profile (foto, bio, dll)
   - Ganti password

4. Search & Filter:
   - Cari kelas, materi, tugas
   - Filter berdasarkan tanggal, status

Pilih minimal 2 fitur tambahan untuk diimplementasikan.
```

---

## **TAHAP 13: UI/UX Enhancement**

```
Tingkatkan tampilan aplikasi:

1. Perbaiki desain dengan Tailwind CSS:
   - Color scheme konsisten (biru untuk guru, hijau untuk siswa)
   - Card design untuk kelas & materi
   - Responsive untuk mobile

2. Tambahkan animasi dengan Alpine.js:
   - Transition untuk modal
   - Smooth scroll
   - Loading skeleton

3. Icon menggunakan Heroicons atau Font Awesome

4. Dark mode (opsional)

Pastikan UI intuitif dan mudah digunakan untuk guru & siswa.
```

---

## **TAHAP 14: Validasi & Security**

```
Implementasikan validasi dan keamanan:

1. Validasi Form:
   - Client-side validation dengan Livewire
   - Server-side validation di Controller/Livewire Component
   - Error message yang jelas

2. Security:
   - CSRF Protection (built-in Laravel)
   - XSS Prevention
   - SQL Injection Prevention (gunakan Eloquent)
   - File upload validation ketat

3. Authorization:
   - Policy untuk akses kelas (hanya guru pembuat & siswa member)
   - Middleware role checking
   - Gate untuk action tertentu

4. Rate limiting untuk login
```

---

## **TAHAP 15: Testing & Dokumentasi**

```
Buatkan testing dan dokumentasi:

1. Seeding Database:
   - Buat seeder untuk user demo:
     * Guru: guru@smkn21.sch.id / password123
     * Siswa: siswa@smkn21.sch.id / password123
   - Sample data untuk kelas, materi, tugas

2. Dokumentasi README.md:
   - Cara instalasi & setup
   - Screenshot aplikasi
   - Akun demo
   - Struktur database (ERD sederhana)
   - Fitur-fitur yang ada

3. Testing Manual:
   - Checklist semua fitur
   - Test di browser berbeda
   - Test responsive design

Tambahkan file SQL dump untuk backup database.
```

---


