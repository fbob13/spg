INSERT INTO mst_akses_detail (spc,kode_halaman,vw,edt,del) 
SELECT 3 spc, kode_halaman, 0 vw, 0 edt, 0 del from mst_akses_halaman;


insert into mst_akses_halaman (kode_halaman,deskripsi_halaman) values ("REP_PKR","Laporan Pekerjaan Rutin");
insert into mst_akses_halaman (kode_halaman,deskripsi_halaman) values ("REP_KRS","Laporan Kerusakan");
insert into mst_akses_halaman (kode_halaman,deskripsi_halaman) values ("REP_PMR","Laporan Pemeliharaan Rutin");

INSERT INTO mst_akses_detail (spc,kode_halaman,vw,edt,del) values (99,"REP_PKR",0,0,0);
INSERT INTO mst_akses_detail (spc,kode_halaman,vw,edt,del) values (99,"REP_KRS",0,0,0);
INSERT INTO mst_akses_detail (spc,kode_halaman,vw,edt,del) values (99,"REP_PMR",0,0,0);

INSERT INTO mst_akses_detail (spc,kode_halaman,vw,edt,del) values (0,"REP_PKR",0,0,0);
INSERT INTO mst_akses_detail (spc,kode_halaman,vw,edt,del) values (0,"REP_KRS",0,0,0);
INSERT INTO mst_akses_detail (spc,kode_halaman,vw,edt,del) values (0,"REP_PMR",0,0,0);

INSERT INTO mst_akses_detail (spc,kode_halaman,vw,edt,del) values (1,"REP_PKR",0,0,0);
INSERT INTO mst_akses_detail (spc,kode_halaman,vw,edt,del) values (1,"REP_KRS",0,0,0);
INSERT INTO mst_akses_detail (spc,kode_halaman,vw,edt,del) values (1,"REP_PMR",0,0,0);

INSERT INTO mst_akses_detail (spc,kode_halaman,vw,edt,del) values (2,"REP_PKR",0,0,0);
INSERT INTO mst_akses_detail (spc,kode_halaman,vw,edt,del) values (2,"REP_KRS",0,0,0);
INSERT INTO mst_akses_detail (spc,kode_halaman,vw,edt,del) values (2,"REP_PMR",0,0,0);

INSERT INTO mst_akses_detail (spc,kode_halaman,vw,edt,del) values (3,"REP_PKR",0,0,0);
INSERT INTO mst_akses_detail (spc,kode_halaman,vw,edt,del) values (3,"REP_KRS",0,0,0);
INSERT INTO mst_akses_detail (spc,kode_halaman,vw,edt,del) values (3,"REP_PMR",0,0,0);

delete from mst_akses_detail where kode_halaman = 'REP';
delete from mst_akses_halaman where kode_halaman = 'REP';