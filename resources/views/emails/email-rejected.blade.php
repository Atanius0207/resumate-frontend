<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Transaksi Ditolak - ResuMate</title>
    
    <style>
        body, table, td, a { 
            -webkit-text-size-adjust: 100%; 
            -ms-text-size-adjust: 100%; 
        }
        table, td { 
            mso-table-lspace: 0pt; 
            mso-table-rspace: 0pt; 
        }
        img { 
            -ms-interpolation-mode: bicubic; 
            border: 0; 
            height: auto; 
            line-height: 100%; 
            outline: none; 
            text-decoration: none; 
        }
        
        body { 
            margin: 0 !important; 
            padding: 0 !important; 
            width: 100% !important; 
            height: 100% !important;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        @media screen and (max-width: 600px) {
            .email-container {
                width: 100% !important;
                margin: auto !important;
            }
            .fluid {
                width: 100% !important;
                max-width: 100% !important;
                height: auto !important;
                margin-left: auto !important;
                margin-right: auto !important;
            }
            .stack-column {
                display: block !important;
                width: 100% !important;
                max-width: 100% !important;
                direction: ltr !important;
            }
            .mobile-padding {
                padding: 20px !important;
            }
        }
    </style>
</head>

<body style="margin: 0; padding: 0; background-color: #f7f7f7;">
    <!-- Preview Text -->
    <div style="display: none; max-height: 0px; overflow: hidden;">
        Mohon maaf, transaksi pembayaran Anda tidak dapat diproses.
    </div>

    <!-- Email Container -->
    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: 0; padding: 0; background-color: #f7f7f7;">
        <tr>
            <td style="padding: 40px 20px;">
                
                <!-- Main Email Container -->
                <table role="presentation" class="email-container" cellspacing="0" cellpadding="0" border="0" align="center" width="600" style="margin: auto; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #e53935 0%, #c62828 100%); padding: 40px 40px 30px; text-align: center;">
                            <!-- Logo/Icon -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center">
                                <tr>
                                    <td style="background-color: #ffffff; width: 70px; height: 70px; border-radius: 16px; text-align: center; vertical-align: middle; box-shadow: 0 6px 20px rgba(0,0,0,0.15);">
                                        <div style="font-size: 36px; color: #e53935; line-height: 70px;">❌</div>
                                    </td>
                                </tr>
                            </table>
                            
                            <!-- Header Title -->
                            <h1 style="margin: 25px 0 0; padding: 0; color: #ffffff; font-size: 28px; font-weight: 700; line-height: 1.3;">
                                Transaksi Ditolak
                            </h1>
                        </td>
                    </tr>

                    <!-- Main Content -->
                    <tr>
                        <td class="mobile-padding" style="padding: 40px 40px 30px;">
                            
                            <!-- Greeting -->
                            <p style="margin: 0 0 20px; color: #333333; font-size: 16px; line-height: 1.6;">
                                Halo, <strong>{{ $userName ?? 'Pengguna' }}</strong>
                            </p>
                            
                            <!-- Message -->
                            <p style="margin: 0 0 30px; color: #666666; font-size: 15px; line-height: 1.6;">
                                Mohon maaf, transaksi pembayaran Anda untuk pembelian <strong>{{ $planName ?? 'Pro Plan' }}</strong> tidak dapat diproses dan telah ditolak oleh sistem pembayaran.
                            </p>

                            <!-- Transaction Details -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: 0 0 30px; background-color: #f9f9f9; border: 1px solid #e5e5e5; border-radius: 8px;">
                                <tr>
                                    <td style="padding: 24px;">
                                        <h3 style="margin: 0 0 16px; color: #333333; font-size: 16px; font-weight: 600;">
                                            📋 Detail Transaksi
                                        </h3>
                                        
                                        <!-- Transaction ID -->
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-bottom: 12px;">
                                            <tr>
                                                <td style="padding: 8px 0; color: #666666; font-size: 14px; width: 40%;">
                                                    ID Transaksi:
                                                </td>
                                                <td style="padding: 8px 0; color: #333333; font-size: 14px; font-weight: 600; text-align: right;">
                                                    {{ $transactionId ?? 'TRX-SB0910' }}
                                                </td>
                                            </tr>
                                        </table>
                                        
                                        <!-- Amount -->
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-bottom: 12px;">
                                            <tr>
                                                <td style="padding: 8px 0; color: #666666; font-size: 14px; width: 40%;">
                                                    Jumlah:
                                                </td>
                                                <td style="padding: 8px 0; color: #333333; font-size: 14px; font-weight: 600; text-align: right;">
                                                    Rp {{ number_format($amount ?? 199322, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        </table>
                                        
                                        <!-- Plan -->
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-bottom: 12px;">
                                            <tr>
                                                <td style="padding: 8px 0; color: #666666; font-size: 14px; width: 40%;">
                                                    Paket:
                                                </td>
                                                <td style="padding: 8px 0; color: #333333; font-size: 14px; font-weight: 600; text-align: right;">
                                                    {{ $planName ?? 'Pro Plan' }}
                                                </td>
                                            </tr>
                                        </table>
                                        
                                        <!-- Date -->
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-bottom: 12px;">
                                            <tr>
                                                <td style="padding: 8px 0; color: #666666; font-size: 14px; width: 40%;">
                                                    Tanggal:
                                                </td>
                                                <td style="padding: 8px 0; color: #333333; font-size: 14px; font-weight: 600; text-align: right;">
                                                    {{ $transactionDate ?? date('d M Y, H:i') }} WIB
                                                </td>
                                            </tr>
                                        </table>
                                        
                                        <!-- Status -->
                                        <div style="border-top: 1px solid #e5e5e5; margin: 16px 0; padding-top: 16px;">
                                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                <tr>
                                                    <td style="padding: 8px 0; color: #666666; font-size: 14px; width: 40%;">
                                                        Status:
                                                    </td>
                                                    <td style="padding: 8px 0; text-align: right;">
                                                        <span style="display: inline-block; padding: 6px 16px; background-color: #ffebee; color: #c62828; font-size: 13px; font-weight: 600; border-radius: 20px;">
                                                            Ditolak
                                                        </span>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <!-- Reason Alert -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: 0 0 30px;">
                                <tr>
                                    <td style="background-color: #fff3cd; border-left: 4px solid #ffc107; padding: 16px 20px; border-radius: 8px;">
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0">
                                            <tr>
                                                <td style="padding-right: 12px; vertical-align: top;">
                                                    <div style="font-size: 20px;">⚠️</div>
                                                </td>
                                                <td>
                                                    <p style="margin: 0 0 8px; color: #856404; font-size: 14px; font-weight: 600;">
                                                        Alasan Penolakan:
                                                    </p>
                                                    <p style="margin: 0; color: #856404; font-size: 14px; line-height: 1.5;">
                                                        {{ $rejectionReason ?? 'Pembayaran ditolak oleh bank atau saldo tidak mencukupi. Silakan periksa informasi kartu Anda atau gunakan metode pembayaran lain.' }}
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <!-- Retry Button -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: 0 0 30px;">
                                <tr>
                                    <td style="text-align: center;">
                                        <a href="{{ $retryUrl ?? '#' }}" style="display: inline-block; background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%); color: #ffffff; text-decoration: none; padding: 16px 48px; border-radius: 8px; font-size: 16px; font-weight: 600; box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);">
                                            Coba Lagi
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <!-- Divider -->
                            <div style="border-top: 1px solid #e5e5e5; margin: 30px 0;"></div>

                            <!-- Next Steps -->
                            <h3 style="margin: 0 0 15px; color: #333333; font-size: 16px; font-weight: 600;">
                                💡 Langkah Selanjutnya
                            </h3>
                            
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tr>
                                    <td style="padding: 0 0 12px;">
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0">
                                            <tr>
                                                <td style="padding-right: 10px; vertical-align: top;">
                                                    <div style="color: #4CAF50; font-size: 16px;">1.</div>
                                                </td>
                                                <td>
                                                    <p style="margin: 0; color: #666666; font-size: 14px; line-height: 1.5;">
                                                        <strong>Periksa informasi kartu</strong> - Pastikan nomor kartu, tanggal kadaluarsa, dan CVV sudah benar
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 0 0 12px;">
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0">
                                            <tr>
                                                <td style="padding-right: 10px; vertical-align: top;">
                                                    <div style="color: #4CAF50; font-size: 16px;">2.</div>
                                                </td>
                                                <td>
                                                    <p style="margin: 0; color: #666666; font-size: 14px; line-height: 1.5;">
                                                        <strong>Cek saldo atau limit</strong> - Pastikan Anda memiliki dana atau limit kartu kredit yang cukup
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 0 0 12px;">
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0">
                                            <tr>
                                                <td style="padding-right: 10px; vertical-align: top;">
                                                    <div style="color: #4CAF50; font-size: 16px;">3.</div>
                                                </td>
                                                <td>
                                                    <p style="margin: 0; color: #666666; font-size: 14px; line-height: 1.5;">
                                                        <strong>Gunakan metode lain</strong> - Coba metode pembayaran alternatif seperti e-wallet atau transfer bank
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 0;">
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0">
                                            <tr>
                                                <td style="padding-right: 10px; vertical-align: top;">
                                                    <div style="color: #4CAF50; font-size: 16px;">4.</div>
                                                </td>
                                                <td>
                                                    <p style="margin: 0; color: #666666; font-size: 14px; line-height: 1.5;">
                                                        <strong>Hubungi bank</strong> - Jika masalah berlanjut, hubungi bank Anda untuk informasi lebih lanjut
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <!-- Divider -->
                            <div style="border-top: 1px solid #e5e5e5; margin: 30px 0;"></div>

                            <!-- Alternative Payment Methods -->
                            <h3 style="margin: 0 0 15px; color: #333333; font-size: 16px; font-weight: 600;">
                                💳 Metode Pembayaran Lain
                            </h3>
                            
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: 0 0 20px;">
                                <tr>
                                    <td style="padding: 12px; background-color: #f9f9f9; border: 1px solid #e5e5e5; border-radius: 8px; width: 48%;">
                                        <div style="text-align: center;">
                                            <div style="font-size: 24px; margin-bottom: 8px;">🏦</div>
                                            <p style="margin: 0; color: #333333; font-size: 13px; font-weight: 600;">Transfer Bank</p>
                                        </div>
                                    </td>
                                    <td style="width: 4%;"></td>
                                    <td style="padding: 12px; background-color: #f9f9f9; border: 1px solid #e5e5e5; border-radius: 8px; width: 48%;">
                                        <div style="text-align: center;">
                                            <div style="font-size: 24px; margin-bottom: 8px;">📱</div>
                                            <p style="margin: 0; color: #333333; font-size: 13px; font-weight: 600;">E-Wallet</p>
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <!-- Divider -->
                            <div style="border-top: 1px solid #e5e5e5; margin: 30px 0;"></div>

                            <!-- Need Help -->
                            <p style="margin: 0; color: #666666; font-size: 14px; line-height: 1.6; text-align: center;">
                                Butuh bantuan? 
                                <a href="{{ $supportUrl ?? '#' }}" style="color: #4CAF50; text-decoration: none; font-weight: 600;">Hubungi Tim Support</a> 
                                kami. Kami siap membantu Anda menyelesaikan masalah pembayaran ini.
                            </p>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f9f9f9; padding: 30px 40px; border-top: 1px solid #e5e5e5;">
                            
                            <!-- Social Links -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" style="margin: 0 auto 20px;">
                                <tr>
                                    <td style="padding: 0 10px;">
                                        <a href="#" style="text-decoration: none;">
                                            <div style="width: 32px; height: 32px; background-color: #3b5998; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 16px; font-weight: bold;">f</div>
                                        </a>
                                    </td>
                                    <td style="padding: 0 10px;">
                                        <a href="#" style="text-decoration: none;">
                                            <div style="width: 32px; height: 32px; background-color: #1da1f2; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 16px; font-weight: bold;">t</div>
                                        </a>
                                    </td>
                                    <td style="padding: 0 10px;">
                                        <a href="#" style="text-decoration: none;">
                                            <div style="width: 32px; height: 32px; background-color: #0077b5; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 14px; font-weight: bold;">in</div>
                                        </a>
                                    </td>
                                    <td style="padding: 0 10px;">
                                        <a href="#" style="text-decoration: none;">
                                            <div style="width: 32px; height: 32px; background-color: #E4405F; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 14px; font-weight: bold;">ig</div>
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <!-- Company Info -->
                            <p style="margin: 0 0 10px; color: #999999; font-size: 13px; line-height: 1.6; text-align: center;">
                                <strong style="color: #666666;">ResuMate</strong><br>
                                Jl. Contoh No. 123, Jakarta Selatan 12345<br>
                                Indonesia
                            </p>

                            <!-- Copyright & Links -->
                            <p style="margin: 0; color: #999999; font-size: 12px; line-height: 1.6; text-align: center;">
                                © 2024 ResuMate. All rights reserved.<br>
                                <a href="#" style="color: #4CAF50; text-decoration: none;">Privacy Policy</a> | 
                                <a href="#" style="color: #4CAF50; text-decoration: none;">Terms of Service</a> | 
                                <a href="#" style="color: #4CAF50; text-decoration: none;">Unsubscribe</a>
                            </p>

                        </td>
                    </tr>

                </table>
                
            </td>
        </tr>
    </table>

</body>
</html>