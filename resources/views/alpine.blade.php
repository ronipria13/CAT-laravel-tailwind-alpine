@extends('layouts.app.main')

@section('title', '| Alpine JS')

@section('content')

    <div class="container bg-white border-r-4 p-10">
        <h3 class="h3">Ini halaman testing alpine JS</h3>

        
        <div x-data="{ open: false }">
            <!-- Button -->
            <button x-on:click="open = true" type="button" class="bg-white border border-black px-4 py-2 focus:outline-none focus:ring-4 focus:ring-aqua-400">
                Open dialog
            </button>

            <!-- Modal -->
            <div
                x-show="open"
                x-on:keydown.escape.prevent.stop="open = false"
                role="dialog"
                aria-modal="true"
                x-id="['modal-title']"
                :aria-labelledby="$id('modal-title')"
                class="fixed inset-0 overflow-y-auto"
            >
                <!-- Overlay -->
                <div x-show="open" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50"></div>

                <!-- Panel -->
                <div
                    x-show="open" x-transition
                    x-on:click="open = false"
                    class="relative min-h-screen flex items-center justify-center p-4"
                >
                    <div
                        x-on:click.stop
                        x-trap.noscroll.inert="open"
                        class="relative max-w-2xl w-full bg-white border border-black p-8 overflow-y-auto"
                    >
                        <!-- Title -->
                        <h2 class="text-3xl font-medium" :id="$id('modal-title')">Confirm</h2>
                        <!-- Content -->
                        <p class="mt-2 text-gray-600">Are you sure you want to learn how to create an awesome modal?</p>
                        <p class="mt-2 text-gray-600">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur rem debitis illum pariatur nostrum voluptate iste beatae vitae cupiditate corporis ex iure voluptatibus atque architecto, distinctio inventore illo, aut facere.
                        Eligendi distinctio tempore quaerat possimus, deleniti perspiciatis libero nihil accusamus obcaecati assumenda ipsa perferendis ducimus ipsum quo sunt. Voluptatibus accusamus sequi quis maiores quia labore aut dolore cum, eos unde.
                        Ullam, dicta quis similique, neque cupiditate tempora accusamus commodi esse minima assumenda saepe dolor ut exercitationem beatae repellat quia inventore. Expedita iste vitae repellendus, laboriosam ad placeat perferendis. Hic, omnis.
                        Explicabo, cumque esse? Nihil incidunt odit similique atque excepturi ullam laudantium, assumenda est velit esse maiores beatae veritatis dolorem voluptatem itaque a, accusamus tenetur natus tempore delectus soluta molestias? Laboriosam.
                        Praesentium eum beatae adipisci molestiae ratione quas officia, et esse? At temporibus quasi, illum expedita, perferendis modi iusto sunt et in quo similique eligendi consequatur quod, accusantium incidunt magnam natus.
                        Unde eveniet, nam fuga odit facilis quaerat pariatur doloribus, nisi mollitia, ea iure dolor aspernatur rerum impedit? Consequuntur, tempora provident. At in harum distinctio excepturi ratione ullam cumque tenetur quisquam.
                        Optio ullam repellendus dignissimos rerum culpa deleniti facere obcaecati qui veniam aut amet, maiores placeat soluta dolorum, cumque eos hic, tempore quibusdam reiciendis veritatis. Id iste iure quia numquam labore.
                        Laboriosam cum, sunt modi ab perferendis beatae alias earum vel illo error nemo, nesciunt tempore officia aliquid mollitia! Hic accusamus doloremque repellat necessitatibus officiis unde, obcaecati ipsa ex blanditiis asperiores?
                        Quibusdam veniam reiciendis ipsam alias adipisci. Dolores quis laboriosam, nemo, facilis et ex, amet quas quia aspernatur perspiciatis deleniti? Sunt nam omnis vel. Incidunt fugit assumenda, reiciendis magni repudiandae tempora.
                        Nihil iste commodi, possimus, molestiae repellendus sed similique iusto numquam dolore ab eaque eos sapiente. Quia nam rerum nihil minima, eaque est, saepe dolores possimus illo dignissimos labore repellat veritatis?
                        Deserunt, voluptatibus perferendis? Atque dicta sed facilis quis fuga ea beatae tempore distinctio mollitia consequuntur quas, rerum dolores, delectus ipsum sequi nesciunt non? Natus quas amet eligendi veritatis ea dolor?
                        Suscipit deserunt atque commodi dolor? Quae eius inventore, explicabo reprehenderit odio, quasi minima incidunt magnam commodi ratione quis repellendus illum aliquid vero ipsam excepturi, reiciendis libero delectus optio praesentium nemo.
                        Incidunt, quisquam. Quibusdam iure vero totam asperiores id voluptates minima itaque voluptatum amet optio eaque pariatur perferendis cumque, quisquam recusandae quae possimus velit unde praesentium aliquid, temporibus commodi! Quod, animi?
                        Repellendus, facilis. Doloribus nulla, vero, blanditiis accusantium excepturi quos quam aspernatur quae omnis minus sequi eos! Ab necessitatibus quis dolores quibusdam numquam, perferendis nemo atque illo dicta voluptate sunt tempore.
                        Asperiores repellendus accusamus vero excepturi minus quisquam? Incidunt consectetur velit, dicta, eligendi quisquam expedita voluptate sed numquam ipsam porro nobis, explicabo odio. Odit molestias numquam, maiores nulla ducimus dolorum blanditiis.
                        Distinctio quam consectetur veritatis deserunt dignissimos ex tempora animi, quos expedita architecto aliquam. Eveniet hic dicta fuga error. Alias ullam voluptates omnis labore porro odit corporis tenetur ipsam modi corrupti?
                        Necessitatibus et dignissimos officia neque, tenetur numquam aut illo quis asperiores, pariatur vitae ipsa in labore cupiditate voluptatem minima repellat. Minima vel quas eum corporis doloribus. Deserunt accusantium unde nostrum?
                        Dignissimos illum reiciendis illo nulla praesentium. Quo vel, sint sed, itaque id voluptas harum dicta quibusdam ipsam ipsum, ducimus maiores tempora voluptate esse tempore ut dolorem eligendi? Suscipit, quidem sint!
                        Rem possimus placeat fugiat numquam sapiente odit sit necessitatibus quibusdam neque, inventore ad voluptatum maxime obcaecati. Ipsa enim veniam omnis reprehenderit nesciunt quibusdam? Temporibus dignissimos sequi, consequatur libero tenetur eius!</p>
                        <!-- Buttons -->
                        <div class="mt-8 flex space-x-2">
                            <button type="button" x-on:click="open = false" class="bg-white border border-black px-4 py-2 focus:outline-none focus:ring-4 focus:ring-aqua-400">
                                Confirm
                            </button>
                            <button type="button" x-on:click="open = false" class="bg-white border border-black px-4 py-2 focus:outline-none focus:ring-4 focus:ring-aqua-400">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div x-data="{ open: false }">
            <button x-on:click="open = ! open">Toggle Dropdown</button>
         
            <div x-show="open" x-transition>
                Dropdown Contents...
            </div>
        </div>





    </div>

@endsection