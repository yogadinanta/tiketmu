orderID          : string
statusOrder      : string     // PENDING, SUCCESS, FAILED
callbackData     : record     // data yang dikirim oleh payment gateway
signatureValid   : boolean
userOption       : string     // "ulang" atau "batal"


// 1. User memilih layanan travel
read(layananTravel)

// 2. Sistem membuat Order ID dan status awal
orderID ← GenerateOrderID()
statusOrder ← "PENDING"

// 3. Redirect ke Payment Gateway
RedirectToPaymentGateway(orderID)

// 4. User melakukan pembayaran → Payment Gateway memproses
// (Proses ini terjadi di luar sistem)

// 5. Payment Gateway mengirim Callback ke OneTravel
callbackData ← ReceiveCallback()

// 6. Validasi signature keamanan
signatureValid ← ValidateSignature(callbackData)

if signatureValid = TRUE then

    // 7. Cek status pembayaran dari callback
    if callbackData.status = "SUCCESS" then
        statusOrder ← "SUCCESS"
        
        // Update transaksi dan pesanan
        UpdateStatus(orderID, "SUCCESS")

        // Kirim notifikasi ke seller
        NotifySeller(orderID)

        // Seller memproses pesanan
        ProcessOrder(orderID)

        // Admin monitoring & rekonsiliasi
        AdminReconcile(orderID)

        // Dana masuk ke saldo seller sesuai jadwal
        TransferToSellerBalance(orderID)

        // Pesanan selesai
        write("Pembayaran Berhasil. Pesanan Diproses.")

    else if callbackData.status = "FAILED" then
        statusOrder ← "FAILED"
        
        // Tampilkan status gagal
        write("Pembayaran Gagal.")

        // User memilih tindakan
        read(userOption)   // "ulang" / "batal"

        if userOption = "ulang" then
            RedirectToPaymentGateway(orderID)
        else if userOption = "batal" then
            CancelOrder(orderID)
            write("Pesanan Dibatalkan.")
        endif
    endif

else
    // Signature tidak valid → kemungkinan fraud
    write("Callback tidak valid. Transaksi diblokir.")
endif
