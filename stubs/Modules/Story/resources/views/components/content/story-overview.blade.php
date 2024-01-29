<section {{ $attributes }}>
    <div class="container max-w-container">
        <ul class="list-none pl-0 grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($stories as $story)
                <li>
                    <x-cards.story :story="$story"/>
                </li>
            @endforeach
        </ul>

        <div class="py-10 lg:py-16">
            {{ $stories->links('components.pagination.simple') }}
        </div>
    </div>
</section>
