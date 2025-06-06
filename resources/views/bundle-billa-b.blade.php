<!DOCTYPE html>
<html lang="en">
<head>
   <style>
  html, body {
    height: 100%;
    margin: 0;
    padding: 0;
  }
  body {
    width: 100vw;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0;
    padding: 0;
    overflow: hidden;
    position: fixed;
    top: 0;
    left: 0;
  }
  #contentarea {
    transform: rotate(90deg);
    transform-origin: center center;
    max-width: 700px;
    min-height: unset;
  }
</style>

</head>
<body>
<div id="contentarea" style="border:6px dashed #a3a3a3; padding:32px; background:#fff; width: 560px; padding: 5px; height: 405px;"> 
  <div id="billa">
    <h1 style="font-size:70px;text-align:center;font-weight:bold;margin:0;">
      {{ $stock->khana ?? '' }}  <span class=""> - {{ $stock->ogauge ?? ($order->ogauge ?? '') }}g-{{ $stock->b_width ?? '' }}-{{ $stock->jalilenght ?? ($order->jalilenght ?? '') }}</span>
    </h1>
    <div id="cline1" style="height:30px;"></div>
    <table width="100%" border="0" style="margin-bottom:0;">
      <tr>
        <td align="center" valign="top" style="width:33%;padding:0;">
          <h2 style="font-size:40px;font-family:'Arial Black',Arial,sans-serif;font-weight:900;margin:0;letter-spacing:2px;">
            {{ $bundle->sheets_per_bundle ?? '' }}<span style="font-size:22px;">ST</span>
          </h2>
        </td>
        <td align="center" valign="top" style="width:33%;padding:0;">
          <h2 style="font-size:40px;font-family:'Arial Black',Arial,sans-serif;font-weight:900;margin:0;letter-spacing:2px;">={{ ($stock->jalilenght ?? ($order->jalilenght ?? 0)) * ($bundle->sheets_per_bundle ?? 0) }}<span style="font-size:22px;">F</span>
          </h2>
        </td>
        <td align="center" valign="top" style="width:33%;padding:0;">
          <h3 style="font-size:40px;font-family:'Arial Black',Arial,sans-serif;font-weight:900;margin:0;letter-spacing:2px;">
            {{ $stock->sheet_size ?? ($order->cutsheet ?? '') }}
          </h3>
          <hr style="margin:8px 0;border-top:2px solid #000000;width:100%;">
          <div style="font-size:32px;font-family:'Arial Black',Arial,sans-serif;font-weight:900;letter-spacing:1.5px;">
            {{ $stock->lot ?? ($order->lot ?? '') }}
          </div>
        </td>
      </tr>
    </table>
  </div>
  <div id="bottombilla">
    <div style="display:flex;align-items:flex-end;justify-content:space-between;">
      <div style="display:flex;flex-direction:column;align-items:flex-start;">
        <div style="font-size:28px;font-family:'Arial Black',Arial,sans-serif;font-weight:900;letter-spacing:1.5px;">Date: {{ $bundle->date ?? ($stock->date ?? '') }}</div>
        <div style="font-size:28px;font-family:'Arial Black',Arial,sans-serif;font-weight:900;letter-spacing:1.5px;">Mch #: {{ $stock->machine_id ?? '' }}</div>
      </div>
      <div style="display:flex;flex-direction:column;align-items:center;">
        <div style="font-size:44px;font-family:'Arial Black',Arial,sans-serif;font-weight:900;line-height:1;letter-spacing:2px;">{{ $stock->party_name ?? ($order->party_name ?? '') }}</div>
        <div style="font-size:28px;font-family:'Arial Black',Arial,sans-serif;font-weight:900;letter-spacing:1.5px;">Pck By: {{ $stock->packed_by ?? ($bundle->packed_by ?? '') }}</div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
