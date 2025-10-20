{{-- partial: resources/views/prodi/_form.blade.php --}}
<div class="mb-3">
  <label class="form-label">Nama Prodi <span class="text-danger">*</span></label>
  <input type="text" name="nama_prodi" class="form-control @error('nama_prodi') is-invalid @enderror"
         value="{{ old('nama_prodi', $p->nama_prodi ?? '') }}" maxlength="100">
  @error('nama_prodi') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
  <label class="form-label">Kaprodi <span class="text-danger">*</span></label>
  <input type="text" name="kaprodi" class="form-control @error('kaprodi') is-invalid @enderror"
         value="{{ old('kaprodi', $p->kaprodi ?? '') }}" maxlength="100">
  @error('kaprodi') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
