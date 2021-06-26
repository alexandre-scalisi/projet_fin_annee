<div class="h-10 w-full bg-gray-800 flex text-gray-100 px-4">
    <div class="table">
    <a href="#" class="table-cell align-middle hover:text-blue-400">Aller au front-end</a>
    </div>
    <div class="flex space-x-4 ml-10">
        <div class="relative table mr-0 collapse" x-data="{show: false}" @mouseenter="show=true" @mouseleave="show=false">
            <a href="#" class="table-cell align-middle hover:text-blue-400 px-5">créer</a>
            <ul   @mouseenter="show=true" x-show="show" class="inline-block absolute bottom-0 transform translate-y-full left-0 bg-gray-700 p-2 mt-2 w-32">
                <li>
                    <a href="#" class="hover:text-blue-400 inline-block w-full">anime</a>
                </li>
                <li>
                    <a href="#" class="hover:text-blue-400 inline-block w-full">episode</a>
                </li>
                <li>
                    <a href="#" class="hover:text-blue-400 inline-block w-full">genre</a>
                </li>
                <li>
                    <a href="#" class="hover:text-blue-400 inline-block w-full">compte</a>
                </li>
            </ul>
        </div>
        <div class="table" style="margin-left: 0">
        <a href="#" class="table-cell align-middle px-6 hover:text-blue-400">créer nouveau xx<a/>
        <a href="#" class="table-cell align-middle px-6 hover:text-blue-400">modifier xx<a/>
        <a href="#" class="table-cell align-middle px-6 hover:text-blue-400">supprimer xx<a/>
        </div>
    </div>
</div>