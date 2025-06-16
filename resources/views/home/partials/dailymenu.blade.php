    <!-- Daily Menu Area Starts -->
    <section id="dailymenu" class="bg-slate-100 py-20 w-full">
      <div class="mx-auto max-w-[980px]">
        <div class="text-center m-4 max-w-sm mx-auto">
          <h3 class="font-bold font-cursive-merie text-4xl leading-normal capitalize">
            <span class="text-amber-400 leading-snug">menú</span> del día
          </h3>
        </div>
        <div class="flex flex-wrap justify-center mt-5">
          @foreach ($dailymenudata as $data)
          <div class="max-w-[290px] m-4 shadow-md">
            <img class="w-full h-auto" src="{{ $data['img'] }}" alt="{{ $data['name'] }}-image">
            <div class="p-7 bg-white">
              <div class="flex flex-wrap justify-between font-bold font-cursive-merie text-lg">
                <h5 class='p-1 leading-normal capitalize'>{{ $data['name'] }}</h5>
                <span class="text-amber-400 p-1 text-right">${{ $data['price'] }}</span>
              </div>
              <p class="pt-4 text-[14px] font-sans-lato text-slate-600 leading-relaxed">{{ $data['desc'] }}</p>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section>
    <!-- Daily Menu Area End -->
