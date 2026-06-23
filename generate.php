<?php
require 'vendor/autoload.php';
use PhpOffice\PhpWord\TemplateProcessor;

//db
$conn = new mysqli("localhost", "root", "", "suratdb");
if ($conn->connect_error) {
    die("koneksi gagal: " . $conn->connect_error);
}

//if param valid
if (!isset($_GET['id'])) {
    die("ID mahasiswa tidak ditemukan");
}
$id = (int)$_GET['id'];

//data mhs
$stmt = $conn->prepare("SELECT * FROM mahasiswa WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    die("Mahasiswa tidak ditemukan");
}
$mhs=$result->fetch_assoc();

//generate surat
$queryNomor=$conn->query("SELECT COUNT(*) AS total FROM surat WHERE YEAR(tanggal_terbit) = YEAR(CURDATE())");
$dataNomor=$queryNomor->fetch_assoc();
$urutan=$dataNomor['total']+1;
$urutan = str_pad($urutan, 3, '0', STR_PAD_LEFT);

//nomor romawi
$romawi=[1=>"I", 2=>"II", 3=>"III", 4=>"IV", 5=>"V", 6=>"VI", 7=>"VII", 8=>"VIII", 9=>"IX", 10=>"X", 11=>"XI", 12=>"XII"];
$bulanRomawi=$romawi[date('n')];
$nomorSurat =
    $urutan .
    '/MAGANG/TK/' . $bulanRomawi . '/' . date('Y');

//format semester
function semesterTerbilang(int $semester): string{
    $words = [
        'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan'
    ];
    return $words[$semester-1];
}

//template docx
$template = new TemplateProcessor('templates/surat_magang.docx');

//fill placeholder
$template->setValue('nomor_surat', $nomorSurat);
$template->setValue('nama', $mhs['nama']);
$template->setValue('nim', $mhs['nim']);
$template->setValue('prodi', $mhs['prodi']);
$template->setValue('semester', $mhs['semester'] . '(' . semesterTerbilang($mhs['semester']) . ')' );
$template->setValue('tanggal', date('d F Y'));

//folder check
if (!is_dir('generated')) {
    mkdir('generated', 0777, true);
}

//save file
$namafile=str_replace('/', '-', $nomorSurat) . '.docx';
$filePath = 'generated/' . $namafile;
$template->saveAs($filePath);

//insert into db
$stmtInsert = $conn->prepare("INSERT INTO surat (nomor_surat, mahasiswa_id, tanggal_terbit, file_path) VALUES (?, ?, CURDATE(), ?)");
$stmtInsert->bind_param("sis", $nomorSurat, $id, $filePath);
$stmtInsert->execute();

//download file
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
header('Content-Length: ' . filesize($filePath));
readfile($filePath);
exit;
