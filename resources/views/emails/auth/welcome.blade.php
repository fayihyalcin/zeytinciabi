<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $brandName }} - Başvurunuz Alındı</title>
</head>
<body style="margin:0;padding:0;background:#f4efe3;font-family:Arial,Helvetica,sans-serif;color:#172511;">
  <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#f4efe3;padding:24px 10px;">
    <tr>
      <td align="center">
        <table role="presentation" width="680" cellspacing="0" cellpadding="0" style="width:680px;max-width:100%;background:#fffdf8;border:1px solid #e3d8c5;box-shadow:0 16px 40px rgba(50,59,26,.13);">
          <tr>
            <td align="center" style="padding:24px 24px 18px;background:#fffefb;">
              <img src="{{ $logoUrl }}" width="310" alt="{{ $brandName }}" style="display:block;width:310px;max-width:86%;height:auto;border:0;">
            </td>
          </tr>
          <tr>
            <td background="{{ $heroUrl }}" style="background:#1d3512 url('{{ $heroUrl }}') center/cover no-repeat;padding:42px 42px;color:#ffffff;">
              <h1 style="margin:0 0 10px;font-family:Georgia,'Times New Roman',serif;font-size:34px;line-height:1.15;color:#ffffff;text-shadow:0 2px 6px rgba(0,0,0,.35);">Hoş geldin!</h1>
              <p style="margin:0;max-width:360px;color:#ffffff;font-size:16px;line-height:1.6;text-shadow:0 1px 4px rgba(0,0,0,.35);">Zeytinci Abi ailesine katıldığın için çok mutluyuz.</p>
            </td>
          </tr>
          <tr>
            <td style="padding:30px 42px 10px;">
              <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="86" valign="top" style="width:86px;padding-right:22px;">
                    <div style="width:74px;height:74px;border-radius:50%;background:#f2ecd9;border:1px solid #dfd2b5;text-align:center;line-height:74px;color:#436713;font-size:40px;font-weight:700;">&#9679;</div>
                  </td>
                  <td valign="top">
                    <h2 style="margin:0 0 10px;font-family:Georgia,'Times New Roman',serif;font-size:22px;line-height:1.25;color:#172511;">Merhaba Değerli Bayimiz,</h2>
                    <p style="margin:0;color:#30382b;font-size:15px;line-height:1.7;">Bayi başvurun başarıyla alınmıştır. Ekibimiz başvurunu inceleyerek en kısa sürede değerlendirecek ve sana dönüş sağlayacaktır.</p>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td style="padding:18px 42px 24px;">
              <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#fffaf0;border:1px solid #dfc88f;border-radius:10px;">
                <tr>
                  <td width="94" align="center" valign="top" style="width:94px;padding:20px 8px;">
                    <div style="width:58px;height:58px;border-radius:50%;background:#6f8d36;color:#ffffff;text-align:center;line-height:58px;font-size:34px;font-weight:700;">✓</div>
                  </td>
                  <td style="padding:20px 20px 20px 0;">
                    <strong style="display:block;margin-bottom:8px;color:#436713;font-size:16px;">Başvuru Durumunuz</strong>
                    <span style="display:block;color:#25301f;font-size:14px;line-height:1.65;">Başvurunuz incelenmek üzere sistemimize kaydedilmiştir. Onaylandığında bayi panelinize giriş yaparak ürünleri, fiyatları ve kazanç oranlarını görüntüleyebilirsiniz.</span>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td style="padding:0 42px 8px;">
              <h3 style="margin:0;text-align:center;font-family:Georgia,'Times New Roman',serif;font-size:20px;color:#172511;">Sizi Neler Bekliyor?</h3>
            </td>
          </tr>
          <tr>
            <td style="padding:14px 34px 30px;">
              <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center" width="20%" style="padding:8px 6px;color:#20291d;font-size:12px;line-height:1.45;"><div style="color:#436713;font-size:30px;line-height:1.1;">⌂</div>Bayi alış fiyatlarını görebilirsiniz.</td>
                  <td align="center" width="20%" style="padding:8px 6px;color:#20291d;font-size:12px;line-height:1.45;border-left:1px solid #e4d8c4;"><div style="color:#436713;font-size:30px;line-height:1.1;">◇</div>Kendi satış fiyatınızı belirleyebilirsiniz.</td>
                  <td align="center" width="20%" style="padding:8px 6px;color:#20291d;font-size:12px;line-height:1.45;border-left:1px solid #e4d8c4;"><div style="color:#436713;font-size:30px;line-height:1.1;">↗</div>Satış başına tahmini karınızı takip edebilirsiniz.</td>
                  <td align="center" width="20%" style="padding:8px 6px;color:#20291d;font-size:12px;line-height:1.45;border-left:1px solid #e4d8c4;"><div style="color:#436713;font-size:30px;line-height:1.1;">▣</div>Kendi landing page sayfalarınızı oluşturabilirsiniz.</td>
                  <td align="center" width="20%" style="padding:8px 6px;color:#20291d;font-size:12px;line-height:1.45;border-left:1px solid #e4d8c4;"><div style="color:#436713;font-size:30px;line-height:1.1;">▱</div>Siparişlerinizi ve kargo durumlarını panelden izlersiniz.</td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td align="center" style="padding:0 42px 30px;">
              <a href="{{ $panelUrl }}" style="display:inline-block;background:#315c06;color:#ffffff;text-decoration:none;border-radius:8px;padding:15px 34px;font-size:15px;font-weight:800;letter-spacing:.2px;">BAYİ PANELİNE GİT &nbsp;→</a>
            </td>
          </tr>
          <tr>
            <td style="background:#10270f;padding:24px 34px;color:#ffffff;">
              <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="110" align="left"><img src="{{ $branchUrl }}" width="90" alt="" style="display:block;width:90px;height:auto;border:0;"></td>
                  <td align="center" style="font-family:Georgia,'Times New Roman',serif;font-size:18px;line-height:1.5;">Doğadan sofranıza, güvenle ve emekle.</td>
                  <td width="110" align="right"><img src="{{ $branchUrl }}" width="90" alt="" style="display:block;width:90px;height:auto;border:0;"></td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td style="padding:18px 34px;background:#fffefb;color:#70736d;font-size:12px;">
              <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="left">{{ $supportEmail }}</td>
                  <td align="center">www.zeytinciabi.com</td>
                  <td align="right">© {{ now()->year }} {{ $brandName }}. Tüm hakları saklıdır.</td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
