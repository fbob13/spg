drop table mst_user_role;
drop table mst_role;


create table mst_akses_halaman(
    id_mahalaman int PRIMARY KEY AUTO_INCREMENT,
    kode_halaman varchar(255) not null,
    deskripsi_halaman varchar(255) not null
);

create table mst_akses_spc(
    id_maspc int PRIMARY KEY AUTO_INCREMENT,
    spc int not null,
    deskripsi_spc varchar(255) not null
);


create table mst_akses_detail(
    id_majabatan int PRIMARY KEY AUTO_INCREMENT,
    spc int not null,
    kode_halaman varchar(255) not null,
    vw tinyint default 0,
    edt tinyint default 0,
    del tinyint default 0
);


insert into mst_akses_spc (spc,deskripsi_spc) values 
(0,'Teknisi'),
(1,'Admin'),
(2,'User'),
(99,'Super User');

insert into mst_akses_halaman (kode_halaman,deskripsi_halaman) values
('MST_KAT','Master Kategori'),
('MST_GED','Master Gedung'),
('MST_RUA','Master Ruangan'),
('MST_ITE','Master Item'),
('MST_PEK','Master Pekerjaan'),
('RUTIN_INPUT','Input Jadwal Perawatan Rutin'),
('RUTIN_DATA','Lihat / Edit Jadwal Perawatan Rutin'),
('NRUTIN_INPUT','Input Kerusakan'),
('NRUTIN_DATA','Lihat / Edit Data Kerusakan'),
('ADM_USER','Buat User Aplikasi'),
('ADM_AKSES','Rubah Hak Akses'),
('REP','Laporan');


INSERT INTO mst_akses_detail (spc,kode_halaman,vw,edt,del) 
SELECT 99 spc, kode_halaman, 1 vw, 1 edt, 1 del from mst_akses_halaman;

INSERT INTO mst_akses_detail (spc,kode_halaman,vw,edt,del) 
SELECT 0 spc, kode_halaman, 0 vw, 0 edt, 0 del from mst_akses_halaman;

INSERT INTO mst_akses_detail (spc,kode_halaman,vw,edt,del) 
SELECT 1 spc, kode_halaman, 0 vw, 0 edt, 0 del from mst_akses_halaman;

INSERT INTO mst_akses_detail (spc,kode_halaman,vw,edt,del) 
SELECT 2 spc, kode_halaman, 0 vw, 0 edt, 0 del from mst_akses_halaman;



CREATE VIEW view_akses as
SELECT id_user,username,nama, a.spc,
d.kode_halaman,deskripsi_halaman,vw,edt,del
FROM mst_user a
LEFT JOIN mst_akses_spc b ON a.spc = b.spc
LEFT JOIN mst_akses_detail c ON a.spc = c.spc
left JOIN mst_akses_halaman d ON c.kode_halaman = d.kode_halaman;


CREATE VIEW view_user as
SELECT id_user,username,nip,nama,
a.spc,deskripsi_spc,
alamat,jabatan,
j_kelamin,
case
when j_kelamin = 'l' then 'Laki-laki'
when j_kelamin = 'p' then 'Perempuan'
END j_kelamin_text,
telepon,email,foto,created_at,updated_at FROM mst_user a, mst_akses_spc b
WHERE a.spc = b.spc;





/* SETELAH UPDATE BUAT USER */
/* COMMIT UPDATE HAK AKSES*/
/* jalankan query di bawah*/

CREATE VIEW view_akses_spc as
SELECT a.spc,
d.kode_halaman,deskripsi_halaman,vw,edt,del
FROM mst_akses_detail a
left JOIN mst_akses_halaman d ON a.kode_halaman = d.kode_halaman;



INSERT INTO mst_akses_detail (spc,kode_halaman,vw,edt,del) values 
(0,'MST_RUA_ITE',0,0,0),
(1,'MST_RUA_ITE',0,0,0),
(2,'MST_RUA_ITE',0,0,0),
(99,'MST_RUA_ITE',1,1,1);

insert into mst_akses_halaman (kode_halaman,deskripsi_halaman) values ('MST_RUA_ITE','Master Ruangan Item');