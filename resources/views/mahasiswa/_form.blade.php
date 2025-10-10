@php($isEdit = isset($m))
<div class="card p-3">
  <div class="mb-3">
    <label class="form-label">NIM <span class="text-danger">*</span></label>
    <input autofocus
           type="text"
           name="nim"
           class="form-control @error('nim') is-invalid @enderror"
           value="{{ old('nim', $isEdit ? $m->nim : '') }}"
           placeholder="contoh: 2305505001"
           required minlength="4">
    @error('nim') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div class="mb-3">
    <label class="form-label">Nama <span class="text-danger">*</span></label>
    <input type="text"
           name="nama"
           class="form-control @error('nama') is-invalid @enderror"
           value="{{ old('nama', $isEdit ? $m->nama : '') }}"
           placeholder="Nama lengkap"
           required>
    @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div class="mb-3">
    <label class="form-label">Prodi <span class="text-danger">*</span></label>
    <input type="text"
           name="prodi"
           class="form-control @error('prodi') is-invalid @enderror"
           value="{{ old('prodi', $isEdit ? $m->prodi : '') }}"
           placeholder="Contoh: Teknologi Informasi"
           required>
    @error('prodi') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>
</div>
