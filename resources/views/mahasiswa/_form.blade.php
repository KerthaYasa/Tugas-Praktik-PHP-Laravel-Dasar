<div class="mb-3">
  <label class="form-label">NIM <span class="text-danger">*</span></label>
  <input type="text" name="nim" class="form-control @error('nim') is-invalid @enderror"
         value="{{ old('nim', $mahasiswa->nim ?? '') }}">
  @error('nim') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
  <label class="form-label">Nama <span class="text-danger">*</span></label>
  <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
         value="{{ old('nama', $mahasiswa->nama ?? '') }}">
  @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
  <label class="form-label">Fakultas <span class="text-danger">*</span></label>
  <select id="fakultas-select" name="fakultas_id" class="form-select @error('fakultas_id') is-invalid @enderror">
    <option value="">-- Pilih Fakultas --</option>
    @foreach($fakultas as $f)
      @php
        $selF = old('fakultas_id', $mahasiswa->prodi->fakultas->id ?? '');
      @endphp
      <option value="{{ $f->id }}" {{ $selF == $f->id ? 'selected' : '' }}>
        {{ $f->nama_fakultas }}
      </option>
    @endforeach
  </select>
  @error('fakultas_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
  <label class="form-label">Program Studi <span class="text-danger">*</span></label>
  <select id="prodi-select" name="prodi_id" class="form-select @error('prodi_id') is-invalid @enderror" disabled>
    <option value="">-- Pilih Prodi --</option>
  </select>
  @error('prodi_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  const fakultasSelect = document.getElementById('fakultas-select');
  const prodiSelect = document.getElementById('prodi-select');

  async function loadProdi(fakultasId, selectedProdiId = null) {
    prodiSelect.innerHTML = '<option value="">-- Memuat Prodi... --</option>';
    prodiSelect.disabled = true;

    if (!fakultasId) {
      prodiSelect.innerHTML = '<option value="">-- Pilih Prodi --</option>';
      prodiSelect.disabled = true;
      return;
    }

    try {
      const res = await fetch(`/fakultas/${fakultasId}/prodi`);
      if (!res.ok) throw new Error('Gagal mengambil data Prodi');
      const data = await res.json();

      let html = '<option value="">-- Pilih Prodi --</option>';
      data.forEach(p => {
        html += `<option value="${p.id}" ${selectedProdiId == p.id ? 'selected' : ''}>${p.nama_prodi}</option>`;
      });
      prodiSelect.innerHTML = html;
      prodiSelect.disabled = false;
    } catch (err) {
      console.error(err);
      prodiSelect.innerHTML = '<option value="">-- Gagal memuat Prodi --</option>';
    }
  }

  fakultasSelect?.addEventListener('change', function() {
    loadProdi(this.value);
  });

  const selectedFak = '{{ old("fakultas_id", $mahasiswa->prodi->fakultas->id ?? "") }}';
  const selectedPro = '{{ old("prodi_id", $mahasiswa->prodi->id ?? "") }}';
  if (selectedFak) loadProdi(selectedFak, selectedPro);
});
</script>
@endpush