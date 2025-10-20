{{-- Nama Fakultas --}}
<div class="mb-3">
  <label class="form-label">Nama Fakultas <span class="text-danger">*</span></label>
  <input type="text" name="nama_fakultas" class="form-control @error('nama_fakultas') is-invalid @enderror"
         value="{{ old('nama_fakultas', $fakultas->nama_fakultas ?? '') }}">
  @error('nama_fakultas') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

{{-- Dekan (opsional) --}}
<div class="mb-3">
  <label class="form-label">Nama Dekan</label>
  <input type="text" name="dekan" class="form-control @error('dekan') is-invalid @enderror"
         value="{{ old('dekan', $fakultas->dekan ?? '') }}">
  @error('dekan') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>