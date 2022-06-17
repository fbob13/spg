CREATE view view_item AS (
    select id_item,
        nama_item,
        merek_item,
        tipe_item,
        a.id_kategori,
        b.kode_kategori,
        b.uraian_kategori,
        status_item,
        created_at
    from mst_item a
        left join mst_kategori b on a.id_kategori = b.id_kategori
);

CREATE VIEW view_ruangan_item AS (
select a.id_ruangan_item,a.id_item,b.nama_item, b.merek_item, b.tipe_item, 
b.id_kategori, d.kode_kategori,d.uraian_kategori,
a.id_gedung, e.nama_gedung,
a.id_ruangan, c.kode_ruangan, c.uraian_ruangan,
tahun_pengadaan
from mst_ruangan_item a
left join mst_item b on a.id_item = b.id_item
left join mst_ruangan c on a.id_ruangan = c.id_ruangan
LEFT JOIN mst_kategori d ON b.id_kategori = d.id_kategori
left join mst_gedung e on a.id_gedung = e.id_gedung
);

CREATE VIEW view_ruangan AS (
select id_ruangan, a.id_gedung, b.nama_gedung,
kode_ruangan, uraian_ruangan, a.keterangan, status_ruangan
from mst_ruangan a
left join mst_gedung b on a.id_gedung = b.id_gedung );


CREATE VIEW view_rutin AS 
select a.id_rutin,
a.id_user, d.nama nama_teknisi,
a.id_pembuat, c.nama nama_pembuat,
a.tanggal_jadwal,
a.id_gedung, e.nama_gedung,
a.id_ruangan,  CONCAT_WS(' - ',f.kode_ruangan, f.uraian_ruangan) as nama_ruangan,
a.id_item,CONCAT_WS(' - ', g.nama_item, g.merek_item, g.tipe_item) AS nama_item,
a.id_pkrutin, h.jenis_pekerjaan, h.uraian_pekerjaan,
a.status_pekerjaan,
case
when a.status_pekerjaan = 0 then 'Belum Dikerjakan'
when a.status_pekerjaan = 1 then 'Progres'
when a.status_pekerjaan = 2 then 'Pending'
when a.status_pekerjaan = 3 then 'Selesai'
when a.status_pekerjaan = 4 then 'Tidak Dikerjakan'
end status_pekerjaan_text,
a.keterangan,
a.tanggal_realisasi
from as_rutin a
left join mst_user c on a.id_pembuat = c.id_user
left join mst_user d on a.id_user = d.id_user
left join mst_gedung e on a.id_gedung = e.id_gedung
left join mst_ruangan f on a.id_ruangan = f.id_ruangan
left join mst_item g on a.id_item = g.id_item
left join mst_pkrutin h on a.id_pkrutin = h.id_pkrutin;



CREATE VIEW view_pkrutin as
select a.id_pkrutin, a.jenis_pekerjaan, a.uraian_pekerjaan,
a.id_kategori,kode_kategori,uraian_kategori
from mst_pkrutin a
left join mst_kategori b on a.id_kategori = b.id_kategori;




/*-------------------------------------------------
------------------UPD 1----------------------------
-------------------------------------------------*/


CREATE VIEW view_nonrutin AS 
select a.id_nonrutin,
a.id_teknisi, d.nama nama_teknisi,
a.id_pembuat, c.nama nama_pembuat,
a.tanggal_laporan,
a.tanggal_perbaikan,
a.id_gedung, e.nama_gedung,
a.id_ruangan,  CONCAT_WS(' - ',f.kode_ruangan, f.uraian_ruangan) as nama_ruangan,
a.id_item,CONCAT_WS(' - ', g.nama_item, g.merek_item, g.tipe_item) AS nama_item,
a.keluhan,
a.status_pekerjaan,
case
when a.status_pekerjaan = 0 then 'Belum Dikerjakan'
when a.status_pekerjaan = 1 then 'Progres'
when a.status_pekerjaan = 2 then 'Pending'
when a.status_pekerjaan = 3 then 'Selesai'
when a.status_pekerjaan = 4 then 'Tidak Dikerjakan'
end status_pekerjaan_text,
a.keterangan
from as_nonrutin a
left join mst_user c on a.id_pembuat = c.id_user
left join mst_user d on a.id_teknisi = d.id_user
left join mst_gedung e on a.id_gedung = e.id_gedung
left join mst_ruangan f on a.id_ruangan = f.id_ruangan
left join mst_item g on a.id_item = g.id_item;