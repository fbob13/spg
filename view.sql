Drop view view_nonrutin;
CREATE VIEW view_nonrutin AS 
select a.id_nonrutin,
a.id_teknisi, d.nama nama_teknisi,
a.id_pembuat, c.nama nama_pembuat,
a.tanggal_laporan,
a.tanggal_perbaikan,
a.id_gedung, e.nama_gedung,
a.id_ruangan,  CONCAT_WS(' / ',f.kode_ruangan, f.uraian_ruangan) as nama_ruangan,
a.id_item,CONCAT_WS(' / ', g.nama_item, g.merek_item, g.tipe_item) AS nama_item,
a.prioritas,
case
when a.prioritas = 0 then 'Rendah'
when a.prioritas = 1 then 'Rendah'
when a.prioritas = 2 then 'Menengah'
when a.prioritas = 3 then 'Tinggi'
when a.prioritas = 4 then 'Urgent'
end prioritas_text,
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