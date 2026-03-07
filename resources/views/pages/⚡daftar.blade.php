<?php

use Livewire\Component;
use App\Models\Ref_wil_provinsi;
use App\Models\Ref_wil_kabupaten;
use App\Models\Ref_wil_kecamatan;
use App\Models\Ref_wil_desa;

new class extends Component {
    public $selectedProvinsi = null;
    public $selectedKabupaten = null;
    public $selectedKecamatan = null;
    public $selectedKelurahan = null;

    public int|null $provinsi = 0;
    public int|null $kabupaten = 0;
    public int|null $kecamatan = 0;
    public int|null $kelurahan = 0;

    public function rules(): array
    {
        $this->provinsi = Ref_wil_provinsi::where('code', $this->selectedProvinsi)->first()?->id;
        $this->kabupaten = Ref_wil_kabupaten::where('code', $this->selectedKabupaten)->first()?->id;
        $this->kecamatan = Ref_wil_kecamatan::where('code', $this->selectedKecamatan)->first()?->id;
        $this->kelurahan = Ref_wil_desa::where('code', $this->selectedKelurahan)->first()?->id;
        return [
            'provinsi' => 'required|exists:'.Ref_wil_provinsi::class.',id',
            'kabupaten' => 'required|exists:'.Ref_wil_kabupaten::class.',id',
            'kecamatan' => 'required|exists:'.Ref_wil_kecamatan::class.',id',
            'kelurahan' => 'required|exists:'.Ref_wil_desa::class.',id',
        ];
    }
};
?>

<div>
    <flux:select wire:model.live="selectedProvinsi"  id="provinsi" :value="__('PROVINSI')">
        <flux:select.option> Pilih Provinsi </flux:select.option>
        @foreach (Ref_wil_provinsi::get(['id_provinsi', 'nama_provinsi']) as $provinsi)
            <option value="{{ $provinsi->id_provinsi }}">{{ $provinsi->nama_provinsi }}</option>
        @endforeach
    </flux:select>
    <flux:select wire:model.live="selectedKabupaten" id="kabupaten" label="" size="sm" placeholder="Pilih Kabupaten...">
        <flux:select.option> </flux:select.option>
        @if ($selectedProvinsi)
            @foreach (Ref_wil_kabupaten::where('id_provinsi', $selectedProvinsi)->get() as $kabupaten)
                <option value="{{ $kabupaten->id_kabupaten }}">{{ $kabupaten->nama_kabupaten }}</option>
            @endforeach
        @endif
    </flux:select>
    <flux:select wire:model.live="selectedKecamatan" id="kecamatan" label="" size="sm" placeholder="Pilih Kecamatan...">
        <flux:select.option> </flux:select.option>
        @if ($selectedKabupaten)
            @foreach (Ref_wil_kecamatan::where('id_kabupaten', $selectedKabupaten)->get() as $kecamatan)
                <option value="{{ $kecamatan->id_kecamatan }}">{{ $kecamatan->nama_kecamatan }}</option>
            @endforeach
        @endif
    </flux:select>
    <flux:select wire:model.live="selectedKelurahan" id="kelurahan" label="" size="sm" placeholder="Pilih Kelurahan...">
        <flux:select.option> </flux:select.option>
        @if ($selectedKecamatan)
            @foreach (Ref_wil_desa::where('id_kecamatan', $selectedKecamatan)->get() as $kelurahan)
                <option value="{{ $kelurahan->id_desa }}">{{ $kelurahan->nama_desa }}</option>
            @endforeach
        @endif
    </flux:select>

    {{-- @dump($provinsi) --}}
</div>
