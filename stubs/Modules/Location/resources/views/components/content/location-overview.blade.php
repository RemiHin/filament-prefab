<section {{ $attributes }}>
    <div class="container max-w-container">
        <ul class="list-none pl-0 grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($locations as $location)
            <li>
                <x-cards.location :location="$location"/>
            </li>
            @endforeach
        </ul>

        <div class="py-10 lg:py-16">
            {{ $locations->links('components.pagination.simple') }}
        </div>
    </div>
</section>
