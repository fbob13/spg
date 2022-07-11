
/*---------------------- update table --------------------- */
create table mst_subkategori (
    id_subkategori int PRIMARY key AUTO_INCREMENT,
    id_kategori int,
    kode_subkategori varchar(255) not null,
    uraian_subkategori varchar(255) not null
);
alter table mst_item
add id_subkategori int default 0
after id_kategori;

alter table mst_pkrutin
add id_subkategori int default 0
after id_kategori;

insert into mst_akses_halaman (kode_halaman,deskripsi_halaman) values ('MST_SUBKAT','Master Subkategori');
insert into mst_akses_detail (spc,kode_halaman,vw,edt,del) values (99,'MST_SUBKAT',1,1,1);
insert into mst_akses_detail (spc,kode_halaman,vw,edt,del) values (0,'MST_SUBKAT',0,0,0);
insert into mst_akses_detail (spc,kode_halaman,vw,edt,del) values (1,'MST_SUBKAT',1,1,1);
insert into mst_akses_detail (spc,kode_halaman,vw,edt,del) values (2,'MST_SUBKAT',0,0,0);


/*--------------------- VIEW ---------------------- */

drop view view_item;
CREATE view view_item AS (
    select id_item,
        nama_item,
        merek_item,
        tipe_item,
        a.id_kategori,
        b.kode_kategori,
        b.uraian_kategori,
        a.id_subkategori,
        c.kode_subkategori,
        c.uraian_subkategori,
        status_item,
        created_at
    from mst_item a
        left join mst_kategori b on a.id_kategori = b.id_kategori
        left join mst_subkategori c on a.id_subkategori = c.id_subkategori
);

drop view view_pkrutin;
CREATE VIEW view_pkrutin as
select a.id_pkrutin,
    a.jenis_pekerjaan,
    a.uraian_pekerjaan,
    a.id_kategori,
    kode_kategori,
    uraian_kategori,
    a.id_subkategori,
    c.kode_subkategori,
    c.uraian_subkategori,
    interval_hari,
    pengali
from mst_pkrutin a
    left join mst_kategori b on a.id_kategori = b.id_kategori
left join mst_subkategori c on a.id_subkategori = c.id_subkategori;


create view view_subkategori as
select a.id_subkategori,
        b.id_kategori,
        b.kode_kategori,
        b.uraian_kategori,
        a.kode_subkategori,
        a.uraian_subkategori
from mst_subkategori a
left join mst_kategori b on a.id_kategori = b.id_kategori






