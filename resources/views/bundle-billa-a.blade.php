<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Rotated Card Layout</title>
  <script src="https://cdn.tailwindcss.com"></script>
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
    <div class="bg-black text-white text-center text-4xl font-extrabold py-3 tracking-wider">
      {{ ($stock->khana ?? '') }} &nbsp;{{ $stock->jalilenght ?? ($order->jalilenght ?? '') }}-{{ $stock->b_width ?? '' }}-{{ $stock->gauge ?? ($order->ogauge ?? '') }}
    </div>

    <!-- Main Numbers Row -->
    <div class="flex justify-around items-center py-6 px-6">
      <div class="text-4xl font-black">{{ $bundle->sheets_per_bundle ?? '' }}</div>
      <div class="text-4xl font-black">= {{ ($stock->jalilenght ?? ($order->jalilenght ?? 0)) * ($bundle->sheets_per_bundle ?? 0) }}</div>
      <div class="text-center">
        <div class="text-4xl font-black">{{ $stock->sheet_size ?? ($order->cutsheet ?? '') }}</div>
        <hr class="border-t-2 border-gray-500 w-16 mx-auto my-1" />
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
        <div class="text-2xl font-bold">{{ $stock->party_name ?? ($order->party_name ?? '') }}</div>
        <div class="text-lg font-bold">Pck By: {{ $stock->packed_by ?? ($bundle->packed_by ?? '') }}</div>
      </div>
    </div>
  </div>

</body>
</html>
