<x-layout.default>
    <div x-data="SimtanFormAdd" x-init="init" class="p-4">
        @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('simtanform.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex xl:flex-row flex-col gap-2.5">
                <div class="panel px-0 flex-1 py-6 ltr:xl:mr-6 rtl:xl:ml-6">
                    <div class="flex justify-between flex-wrap px-4">
                        <!-- Bagian Kiri -->
                        <div class="mb-6 lg:w-1/2 w-full">
                            <div class="flex items-center text-black dark:text-white shrink-0">
                                <img src="/assets/images/Logo_Perkebunan_Nusantara_IV.png" alt="image"
                                    class="w-14" />
                            </div>
                            <div class="space-y-1 mt-6 text-gray-500 dark:text-gray-400">
                                <div>Jl. Sei Batang Hari No.2, Simpang Tj., Medan Sunggal, Kota Medan</div>
                                <div>simtan@gmail.com</div>
                                <div>+1 (070) 123-4567</div>
                            </div>
                        </div>

                        <!-- Bagian Tengah -->
                        <div class="lg:w-1/2 w-full lg:max-w-fit">
                            <div class="flex items-center">
                                <label for="kodeUpload" class="flex-1 ltr:mr-2 mb-0">Kode Upload</label>
                                <input id="kodeUpload" type="text" name="kode_upload"
                                    class="form-input lg:w-[250px] w-2/3 bg-gray-100" x-model="params.kodeUpload"
                                    readonly />
                            </div>
                            <div class="flex items-center mt-4">
                                <label for="diuploadOleh" class="flex-1 ltr:mr-2 mb-0">Diupload Oleh</label>
                                <input id="diuploadOleh" type="text" name="diupload_oleh"
                                    class="form-input lg:w-[250px] w-2/3" placeholder="Masukkan Nama"
                                    x-model="params.diuploadOleh" />
                            </div>
                            <div class="flex items-center mt-4">
                                <label for="judulFile" class="flex-1 ltr:mr-2 mb-0">Judul File</label>
                                <input id="judulFile" type="text" name="judul_file"
                                    class="form-input lg:w-[250px] w-2/3" placeholder="Masukkan Judul File"
                                    x-model="params.judulFile" />
                            </div>
                            <div class="flex items-center mt-4">
                                <label for="tanggalUpload" class="flex-1 ltr:mr-2 mb-0">Tanggal Upload</label>
                                <input id="tanggalUpload" type="date" name="tanggal_upload"
                                    class="form-input lg:w-[250px] w-2/3" x-model="params.tanggalUpload" />
                            </div>
                        </div>

                        <!-- Bagian Kanan -->
                        <div class="xl:w-96 w-full xl:mt-0 mt-6">
                            <div class="panel mb-5">
                                <div>
                                    <label for="kategori-file">Kategori File </label>
                                    <select id="kategori-file" name="kategori_file" class="form-select"
                                        x-model="selectedKategoriFileRekap" @change="updateKodeUpload">
                                        <option value="">-- Pilih Kategori --</option>
                                        <template x-for="(kategori, i) in KategoriFileRekapList" :key="i">
                                            <option :value="kategori" x-text="kategori"></option>
                                        </template>
                                    </select>
                                </div>
                                <div class="mt-4">
                                    <label for="periode-data">Periode Data</label>
                                    <input id="periode-data" type="text" name="periode_data" class="form-input"
                                        placeholder="Masukkan Periode Data" x-model="periodeData" />
                                </div>
                                <div class="mt-4">
                                    <label for="file-upload">Upload File Excel</label>
                                    <input id="file-upload" type="file" name="file_upload" class="form-input"
                                        accept=".xlsx, .xls" @change="handleFileUpload" required />
                                    <template x-if="selectedFile">
                                        <p class="text-sm mt-2 text-gray-600">
                                            File dipilih: <span x-text="selectedFile.name"></span>
                                        </p>
                                    </template>
                                </div>
                                <div class="mt-4">
                                    <label for="notes">Keterangan</label>
                                    <textarea id="notes" name="notes" class="form-textarea min-h-[130px]" placeholder="Keterangan...."
                                        x-model="params.notes"></textarea>
                                </div>
                                <div class="panel mt-4">
                                    <div class="grid xl:grid-cols-1 lg:grid-cols-4 sm:grid-cols-2 grid-cols-1 gap-4">
                                        <button type="button" class="btn btn-success w-full gap-2"
                                            @click="saveToLocal">Simpan</button>
                                        <button type="submit" class="btn btn-info w-full gap-2">Send
                                            SimtanForm</button>
                                        {{-- <a href="/apps/SimtanForm/preview"
                                            class="btn btn-primary w-full gap-2">Preview</a>
                                        <button type="button" class="btn btn-secondary w-full gap-2">Download</button> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        {{-- Notifikasi untuk Simpan Lokal --}}
        <template x-if="showSuccess">
            <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4 text-sm mt-6">
                Data Berhasil Disimpan
            </div>
        </template>

        <script>
            document.addEventListener("alpine:init", () => {
                Alpine.data('SimtanFormAdd', () => ({
                    items: [],
                    selectedFile: null,
                    notes: '',
                    periodeData: '',
                    selectedKategoriFileRekap: '',
                    showSuccess: false,

                    params: {
                        kodeUpload: '',
                        diuploadOleh: '',
                        judulFile: '',
                        tanggalUpload: '',
                        notes: ''
                    },

                    KategoriFileRekapList: [
                        'Lokasi Kebun',
                        'Rekap TBM',
                        'Komposisi Lahan',
                        'Rincian TBM',
                        'Link Youtube',
                    ],

                    handleFileUpload(event) {
                        this.selectedFile = event.target.files[0];
                    },

                    updateKodeUpload() {
                        if (!this.selectedKategoriFileRekap) {
                            this.params.kodeUpload = '';
                            return;
                        }

                        fetch(`/simtanform/get-kode/${encodeURIComponent(this.selectedKategoriFileRekap)}`)
                            .then(response => response.json())
                            .then(data => {
                                this.params.kodeUpload = data.kode_upload;
                            })
                            .catch(error => {
                                console.error('Error fetching kode upload:', error);
                            });
                    },

                    init() {
                        const saved = localStorage.getItem('simtanFormData');
                        if (saved) {
                            const parsed = JSON.parse(saved);
                            this.params = parsed.params || this.params;
                            this.periodeData = parsed.periodeData || '';
                            this.selectedKategoriFileRekap = parsed.kategoriFileRekap || '';
                            this.notes = parsed.notes || '';
                            this.items = parsed.items || [];
                        }
                    },

                    saveToLocal() {
                        const dataToSave = {
                            params: this.params,
                            periodeData: this.periodeData,
                            kategoriFileRekap: this.selectedKategoriFileRekap,
                            notes: this.notes,
                            items: this.items
                        };
                        localStorage.setItem('simtanFormData', JSON.stringify(dataToSave));
                        this.showSuccess = true;
                        setTimeout(() => {
                            this.showSuccess = false;
                        }, 3000);
                    }
                }));
            });
        </script>
    </div>
</x-layout.default>
