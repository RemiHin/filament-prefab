<section>
    <div class="container max-w-container">
        <ul class="list-none pl-0 grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($blogs as $blog)
                <li>
                    <x-cards.blog :blog="$blog"/>
                </li>
            @endforeach
        </ul>

        <div class="py-10 lg:py-16">
            {{ $blogs->links('components.pagination.simple') }}
        </div>
    </div>
</section>
