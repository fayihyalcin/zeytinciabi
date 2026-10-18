<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $brandName }} - Giriş Bildirimi</title>
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
            <td background="{{ $heroUrl }}" style="background:#1d3512 url('{{ $heroUrl }}') right center/cover no-repeat;padding:36px 42px;color:#ffffff;">
              <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="84" valign="middle" style="width:84px;">
                    <div style="width:62px;height:62px;border:3px solid #9cb751;color:#dce9a4;text-align:center;line-height:62px;font-size:31px;font-weight:700;">&#128274;</div>
                  </td>
                  <td valign="middle">
                    <h1 style="margin:0 0 8px;font-family:Georgia,'Times New Roman',serif;font-size:27px;line-height:1.2;color:#ffffff;text-shadow:0 2px 6px rgba(0,0,0,.35);">Hesabınıza giriş yapıldı</h1>
                    <p style="margin:0;color:#ffffff;font-size:15px;line-height:1.6;text-shadow:0 1px 4px rgba(0,0,0,.35);">Güvenliğiniz bizim için önemli.</p>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td style="padding:32px 42px 12px;">
              <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="86" valign="top" style="width:86px;padding-right:22px;">
                    <div style="width:74px;height:74px;border-radius:50%;background:#f2ecd9;border:1px solid #dfd2b5;text-align:center;line-height:74px;color:#436713;font-size:40px;font-weight:700;">&#9679;</div>
                  </td>
                  <td valign="top">
                    <h2 style="margin:0 0 10px;font-family:Georgia,'Times New Roman',serif;font-size:22px;line-height:1.25;color:#172511;">Merhaba Değerli Bayimiz,</h2>
                    <p style="margin:0;color:#30382b;font-size:15px;line-height:1.7;">Hesabınıza yeni bir giriş yapıldığını bildirmek isteriz. Aşağıda giriş detaylarını bulabilirsiniz.</p>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td style="padding:18px 42px 26px;">
              <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#fffefb;border:1px solid #e5dccd;border-radius:10px;">
                <tr>
                  <td align="center" width="25%" style="padding:22px 12px;color:#172511;font-size:13px;line-height:1.5;">
                    <div style="color:#436713;font-size:32px;line-height:1.1;">▦</div>
                    <strong style="display:block;margin:9px 0 5px;">Giriş Tarihi</strong>
                    {{ $loginTime->format('d.m.Y') }}<br>{{ $loginTime->format('H:i') }}
                  </td>
                  <td align="center" width="25%" style="padding:22px 12px;color:#172511;font-size:13px;line-height:1.5;border-left:1px solid #e7dccb;">
                    <div style="color:#436713;font-size:32px;line-height:1.1;">⌖</div>
                    <strong style="display:block;margin:9px 0 5px;">IP Adresi</strong>
                    {{ $ipAddress ?: 'Belirlenemedi' }}
                  </td>
                  <td align="center" width="25%" style="padding:22px 12px;color:#172511;font-size:13px;line-height:1.5;border-left:1px solid #e7dccb;">
                    <div style="color:#436713;font-size:32px;line-height:1.1;">▭</div>
                    <strong style="display:block;margin:9px 0 5px;">Cihaz / Tarayıcı</strong>
                    {{ $userAgent ? Str::limit($userAgent, 48) : 'Belirlenemedi' }}
                  </td>
                  <td align="center" width="25%" style="padding:22px 12px;color:#172511;font-size:13px;line-height:1.5;border-left:1px solid #e7dccb;">
                    <div style="color:#436713;font-size:32px;line-height:1.1;">◎</div>
                    <strong style="display:block;margin:9px 0 5px;">Konum</strong>
                    Belirlenemedi
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td style="padding:0 42px 28px;">
              <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#fff7e3;border:1px solid #e0ba59;border-radius:10px;">
                <tr>
                  <td width="74" align="center" style="width:74px;padding:18px 10px;">
                    <div style="width:46px;height:46px;border-radius:50%;background:#d5a12d;color:#ffffff;text-align:center;line-height:46px;font-size:28px;font-weight:800;">!</div>
                  </td>
                  <td style="padding:18px 18px 18px 0;color:#26311f;font-size:14px;line-height:1.6;">Bu giriş size ait değilse güvenliğiniz için hemen şifrenizi değiştirmenizi ve bizimle iletişime geçmenizi öneririz.</td>
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
