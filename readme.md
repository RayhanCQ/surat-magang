# 📄 Sistem Generate Surat Magang Otomatis

Aplikasi PHP Native sederhana untuk menghasilkan surat magang secara otomatis menggunakan template Microsoft Word (.docx) dan library PHPWord.

---

## ✨ Fitur

- Generate surat magang otomatis dari data mahasiswa
- Menggunakan template Word (.docx)
- Penomoran surat otomatis
- Download file DOCX secara langsung
- Penyimpanan arsip surat ke database
- Penyimpanan file hasil generate ke folder generated

---

## 🛠️ Tech Stack

- PHP Native
- MySQL / MariaDB
- PHPWord
- Composer

---

## 📁 Struktur Project

```text
surat-magang/

├── config/
│   └── database.php
│
├── generated/
│   └── (hasil generate surat)
│
├── templates/
│   └── surat_magang.docx
│
├── vendor/
│
├── database.sql
├── generate.php
├── index.php
├── composer.json
├── composer.lock
├── README.md
└── .gitignore
```

---

## 🚀 Instalasi

### 1️⃣ Clone Repository

```bash
git clone <repository-url>
cd surat-magang
```

### 2️⃣ Install Dependency

```bash
composer install
```

### 3️⃣ Import Database

Menggunakan phpMyAdmin:

1. Buat database baru bernama `suratdb`
2. Import file `database.sql`

Atau menggunakan command line:

```bash
mysql -u root -p < database.sql
```

---

## ▶️ Menjalankan Aplikasi

### PHP Built-in Server

```bash
php -S localhost:8000
```

Buka browser:

```text
http://localhost:8000
```

### XAMPP

Pindahkan project ke:

```text
C:\xampp\htdocs\surat
```

Jalankan Apache dan MySQL melalui XAMPP Control Panel.

Buka browser:

```text
http://localhost/surat
```

---

## 🗄️ Struktur Database

### 👨‍🎓 Tabel Mahasiswa

| Field | Tipe |
|---------|---------|
| id | INT |
| nim | VARCHAR(20) |
| nama | VARCHAR(100) |
| prodi | VARCHAR(100) |
| email | VARCHAR(100) |
| semester | INT |

### 📑 Tabel Surat

| Field | Tipe |
|---------|---------|
| id | INT |
| nomor_surat | VARCHAR(100) |
| mahasiswa_id | INT |
| tanggal_terbit | DATE |
| file_path | VARCHAR(255) |

---

## 📝 Template Surat

Template surat disimpan pada:

```text
templates/surat_magang.docx
```

Placeholder yang digunakan:

```text
${nomor_surat}
${nama}
${nim}
${prodi}
${email}
${semester}
${tanggal}
```

---

## ⚙️ Cara Kerja Sistem

1. User membuka halaman utama.
2. User memilih mahasiswa.
3. User menekan tombol **Generate Surat**.
4. Sistem mengambil data mahasiswa dari database.
5. Sistem membuat nomor surat otomatis.
6. Sistem mengisi placeholder pada template DOCX.
7. Sistem menyimpan file hasil generate ke folder generated.
8. Sistem mencatat data surat ke database.
9. Sistem mengunduh file DOCX ke browser.

---

## 🔢 Format Nomor Surat

```text
001/MAGANG/TK/VI/2026
```

| Bagian | Arti |
|---------|---------|
| 001 | Nomor urut surat |
| MAGANG | Jenis surat |
| TK | Teknik Komputer |
| VI | Bulan Romawi |
| 2026 | Tahun penerbitan |

---

## 📥 Output

Contoh file yang dihasilkan:

```text
generated/
└── 001-MAGANG-TK-VI-2026.docx
```

---

## 👨‍💻 Author

Dibuat saat magang di BRIDA Pemkot Semarang, sebagai latihan implementasi PHP Native, MySQL, dan PHPWord untuk otomatisasi pembuatan dokumen surat.
