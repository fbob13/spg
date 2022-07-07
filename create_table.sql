create table as_rutin_draft (
    id_rutin_draft bigint primary key AUTO_INCREMENT,
    id_user int not null,
    id_pembuat int not null,
    id_gedung int not null,
    id_ruangan int not null,
    id_item int not null,
    id_pkrutin int not null,
    tanggal_jadwal date not null
);

CREATE VIEW view_rutin_draft AS 
select a.id_rutin_draft,
a.id_user, d.nama nama_teknisi,
a.id_pembuat, c.nama nama_pembuat,
a.tanggal_jadwal,
a.id_gedung, e.nama_gedung,
a.id_ruangan,  CONCAT_WS(' / ',f.kode_ruangan, f.uraian_ruangan) as nama_ruangan,
a.id_item,CONCAT_WS(' / ', g.nama_item, g.merek_item, g.tipe_item) AS nama_item,
a.id_pkrutin, h.jenis_pekerjaan, h.uraian_pekerjaan
from as_rutin_draft a
left join mst_user c on a.id_pembuat = c.id_user
left join mst_user d on a.id_user = d.id_user
left join mst_gedung e on a.id_gedung = e.id_gedung
left join mst_ruangan f on a.id_ruangan = f.id_ruangan
left join mst_item g on a.id_item = g.id_item
left join mst_pkrutin h on a.id_pkrutin = h.id_pkrutin;