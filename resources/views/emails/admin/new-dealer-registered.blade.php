<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $brandName }} - Yeni Bayi Başvurusu</title>
</head>
<body style="margin:0;padding:0;background:#f6f1e8;font-family:Arial,Helvetica,sans-serif;color:#172511;">
  <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#f6f1e8;padding:28px 12px;">
    <tr><td align="center">
      <table role="presentation" width="640" cellspacing="0" cellpadding="0" style="width:640px;max-width:100%;background:#fffdf8;border:1px solid #e3d8c5;border-radius:18px;overflow:hidden;box-shadow:0 18px 42px rgba(61,67,40,.12);">
        <tr>
          <td style="background:#10270f;padding:26px 32px;color:#ffffff;">
            <div style="font-family:Georgia,'Times New Roman',serif;font-size:28px;font-weight:700;line-height:1;">{{ $brandName }}</div>
            <div style="margin-top:6px;color:#d7c99e;font-size:13px;font-weight:700;">{{ $brandSubtitle }}</div>
          </td>
        </tr>
        <tr><td style="height:6px;background:#c29a31;"></td></tr>
        <tr>
          <td style="padding:34px 32px 12px;">
            <h1 style="margin:0 0 12px;font-family:Georgia,'Times New Roman',serif;font-size:30px;line-height:1.2;color:#143113;">Yeni bayi başvurusu var</h1>
            <p style="margin:0;color:#4a5145;font-size:15px;line-height:1.7;">Yeni bir bayi adayı sisteme kayıt oldu. Başvuruyu admin panelinden inceleyip onay veya red işlemi yapabilirsiniz.</p>
          </td>
        </tr>
        <tr>
          <td style="padding:12px 32px 24px;">
            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border:1px solid #e6dccb;border-radius:14px;background:#fbf8f2;">
              <tr><td style="padding:16px;border-bottom:1px solid #eee4d7;"><strong style="display:block;color:#172511;font-size:14px;">Ad Soyad</strong><span style="color:#6b6d65;font-size:13px;">{{ $user->name }}</span></td></tr>
              <tr><td style="padding:16px;border-bottom:1px solid #eee4d7;"><strong style="display:block;color:#172511;font-size:14px;">Bayi adı</strong><span style="color:#6b6d65;font-size:13px;">{{ $dealer?->display_name ?? '-' }}</span></td></tr>
              <tr><td style="padding:16px;border-bottom:1px solid #eee4d7;"><strong style="display:block;color:#172511;font-size:14px;">E-posta</strong><span style="color:#6b6d65;font-size:13px;">{{ $user->email ?: '-' }}</span></td></tr>
              <tr><td style="padding:16px;border-bottom:1px solid #eee4d7;"><strong style="display:block;color:#172511;font-size:14px;">Telefon</strong><span style="color:#6b6d65;font-size:13px;">{{ $user->phone ?: '-' }}</span></td></tr>
              <tr><td style="padding:16px;"><strong style="display:block;color:#172511;font-size:14px;">Kayıt yöntemi</strong><span style="color:#6b6d65;font-size:13px;">{{ $method === 'google' ? 'Google ile kayıt' : 'Form ile kayıt' }}</span></td></tr>
            </table>
          </td>
        </tr>
        <tr>
          <td style="padding:0 32px 32px;">
            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#eef3de;border:1px solid #d8e4b9;border-radius:14px;">
              <tr>
                <td style="padding:18px;color:#35431a;font-size:14px;line-height:1.65;"><strong>Not:</strong> Başvuru onaylanana kadar bayi sadece bekleme ekranını görür.</td>
                <td align="right" style="padding:18px;width:170px;"><a href="{{ $adminUrl }}" style="display:inline-block;background:#52741e;color:#ffffff;text-decoration:none;border-radius:10px;padding:13px 18px;font-size:13px;font-weight:900;">Başvuruyu Aç</a></td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td></tr>
  </table>
</body>
</html>
