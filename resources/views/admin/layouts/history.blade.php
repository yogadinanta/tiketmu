<div class="max-w-9xl mx-auto p-6">
  <h2 class="text-3xl font-bold text-gray-800 mb-6 flex items-center gap-3">
      <i class="fa-solid fa-receipt text-blue-600"></i>
      Riwayat Transaksi
  </h2>

  <div class="bg-white shadow-lg rounded-2xl overflow-hidden border border-gray-100">
      @if($histories->count() > 0)
          <table class="min-w-full">
              <thead class="bg-gradient-to-r from-blue-50 to-blue-100">
                  <tr class="text-left text-gray-700 font-semibold">
                      <th class="px-6 py-3">Tanggal</th>
                      <th class="px-6 py-3">Keterangan</th>
                      <th class="px-6 py-3">Tipe</th>
                      <th class="px-6 py-3 text-right">Jumlah</th>
                  </tr>
              </thead>
              <tbody class="divide-y divide-gray-100">
                  @foreach ($histories as $history)
                      <tr class="hover:bg-blue-50 transition">
                          <td class="px-6 py-3 text-gray-600">
                              <i class="fa-solid fa-calendar-day text-blue-400 mr-2"></i>
                              {{ $history->created_at->format('d M Y H:i') }}
                          </td>
                          <td class="px-6 py-3 text-gray-800">
                              <i class="fa-solid fa-circle-info text-gray-400 mr-2"></i>
                              {{ $history->description }}
                          </td>
                          <td class="px-6 py-3">
                              @if($history->type == 'tambah')
                                  <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full">
                                      <i class="fa-solid fa-arrow-up mr-1"></i> Tambah
                                  </span>
                              @else
                                  <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-red-700 bg-red-100 rounded-full">
                                      <i class="fa-solid fa-arrow-down mr-1"></i> Kurang
                                  </span>
                              @endif
                          </td>
                          <td class="px-6 py-3 text-right font-semibold">
                              @if($history->type == 'tambah')
                                  <span class="text-green-600">+ Rp{{ number_format($history->amount, 0, ',', '.') }}</span>
                              @else
                                  <span class="text-red-600">- Rp{{ number_format($history->amount, 0, ',', '.') }}</span>
                              @endif
                          </td>
                      </tr>
                  @endforeach
              </tbody>
          </table>
      @else
          <div class="p-6 text-center text-gray-500">
              <i class="fa-solid fa-folder-open text-gray-400 text-3xl mb-2"></i>
              <p>Belum ada riwayat transaksi.</p>
          </div>
      @endif
  </div>
</div>
