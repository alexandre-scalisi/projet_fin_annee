
<div class="{{ $bgColor }} px-5 py-4 border rounded-lg my-4 w-80">
    <h1 class="flex justify-between"> {{ $item->author->name }} <span class="text-sm">
            {{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }} </span></h1>
    <p>{{ $item->body }} <button @click="show = !show"
            class="bg-yellow-100 rounded-lg px-3 py-2">reply</button></p>
</div>

