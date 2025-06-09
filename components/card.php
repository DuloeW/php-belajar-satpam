<div class="bg-white rounded-lg p-5 my-4 shadow-md border-l-4 border-blue-600 transition-transform duration-200 hover:-translate-y-0.5 hover:shadow-lg">
    <div class="flex justify-between items-center mb-4 pb-2.5 border-b border-gray-200">
        <h3 class="text-blue-600 text-lg font-bold m-0"><?php echo htmlspecialchars($nomer_plat); ?></h3>
        <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-xs font-medium"><?php echo htmlspecialchars($jenis_kendaraan); ?></span>
    </div>
    <div class="flex flex-col gap-2">
        <div class="flex justify-between items-center">
            <span class="text-gray-500 text-sm">Tempat Ditemukan:</span>
            <span class="text-gray-700 font-medium text-sm"><?php echo htmlspecialchars($lokasi); ?></span>
        </div>
        <div class="flex justify-between items-center">
            <span class="text-gray-500 text-sm">Tanggal:</span>
            <span class="text-gray-700 font-medium text-sm"><?php echo htmlspecialchars($tgl); ?></span>
        </div>
    </div>
</div>
