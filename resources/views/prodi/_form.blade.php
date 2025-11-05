<div class="mb-3">
  <label class="form-label">Kode Prodi <span class="text-danger">*</span></label>
  <input type="text" name="kode_prodi" class="form-control @error('kode_prodi') is-invalid @enderror"
         value="{{ old('kode_prodi', $p->kode_prodi ?? '') }}" maxlength="20">
  @error('kode_prodi') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
  <label class="form-label">Nama Prodi <span class="text-danger">*</span></label>
  <input type="text" name="nama_prodi" class="form-control @error('nama_prodi') is-invalid @enderror"
         value="{{ old('nama_prodi', $p->nama_prodi ?? '') }}" maxlength="100">
  @error('nama_prodi') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
  <label class="form-label">Fakultas <span class="text-danger">*</span></label>
  <select name="fakultas_id" class="form-select @error('fakultas_id') is-invalid @enderror">
    <option value="">-- Pilih Fakultas --</option>
    @foreach($fakultas as $f)
      <option value="{{ $f->id }}" {{ old('fakultas_id', $p->fakultas_id ?? '') == $f->id ? 'selected' : '' }}>
        {{ $f->nama_fakultas }}
      </option>
    @endforeach
  </select>
  @error('fakultas_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
