<div class="mb-3">
  <label class="form-label">Kode Fakultas <span class="text-danger">*</span></label>
  <input type="text" name="kode_fakultas" class="form-control @error('kode_fakultas') is-invalid @enderror"
         value="{{ old('kode_fakultas', $fakultas->kode_fakultas ?? '') }}">
  @error('kode_fakultas') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
  <label class="form-label">Nama Fakultas <span class="text-danger">*</span></label>
  <input type="text" name="nama_fakultas" class="form-control @error('nama_fakultas') is-invalid @enderror"
         value="{{ old('nama_fakultas', $fakultas->nama_fakultas ?? '') }}">
  @error('nama_fakultas') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
