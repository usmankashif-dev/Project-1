<x-app-layout>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Rotated Card Layout</title>
  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }
    body {
      display: flex;
      align-items: center;
      justify-content: center;
      background: #f5f5f5;
      overflow: hidden;
      padding-top: 60px;
    }
    #wrapper {
      transform: rotate(90deg);
      transform-origin: center center;
    }
  </style>
</head>
<body>

  <div id="wrapper" class="w-[450px] border-4 border-dashed border-gray-400 bg-white">
    <!-- Black top bar -->
    <div class="bg-black text-white text-4xl font-extrabold py-3 tracking-wider flex items-center justify-between" style="padding-left:36px;padding-right:36px; font-size: 50px;">
      <span class="">{{ ($stock->khana ?? '') }} </span>
      <span class=""> - {{ $stock->ogauge ?? ($order->ogauge ?? '') }}g-{{ $stock->b_width ?? '' }}-{{ $stock->jalilenght ?? ($order->jalilenght ?? '') }}</span>
    </div>

    <!-- Main Numbers Row -->
    <div class="flex justify-around items-center py-6 px-6">
      <div class="text-4xl font-black p-2">{{ $bundle->sheets_per_bundle ?? '' }}S</div>
      <div class="text-4xl font-black p-2">={{ ($stock->jalilenght ?? ($order->jalilenght ?? 0)) * ($bundle->sheets_per_bundle ?? 0) }}F</div>
      <div class="text-center">
        <div class="text-4xl font-black">{{ $stock->sheet_size ?? ($order->cutsheet ?? '') }}</div>
        <hr style="margin:8px 0;border-top:2px solid #000000;width:90%;">
        <div class="text-2xl font-black">{{ $stock->lot ?? ($order->lot ?? '') }}</div>
      </div>
    </div>

    <!-- Footer Info -->
    <div class="flex justify-between px-6 pb-6">
      <div class="flex flex-col gap-1 text-left text-xl font-bold">
        <div>Date: {{ $bundle->date ?? ($stock->date ?? '') }}</div>
        <div>Mch #: {{ $stock->machine_id ?? '' }}</div>
      </div>
      <div class="text-right">
        <div class="text-2xl font-bold" style="font-size: xx-large;">{{ $stock->party_name ?? ($order->party_name ?? '') }}</div>
        <div class="text-lg font-bold">Pck By: {{ $stock->packed_by ?? ($bundle->packed_by ?? '') }}</div>
      </div>
    </div>
  </div>

</body>
</html>
</x-app-layout>