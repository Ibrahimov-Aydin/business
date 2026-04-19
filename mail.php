<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit;
}

$to = 'ibrahimovaydin33sh@gmail.com';
$subject = 'Новая заявка с сайта';

$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=UTF-8\r\n";
$headers .= "From: no-reply@sitename.com\r\n";

$formType = isset($_POST['form_type']) ? trim($_POST['form_type']) : 'Форма с сайта';

$mes = '
<html>
<body>
<table border="1" cellpadding="6" cellspacing="0" width="90%" bordercolor="#dbdbdb">
<tr>
  <td colspan="2" align="center" bgcolor="#e4e4e4">
    <b>' . htmlspecialchars($formType) . '</b>
  </td>
</tr>
';

foreach ($_POST as $key => $value) {
    if ($key === 'form_type') continue;

    $label = htmlspecialchars($key);
    $fieldValue = htmlspecialchars(trim($value));

    $mes .= '
    <tr>
      <td><b>' . $label . '</b></td>
      <td>' . $fieldValue . '</td>
    </tr>';
}

$mes .= '
</table>
</body>
</html>
';

if (mail($to, $subject, $mes, $headers)) {
    header('Location: ./');
    exit;
} else {
    echo 'Ошибка отправки';
}
?>