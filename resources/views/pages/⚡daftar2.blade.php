<?php

use Livewire\Component;
use App\Models\Ref_wil_provinsi;
use App\Models\Ref_wil_kabupaten;
use App\Models\Ref_wil_kecamatan;
use App\Models\Ref_wil_desa;
use Livewire\Attributes\Validate;

new class extends Component {

    #[Validate('required')]
    public $name = '';

    #[Validate('required|exists:'.Ref_wil_provinsi::class.',id_provinsi')]
    public $selectedProvinsi = null;

    #[Validate('required|exists:'.Ref_wil_kabupaten::class.',id_kabupaten')]
    public $selectedKabupaten = null;

    #[Validate('required|exists:'.Ref_wil_kecamatan::class.',id_kecamatan')]
    public $selectedKecamatan = null;

    #[Validate('required|exists:'.Ref_wil_desa::class.',id_desa')]
    public $selectedDesa = null;

    public function save()
    {
        // $this->validate([
        //     'selectedProvinsi' => 'required|exists:'.Ref_wil_provinsi::class.',id_provinsi',
        //     'selectedKabupaten' => 'required|exists:'.Ref_wil_kabupaten::class.',id_kabupaten',
        //     'selectedKecamatan' => 'required|exists:'.Ref_wil_kecamatan::class.',id_kecamatan',
        //     'selectedDesa' => 'required|exists:'.Ref_wil_desa::class.',id_desa',
        // ]);

        $this->validate();

        dd($this->all());


        // Simpan data atau lakukan tindakan lainnya
    }
};
?>

<div>

    <div class="flex flex-wrap">
        <div class="w-full md:w-1/3 p-2">
            <flux:card class="space-y-6">
                <form action="" wire:submit.prevent="save" class="space-y-6">
                    <div>
                        <flux:heading size="lg">Log in to your account</flux:heading>
                    </div>

                    <div class="my-4 space-y-4">
                        <flux:input label="Nama Lengkap" wire:model="name" type="text" placeholder="Admin" />


                    </div>

                    {{-- Provinsi --}}
                    <div class="my-4 space-y-4">
                        <flux:select label="Provinsi" wire:model.live="selectedProvinsi" id="provinsi" >
                            <option value="">Pilih Provinsi</option>
                            @foreach (Ref_wil_provinsi::all() as $provinsi)
                                <flux:select.option value="{{ $provinsi->id_provinsi }}">{{ $provinsi->nama_provinsi }}</flux:select.option>
                            @endforeach
                        </flux:select>
                    </div>

                    {{-- Kabupaten --}}
                    <div class="my-4 space-y-4">
                        <flux:select label="Kabupaten" wire:model.live="selectedKabupaten" id="kabupaten" wire:key="{{ $selectedProvinsi }}" placeholder="Pilih Kabupaten">
                            @foreach (Ref_wil_kabupaten::where('id_provinsi', $selectedProvinsi)->get() as $kabupaten)
                                <flux:select.option value="{{ $kabupaten->id_kabupaten }}">{{ $kabupaten->nama_kabupaten }}</flux:select.option>
                            @endforeach
                        </flux:select>
                    </div>
                    {{-- Kecamatan --}}
                    <div class="my-4 space-y-4">
                        <flux:select label="Kecamatan" wire:model.live="selectedKecamatan" id="kecamatan" wire:key="{{ $selectedKabupaten }}" placeholder="Pilih Kecamatan">
                            @foreach (Ref_wil_kecamatan::where('id_kabupaten', $selectedKabupaten)->get() as $kecamatan)
                                <flux:select.option value="{{ $kecamatan->id_kecamatan }}">{{ $kecamatan->nama_kecamatan }}</flux:select.option>
                            @endforeach
                        </flux:select>
                    </div>
                    {{-- Desa --}}
                    <div class="my-4 space-y-4">
                        <flux:select label="Desa" wire:model.live="selectedDesa" id="desa" wire:key="{{ $selectedKecamatan }}" placeholder="Pilih Desa">
                            @foreach (Ref_wil_desa::where('id_kecamatan', $selectedKecamatan)->get() as $desa)
                                <flux:select.option value="{{ $desa->id_desa }}">{{ $desa->nama_desa }}</flux:select.option>
                            @endforeach
                        </flux:select>
                    </div>

                    <div class="space-y-6 mt-12">
                        <flux:button type="submit" variant="primary" class="w-full">save</flux:button>

                    </div>

                </form>
            </flux:card>

        </div>
    </div>

</div>
