

alter table as_rutin add pk varchar(255) null;
alter table as_rutin add arus_r varchar(255) null;
alter table as_rutin add arus_s varchar(255) null;
alter table as_rutin add arus_t varchar(255) null;
alter table as_rutin add teg_r varchar(255) null;
alter table as_rutin add teg_s varchar(255) null;
alter table as_rutin add teg_t varchar(255) null;
alter table as_rutin add teg_v varchar(255) null;
alter table as_rutin add psi varchar(255) null;
alter table as_rutin add oli varchar(255) null;
alter table as_rutin add solar varchar(255) null;
alter table as_rutin add radiator varchar(255) null;
alter table as_rutin add eng_hours varchar(255) null;
alter table as_rutin add accu varchar(255) null;
alter table as_rutin add temp varchar(255) null;
alter table as_rutin add kap varchar(255) null;
alter table as_rutin add noice varchar(255) null;
alter table as_rutin add qty varchar(255) null;
alter table as_rutin add vol varchar(255) null;
alter table as_rutin add tgl_kadaluarsa varchar(255) null;
alter table as_rutin add kondisi varchar(255) null;
alter table as_rutin add tindakan varchar(255) null;




alter table mst_subkategori add pk varchar(255) null;
alter table mst_subkategori add arus_r varchar(255) null;
alter table mst_subkategori add arus_s varchar(255) null;
alter table mst_subkategori add arus_t varchar(255) null;
alter table mst_subkategori add teg_r varchar(255) null;
alter table mst_subkategori add teg_s varchar(255) null;
alter table mst_subkategori add teg_t varchar(255) null;
alter table mst_subkategori add teg_v varchar(255) null;
alter table mst_subkategori add psi varchar(255) null;
alter table mst_subkategori add oli varchar(255) null;
alter table mst_subkategori add solar varchar(255) null;
alter table mst_subkategori add radiator varchar(255) null;
alter table mst_subkategori add eng_hours varchar(255) null;
alter table mst_subkategori add accu varchar(255) null;
alter table mst_subkategori add temp varchar(255) null;
alter table mst_subkategori add kap varchar(255) null;
alter table mst_subkategori add noice varchar(255) null;
alter table mst_subkategori add qty varchar(255) null;
alter table mst_subkategori add vol varchar(255) null;
alter table mst_subkategori add tgl_kadaluarsa varchar(255) null;
alter table mst_subkategori add kondisi varchar(255) null;
alter table mst_subkategori add tindakan varchar(255) null;


drop view view_subkategori;
create view view_subkategori as
select a.id_subkategori,
        b.id_kategori,
        b.kode_kategori,
        b.uraian_kategori,
        a.kode_subkategori,
        a.uraian_subkategori,
        pk,
        arus_r,
        arus_s,
        arus_t,
        teg_r,
        teg_s,
        teg_t,
        teg_v,
        psi,
        oli,
        solar,
        radiator,
        eng_hours,
        accu,
        temp,
        kap,
        noice,
        qty,
        vol,
        tgl_kadaluarsa,
        kondisi,
        tindakan
from mst_subkategori a
left join mst_kategori b on a.id_kategori = b.id_kategori;







Drop view view_rutin;
CREATE VIEW view_rutin AS 
select a.id_rutin,
a.id_user, d.nama nama_teknisi,
a.id_pembuat, c.nama nama_pembuat,
a.tanggal_jadwal,
a.id_gedung, e.nama_gedung,
a.id_ruangan,  CONCAT_WS(' / ',f.kode_ruangan, f.uraian_ruangan) as nama_ruangan,
a.id_item,CONCAT_WS(' / ', g.nama_item, g.merek_item, g.tipe_item) AS nama_item,
a.id_pkrutin, h.jenis_pekerjaan, h.uraian_pekerjaan,
a.status_pekerjaan,
case
when a.status_pekerjaan = 0 then 'Belum Dikerjakan'
when a.status_pekerjaan = 1 then 'Progres'
when a.status_pekerjaan = 2 then 'Pending'
when a.status_pekerjaan = 3 then 'Selesai'
when a.status_pekerjaan = 4 then 'Tidak Dikerjakan'
when a.status_pekerjaan = 5 then 'Approved'
end status_pekerjaan_text,
a.keterangan,
a.tanggal_realisasi,
g.id_kategori,g.id_subkategori,
a.pk,
a.arus_r,
a.arus_s,
a.arus_t,
a.teg_r,
a.teg_s,
a.teg_t,
a.teg_v,
a.psi,
a.oli,
a.solar,
a.radiator,
a.eng_hours,
a.accu,
a.temp,
a.kap,
a.noice,
a.qty,
a.vol,
a.tgl_kadaluarsa,
a.kondisi,
a.tindakan
from as_rutin a
left join mst_user c on a.id_pembuat = c.id_user
left join mst_user d on a.id_user = d.id_user
left join mst_gedung e on a.id_gedung = e.id_gedung
left join mst_ruangan f on a.id_ruangan = f.id_ruangan
left join mst_item g on a.id_item = g.id_item
left join mst_pkrutin h on a.id_pkrutin = h.id_pkrutin;