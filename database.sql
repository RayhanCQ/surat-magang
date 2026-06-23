-- ==========================================
-- DATABASE SURAT MAGANG
-- ==========================================
CREATE DATABASE IF NOT EXISTS suratdb;
USE suratdb;
-- ==========================================
-- TABEL MAHASISWA
-- ==========================================
CREATE TABLE mahasiswa (
id INT AUTO_INCREMENT PRIMARY KEY,
nim VARCHAR(20),
nama VARCHAR(100),
prodi VARCHAR(100),
email VARCHAR(100),
semester INT NOT NULL
);
-- ==========================================
-- TABEL SURAT
-- ==========================================
CREATE TABLE surat (
id INT AUTO_INCREMENT PRIMARY KEY,
nomor_surat VARCHAR(100),
mahasiswa_id INT,
tanggal_terbit DATE,
file_path VARCHAR(255),
CONSTRAINT fk_mahasiswa
    FOREIGN KEY (mahasiswa_id)
    REFERENCES mahasiswa(id)
    ON DELETE CASCADE
);
-- ==========================================
-- DATA AWAL
-- ==========================================
INSERT INTO mahasiswa (nim, nama, prodi, email, semester) VALUES
('24060122130001', 'Rayhan Cahya Qurnia', 'Teknik Komputer', 'rcq352005@email.com', 4),
('24060122130002', 'Belinda Adara Putri', 'Teknik Komputer', 'belinda.adara@email.com', 4),
('24060122130003', 'Amogus Aonus Septimus', 'Teknik Elektro', 'amogus.septimus@email.com', 6),
('24060122130004', 'Bagus Satrio Utomo', 'Teknik Perkapalan', 'bagus.satrio@email.com', 6),
('24060122130005', 'Paut Muamalah', 'Ilmu Politik dan Pemerintahan', 'paut.muamalah@email.com', 4),
('24060122130006', 'Dimas Ghamar Pratama', 'Perencanaan Wilayah dan Kota', 'dimas.ghamar@email.com', 6);
