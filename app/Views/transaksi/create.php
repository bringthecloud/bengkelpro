<?= $this->extend('layout/header') ?>
<?= $this->section('content') ?>

<div class="form-container" style="max-width:900px;">
    <h3 class="section-title" style="margin-bottom:24px;">
        <i class='bx bx-plus-circle'></i> Buat Transaksi Baru
    </h3>

    <form action="/transaksi" method="post" id="formTransaksi">

        <!-- KENDARAAN & PELANGGAN -->
        <div class="form-grid">
            <div class="form-group">
                <label>Pilih Kendaraan</label>
                <div class="input-icon-group">
                    <i class='bx bx-car'></i>
                    <select name="ID_Kendaraan" id="selKendaraan" required>
                        <option value="">-- Pilih Kendaraan --</option>
                        <?php foreach($kendaraan as $k): ?>
                            <option value="<?= $k['ID_Kendaraan'] ?>" 
                                data-pelanggan="<?= $k['ID_Pelanggan'] ?>">
                                <?= $k['No_Polisi'] ?> — <?= $k['Merk'] ?> <?= $k['Tipe'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label>Pelanggan</label>
                <div class="input-icon-group">
                    <i class='bx bx-user'></i>
                    <input type="text" id="pelangganInfo" readonly placeholder="Otomatis tampil setelah pilih kendaraan" style="background:rgba(255,255,255,0.03);">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Keluhan</label>
            <textarea name="Keluhan" rows="3" placeholder="Jelaskan masalah kendaraan..." required></textarea>
        </div>

        <!-- DAFTAR SERVIS -->
        <div class="section-block" style="margin-top:24px;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
                <h4 style="color:var(--text-main);"><i class='bx bx-wrench' style="color:var(--primary-red);"></i> Daftar Servis</h4>
                <button type="button" class="btn btn-secondary btn-sm" onclick="addServis()"><i class='bx bx-plus'></i> Tambah Servis</button>
            </div>
            <div id="servisContainer">
                <p class="empty-hint" id="servisEmpty" style="color:var(--text-muted); font-size:13px; padding:12px; text-align:center;">Belum ada servis ditambahkan (opsional)</p>
            </div>
        </div>

        <!-- DAFTAR SPAREPART -->
        <div class="section-block" style="margin-top:24px;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
                <h4 style="color:var(--text-main);"><i class='bx bxs-box' style="color:var(--primary-red);"></i> Daftar Sparepart</h4>
                <button type="button" class="btn btn-secondary btn-sm" onclick="addSparepart()"><i class='bx bx-plus'></i> Tambah Sparepart</button>
            </div>
            <div id="sparepartContainer">
                <p class="empty-hint" id="sparepartEmpty" style="color:var(--text-muted); font-size:13px; padding:12px; text-align:center;">Belum ada sparepart ditambahkan (opsional)</p>
            </div>
        </div>

        <!-- TOTAL -->
        <div class="card-panel" style="margin-top:24px; display:flex; justify-content:space-between; align-items:center; padding:20px 24px;">
            <span style="font-size:16px; font-weight:600; color:var(--text-main);">Total Biaya</span>
            <span id="totalDisplay" style="font-size:24px; font-weight:800; color:var(--primary-red);">Rp 0</span>
        </div>

        <div style="display:flex; gap:12px; margin-top:20px;">
            <button type="submit" class="btn btn-primary"><i class='bx bx-check'></i> Simpan Transaksi</button>
            <a href="/transaksi" class="btn btn-secondary"><i class='bx bx-x'></i> Batal</a>
        </div>
    </form>
</div>

<script>
// Data dari server
const jasaList = <?= json_encode($jasaList) ?>;
const sparepartList = <?= json_encode($sparepartList) ?>;

// Pilih kendaraan → tampilkan pelanggan
document.getElementById('selKendaraan').addEventListener('change', function() {
    const id = this.value;
    if (!id) { document.getElementById('pelangganInfo').value = ''; return; }
    fetch('/transaksi/getpelanggan/' + id)
        .then(r => r.json())
        .then(d => {
            document.getElementById('pelangganInfo').value = d.Nama_Lengkap ? d.Nama_Lengkap + ' — ' + (d.No_Telepon || '-') : 'Pelanggan tidak ditemukan';
        });
});

let servisCount = 0;
function addServis() {
    document.getElementById('servisEmpty').style.display = 'none';
    const idx = servisCount++;
    let opts = '<option value="">-- Pilih Jasa --</option>';
    jasaList.forEach(j => {
        opts += `<option value="${j.ID_Jasa}" data-harga="${j.Harga_Satuan}">${j.Nama_Jasa} — Rp ${Number(j.Harga_Satuan).toLocaleString('id')}</option>`;
    });
    const row = document.createElement('div');
    row.className = 'dynamic-row';
    row.innerHTML = `
        <div class="input-icon-group" style="flex:1;">
            <i class='bx bx-wrench'></i>
            <select name="servis_id[]" onchange="servisChanged(this, ${idx})" required>
                ${opts}
            </select>
        </div>
        <input type="hidden" name="servis_harga[]" id="servisHarga${idx}" value="0">
        <span class="row-price" id="servisPrice${idx}">Rp 0</span>
        <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this, 'servis')"><i class='bx bx-trash'></i></button>
    `;
    document.getElementById('servisContainer').appendChild(row);
}

function servisChanged(sel, idx) {
    const opt = sel.selectedOptions[0];
    const harga = opt.dataset.harga || 0;
    document.getElementById('servisHarga' + idx).value = harga;
    document.getElementById('servisPrice' + idx).textContent = 'Rp ' + Number(harga).toLocaleString('id');
    calcTotal();
}

let sparepartCount = 0;
function addSparepart() {
    document.getElementById('sparepartEmpty').style.display = 'none';
    const idx = sparepartCount++;
    let opts = '<option value="">-- Pilih Sparepart --</option>';
    sparepartList.forEach(s => {
        opts += `<option value="${s.ID_Sparepart}" data-harga="${s.Harga_Jual}" data-stok="${s.Stok_Barang}">${s.Nama_Barang} — Rp ${Number(s.Harga_Jual).toLocaleString('id')} (Stok: ${s.Stok_Barang})</option>`;
    });
    const row = document.createElement('div');
    row.className = 'dynamic-row';
    row.innerHTML = `
        <div class="input-icon-group" style="flex:1;">
            <i class='bx bxs-box'></i>
            <select name="sparepart_id[]" onchange="sparepartChanged(this, ${idx})" required>
                ${opts}
            </select>
        </div>
        <div class="input-icon-group" style="width:100px;">
            <i class='bx bx-hash'></i>
            <input type="number" name="sparepart_jumlah[]" id="sparepartJml${idx}" value="1" min="1" onchange="sparepartCalc(${idx})" style="width:100%;">
        </div>
        <input type="hidden" name="sparepart_harga[]" id="sparepartHarga${idx}" value="0">
        <span class="row-price" id="sparepartPrice${idx}">Rp 0</span>
        <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this, 'sparepart')"><i class='bx bx-trash'></i></button>
    `;
    document.getElementById('sparepartContainer').appendChild(row);
}

function sparepartChanged(sel, idx) {
    const opt = sel.selectedOptions[0];
    const harga = opt.dataset.harga || 0;
    document.getElementById('sparepartHarga' + idx).value = harga;
    sparepartCalc(idx);
}

function sparepartCalc(idx) {
    const harga = parseFloat(document.getElementById('sparepartHarga' + idx).value) || 0;
    const jml = parseInt(document.getElementById('sparepartJml' + idx).value) || 1;
    document.getElementById('sparepartPrice' + idx).textContent = 'Rp ' + (harga * jml).toLocaleString('id');
    calcTotal();
}

function removeRow(btn, type) {
    btn.closest('.dynamic-row').remove();
    calcTotal();
    // Show empty hint if no rows left
    const container = document.getElementById(type + 'Container');
    if (!container.querySelector('.dynamic-row')) {
        document.getElementById(type + 'Empty').style.display = '';
    }
}

function calcTotal() {
    let total = 0;
    document.querySelectorAll('[name="servis_harga[]"]').forEach(el => total += parseFloat(el.value) || 0);
    document.querySelectorAll('[name="sparepart_harga[]"]').forEach((el, i) => {
        const jml = parseInt(document.querySelectorAll('[name="sparepart_jumlah[]"]')[i]?.value) || 1;
        total += (parseFloat(el.value) || 0) * jml;
    });
    document.getElementById('totalDisplay').textContent = 'Rp ' + total.toLocaleString('id');
}
</script>

<?= $this->endSection() ?>