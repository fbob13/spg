create table mst_user (
    id_user int primary key AUTO_INCREMENT,
    username varchar(255) not null,
    nip varchar(255) null,
    nama varchar(255) not null,
    spc boolean default false,
    password varchar(255) not null,
    alamat varchar(255) null,
    jabatan varchar(255) null,
    j_kelamin varchar(255) null,
    telepon varchar(255) null,
    email varchar(255) null,
    foto varchar(255) null,
    created_at timestamp null,
    updated_at timestamp null
);
/* SPC : 99-IT 0-teksini 1-admin 2-user */
create table mst_role (
    kode_role varchar(255) primary key,
    nama_role varchar(255) not null
);
create table mst_user_role (
    id int AUTO_INCREMENT PRIMARY key,
    id_user int not null,
    kode_role varchar(255) not null,
    vw boolean default false,
    edt boolean default false,
    dlt boolean default false
);
create table notification (
    id bigint PRIMARY key AUTO_INCREMENT,
    id_user int not null,
    flag_icon tinyint not null,
    header varchar(255) not null,
    info varchar(255) not null,
    flag_buka tinyint not null default 0,
    flag_android tinyint not null default 0,
    created_at timestamp null
);
create table mst_item (
    id_item int primary key AUTO_INCREMENT,
    nama_item varchar(255) not null,
    merek_item varchar(255) not null,
    tipe_item varchar(255) not null,
    id_kategori int not null,
    status_item tinyint not null default 1,
    created_at timestamp null
);
/* status_item : 0-tidak-aktif 1-aktif */
create table mst_ruangan_item (
    id_ruangan_item int primary key AUTO_INCREMENT,
    id_item int,
    id_gedung int,
    id_ruangan int,
    tahun_pengadaan year null,
    created_at timestamp null
);

create table mst_gedung(
    id_gedung int PRIMARY KEY AUTO_INCREMENT,
    nama_gedung varchar(255) not null,
    keterangan varchar(255) null,
    created_at timestamp null
);

 create table mst_ruangan (
    id_ruangan int primary key AUTO_INCREMENT,
    id_gedung int,
    kode_ruangan varchar(255) null,
    uraian_ruangan varchar(255) null,
    keterangan varchar(255) null,
    status_ruangan tinyint not null default 1,
    created_at timestamp null
);
/* status_ruangan : 1-aktif 0-non-aktif */
create table mst_kategori (
    id_kategori int PRIMARY key AUTO_INCREMENT,
    kode_kategori varchar(255) not null,
    uraian_kategori varchar(255) not null
);
 create table mst_pkrutin (
    id_pkrutin int primary key AUTO_INCREMENT,
    jenis_pekerjaan varchar(255) not null,
    uraian_pekerjaan varchar(255) not null,
    id_kategori int not null,
    created_at timestamp null
);
create table as_rutin (
    id_rutin bigint primary key AUTO_INCREMENT,
    id_user int not null,
    id_pembuat int not null,
    id_gedung int not null,
    id_ruangan int not null,
    id_item int not null,
    id_pkrutin int not null,
    tanggal_jadwal date not null,
    tanggal_realisasi date null,
    status_pekerjaan tinyint default 0,
    keterangan text null,
    created_at timestamp null
);
/* status_kegiatan : 0-belum 1-progress 2-pending 3-selsai 4-tidak-dikerjakan*/

create table as_nonrutin (
    id bigint primary key AUTO_INCREMENT,
    id_pembuat int not null,
    id_pekerja int not null,
    tanggal_buat datetime not null,
    tanggal_kerja datetime not null,
    id_item int not null,
    keluhan text null,
    uraian_Perbaikan text null,
    status_nonrutin tinyint default 0
);
/* status_nonrutin : 0-open 1-progress 2-pending 3-selesai */
/*Insert user admin */


insert into mst_user (nip, username, nama, spc, password)
values (
        1,
        'superuser',
        'Super User',
        99,
        'e10adc3949ba59abbe56e057f20f883e'
    );


-------------------------------------------------
------------------UPD 1--------------------------
-------------------------------------------------

drop table as_nonrutin;

create table as_nonrutin (
    id_nonrutin bigint primary key AUTO_INCREMENT,
    id_teknisi int null,
    id_pembuat int not null,
    id_gedung int not null,
    id_ruangan int not null,
    id_item int not null,
    tanggal_laporan date not null,
    tanggal_perbaikan date null,
    status_pekerjaan tinyint default 0,
    keluhan text null,
    keterangan text null,
    created_at timestamp null
);

-------------------------------------------------
------------------UPD 2--------------------------
-------------------------------------------------

alter table as_nonrutin add prioritas tinyint default 1 after id_item;

alter table mst_pkrutin add interval_hari int default 0 after id_kategori;
alter table mst_pkrutin add pengali int default 1 after interval_hari;